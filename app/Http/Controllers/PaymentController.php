<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Bid;
use App\User;
use App\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request,$id)
    {
        $user = $request->user();
        $bid = Bid::find($id);
        $bids = $user->buyerBids();
        $exists = $bids->find($id);

        $error = ($exists == null) ? 'Bid not belongs to you.' 
                 : ((@$bid->status != Bid::ACCEPTED) ? 'Bid not accepted yet.' : ''); 

        if($error){
            return redirect('/bids?s=accepted')
                ->withErrors($error);
        }
        
        $amount = $bid->amount*Bid::PERCENTAGE/100;

        $data = [];
        $data['items'] = [
            [
                'name' => $user->name,
                'price' => $amount,
                'desc'  => 'Payment for Bid -'.$id,
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = $id;
        $data['invoice_description'] =  "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $amount;

  
        $request->session()->put('cart', $data);

        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);
     
        if(strtoupper($response['ACK']) == Payment::FAILURE){
          return redirect('/bids?s=accepted')
                ->withErrors($response['L_LONGMESSAGE0']);
        }
       
        return redirect($response['paypal_link']);           

    }

   
    public function cancel()
    {
       return redirect('/bids?s=accepted')
                ->withErrors('Your payment is canceled.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;

        $response = $provider->getExpressCheckoutDetails($request->token);

        $data = $request->session()->get('cart');

        $error = empty($data) ? true : false;

        $msg = ($error) ? 'Something went wrong' : 'Your payment has been successfully paid.';
  
        if ($error == false && in_array(strtoupper($response['ACK']),
              [Payment::SUCCESSWITHWARNING, Payment::SUCCESS])) {

            $transaction = $provider->doExpressCheckoutPayment($data, $request->token,
                      $request->PayerID);

             if(in_array(strtoupper($transaction['PAYMENTINFO_0_ACK']),
              [Payment::SUCCESSWITHWARNING, Payment::SUCCESS])){

                  $transaction_id = $transaction['PAYMENTINFO_0_TRANSACTIONID'];
                  $payment_status = $transaction['PAYMENTINFO_0_PAYMENTSTATUS'];
                  $amount = $data['total'];

                  $input =[
                      'transaction_id' => $transaction_id,
                      'payment_status' => $payment_status,
                      'bid_id' => $data['invoice_id'],
                      'user_id' => auth()->user()->id,
                      'amount' => $amount,
                  ];

                  Payment::create($input);

             }else{
                $error = true;
                $msg = $transaction['L_LONGMESSAGE0'];
             }
        }else{
            $error = true;
            $msg = $response['L_LONGMESSAGE0'];
        }
        
        $request->session()->flush('cart'); 

        if($error){
            return redirect('/bids?s=accepted')
                ->withErrors($error);
        }

        return redirect('/bids?s=accepted')
               ->with('success', $msg);
    }

}
