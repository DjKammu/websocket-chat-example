<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Bid;
use App\User;
use App\Country;
use Carbon\Carbon;

class BidController extends Controller
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
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user->role;
        $s = $request->get('s');
  
        $status = ($s == Bid::ACCEPTED) ? Bid::ACCEPTED : 
                  (($s == Bid::FINISHED) ? Bid::FINISHED : Bid::PENDING );   
        
        $bids = [];
        $acceptedBid = false;
        if($role == User::ROLE_BUYER){
          $bids = $this->buyerBids($user,$status);
        }elseif ($role == User::ROLE_GIRL) {
          $bids = $this->girlBids($user,$status);
          $acceptedBid = $user->acceptedBid();
        } 
        return view('bids',compact('status','bids','user','acceptedBid'));
    }
    
    public function buyerBids($user,$status){
        $bids = $user->buyerBids()
                 ->whereStatus($status)
                 ->with('bidGirl.userInfo','bidGirl.media','payment')
                 ->paginate(Bid::PER_PAGE);
                 
        $bids->map(function($bid){
           $bid->image = isset($bid->bidGirl->media[0]) ? $bid->bidGirl->media[0]->getFullUrl() : '';
           $bid->acceptedBid = $bid->bidGirl->acceptedBid();
           $bid->current = $bid->bidGirl->bids->max('amount');
           $bid->country = Country::name($bid->bidGirl->userInfo->country)->first()['name'];
           $bid->name = $bid->bidGirl->name;  
        });

        return $bids;  
    }

    public function girlBids($user,$status){
        $bids = $user->bids()
                 ->whereStatus($status)
                 ->with('bidBy.userInfo','bidBy.media','payment')
                 ->paginate(Bid::PER_PAGE);

        $bids->map(function($bid){
           $bid->image = isset($bid->bidBy->media[0]) ? $bid->bidBy->media[0]->getFullUrl() : '';
           $bid->current = $bid->max('amount');
           $bid->country = @Country::name($bid->bidBy->userInfo->country)->first()['name'];
           $bid->name = $bid->bidBy->name;  
        });

        return $bids;  
    }

    public function place(Request $request,$id){
        $bid = $request->bid;
        $user = User::find($id);
        $maxBid = $user->bids()->max('amount');
        $request->validate([
            'bid' => ['required',
                 function ($attribute, $value, $fail) use ($maxBid) {
                       if($maxBid && $value <= $maxBid){
                           $fail('The new bid must be greater than the current');
                       }
                       elseif ($value <= Bid::INITIAL_BID) {
                           $fail("Bid can't be less than $1000");
                      }
                  } 
                ]
        ]);

        $input = [
          'amount' => $bid, 
          'bid_by' => auth()->user()->id, 
          'status' => Bid::PENDING
        ];
        
        $user->bids()->create($input);
        
        return redirect()->back()
               ->with('success', 'Your Bid placed successfully.');
    }

    public function accept(Request $request,$id){
        $user = $request->user();
        $bid = Bid::find($id);
        $bids = $user->bids();
        $exists = $bids->find($id);
        $isBidAccepted = $user->isBidAccepted();

        $error = ($isBidAccepted) ? 'Bid already accepted.' 
                 : (($exists == null) ? 'Bid not belongs to you.' : ''); 

        if($error){
            return redirect('/bids')
                ->withErrors($error);
        }
        
        $input = [
          'status' => Bid::ACCEPTED
        ];
        
        $bid->update($input);

        return redirect()->back()
               ->with('success', 'Your has been accepted Bid successfully.');            

    }

   
}
