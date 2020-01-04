<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserInfo;
use Carbon\Carbon;

class GirlController extends Controller
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
        $UserInfo = $user->userInfo()->first();
        $country = $UserInfo->country;
        
        $newGirls  = $this->newGirls(User::girls(),true);
        $bidGirls  = $this->bidGirls(User::girls(),true);
        $countryGirls  = $this->countryGirls(User::girls(),$country,true);
        $relevanceGirls  = $this->relevanceGirls(User::girls(),true);
      
        return view('girls',compact('newGirls','bidGirls',
                 'countryGirls','relevanceGirls'));
    }


    public function category($category,Request $request){
       $girls = [];
       $title = '';
       if($category == User::RELEVENCE_CAT){
           $title = User::RELEVENCE_CAT_TITLE;
           $girls =  $this->relevanceGirls(User::girls());
       }elseif($category == User::NEW_CAT){
           $title = User::NEW_CAT_TITLE;
           $girls =  $this->newGirls(User::girls());
       }elseif($category == User::COUNTRY_CAT){
           $user = $request->user();
           $UserInfo = $user->userInfo()->first();
           $country = $UserInfo->country;
           $title = User::COUNTRY_CAT_TITLE;
           $girls =  $this->countryGirls(User::girls(),$country);
       }elseif($category == User::BIDS_CAT){
           $title = User::BIDS_CAT_TITLE;
           $girls =  $this->bidGirls(User::girls());
       }

       return view('category',compact('girls','title'));
    }

    public function description($id,Request $request){
        $user = User::findOrFail($id);
        $role = $user->role;
        if($role == User::ROLE_BUYER){
              return redirect('girls');
        }
        $userInfo = $user->userInfo()->first();
        $userInfo->age = ($userInfo->dob) ? Carbon::parse($userInfo->dob)->age : ''; 
        $image = $user->getFirstMediaUrl('avatars');
        
        $gallery = $user->getMedia('gallery');
        $gallery = $gallery->map(function($img){
          return $img->getFullUrl();
        });
     
        $bids = $user->bids();

        $bid = $bids 
              ->orderBy('amount', 'desc')
              ->with('bidBy')
              ->first();
        
        $accepted = $user->isBidAccepted();

        return view('girl-description',compact('user','image',
               'userInfo','gallery','bid','accepted'));
    }

    public function newGirls($girls,$limit = false){
        $girls->with(['bids','media'])->orderBy('id','asc');

        $girls = ($limit) ? $girls->limit(User::PER_PAGE)->get() : 
                 $girls->paginate(User::PER_PAGE);

        $girls->map(function($girl){
           $bid = isset($girl->bids[0]) ? $girl->bids->max('amount') : 'Initial Bid';
           $image = isset($girl->media[0]) ? $girl->media[0]->getFullUrl() : '';
           $girl->image = $image;
           $girl->bid = $bid;
        });

        return $girls;  
    }

    public function countryGirls($girls,$country,$limit = false){
        $girls->whereHas('userInfo', function ($q) use ($country) {
                 $q->whereCountry($country);
          })->with(['bids','media'])->orderBy('id','asc');

        $girls = ($limit) ? $girls->limit(User::PER_PAGE)->get() : 
                 $girls->paginate(User::PER_PAGE);

        $girls->map(function($girl){
           $bid = isset($girl->bids[0]) ? $girl->bids->max('amount') : 'Initial Bid';
           $image = isset($girl->media[0]) ? $girl->media[0]->getFullUrl() : '';
           $girl->image = $image;
           $girl->bid = $bid;
        });

        return $girls;
    }

   public function bidGirls($girls,$limit = false){
         $girls->withCount(['bids','media'])
         ->orderBy('bids_count', 'desc')
         ->orderBy('id', 'desc');

        $girls = ($limit) ? $girls->limit(User::PER_PAGE)->get() : 
                 $girls->paginate(User::PER_PAGE);

          $girls->map(function($girl){
           $bid = isset($girl->bids[0]) ? $girl->bids->max('amount') : 'Initial Bid';
           $image = isset($girl->media[0]) ? $girl->media[0]->getFullUrl() : '';
           $girl->image = $image;
           $girl->bid = $bid;
        });

        return $girls;
    }

  public function relevanceGirls($girls,$limit = false){
         $girls->select('*','users.id as id')
         ->join('users_info', function ($join) {
            $join->on('users.id', '=', 'users_info.user_id');
         })->with(['bids','media'])
         ->orderBy('users_info.desirable_amount', 'ASC');

        $girls = ($limit) ? $girls->limit(User::PER_PAGE)->get() : 
                 $girls->paginate(User::PER_PAGE);

        $girls->map(function($girl){
           $bid = isset($girl->bids[0]) ? $girl->bids->max('amount') : 'Initial Bid';
           $image = isset($girl->media[0]) ? $girl->media[0]->getFullUrl() : '';
           $girl->image = $image;
           $girl->bid = $bid;
        });

        return $girls;
    }





}
