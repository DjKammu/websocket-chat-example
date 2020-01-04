<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StepRequest;
use App\User;
use App\UserInfo;
use App\Country;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AccountController extends Controller
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
        $user =  $request->user();
        $userInfo = $user->userInfo()->first();
        $userInfo->age = ($userInfo->dob) ? Carbon::parse($userInfo->dob)->age : ''; 
        $image = $user->getFirstMediaUrl('avatars');
        return view('account',compact('user','image','userInfo'));
    }

    public function steps(Request $request)
    {
        $user =  $request->user();
        $role = $user->role;
        $image = $user->getFirstMediaUrl('avatars');
        return view('steps',compact('role','image'));
    }

    public function stepsUpdate(Request $request)
    {
          $user = $request->user();
          $role = $user->role;

          $request->validate([
                'avatar' => [Rule::requiredIf($role == User::ROLE_GIRL),
                         'max:10000','mimes:jpg,jpeg,png']
          ]);

          //Store Image
        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
         }

         if($role == User::ROLE_GIRL){
           return redirect('/account/settings/gallery');
         }

        return redirect('/account/settings');

    }

    public function settings(Request $request)
    {
        $user =  $request->user();
        $role = $user->role;
        $image = $user->getFirstMediaUrl('avatars');
        $currencies = config('web.currencies');
        $languages = config('web.languages');
        $languages = config('web.languages');
        $breastSize = config('web.breastSize');
        $hairColor = config('web.hairColor');
        $eyeColor = config('web.eyeColor');
        $countries = Country::all();
        $current = (int) date("Y");
        $last =  $current - User::LAST_YEAR;
        $first = $current - User::FIRST_YEAR;
        $years = range($last,$first);
        $years = array_reverse($years);
        $userInfo = $user->userInfo()->first();
        return view('settings',compact('role','countries','currencies','breastSize',
            'hairColor','eyeColor','languages','image','years','user','userInfo'));
    }

    public function settingsUpdate(Request $request)
    {
          $user = $request->user();
          $role = $user->role;

          if($role == User::ROLE_BUYER){
            $data = $this->validateBuyerSetting($request); 
          }else{
            $data = $this->validationGirlSetting($request);
          }    

          $userInfo = $user->userInfo()->first();
          
          if($userInfo){
            $user->userInfo()->update($data);
          }
          else
          {
            $user->userInfo()->create($data);
          }
         
        //Store Image
        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
         }

         if($request->hasFile('certificate') && $request->file('certificate')->isValid()){
            $user->addMediaFromRequest('certificate')->toMediaCollection('certificates');
         }

         return redirect('/account');

    }

   public function gallery(Request $request)
    {
        $user =  $request->user();
        $role = $user->role;
        $gallery = $user->getMedia('gallery');
        $gallery = $gallery->map(function($img){
          return $img->getFullUrl();
        });

        return view('gallery',compact('gallery'));
    }

    public function galleryUpdate(Request $request)
    {
          $user = $request->user();
          $role = $user->role;

          if($role == User::ROLE_BUYER){
            return redirect('/account');
          } 
          
          $gallery = $user->getMedia('gallery');
          $gCount = count($gallery);
          
          if($gCount >= User::MIN_GALERY && !$request->gallery){
            return redirect('/account/settings');
          } 

          $min = (User::MIN_GALERY - $gCount);

          $messages = [
            "gallery.min" => "gallery images can't be less than 2."       
          ];
              
          $this->validate($request,[
                'gallery.*' => 'mimes:jpg,jpeg,bmp,png|max:5000',
                'gallery' => 'required|min:'.$min,
          ],$messages);

         foreach ($request->gallery as $gallery) {
             $user->addMedia($gallery)
                  ->toMediaCollection('gallery');
         }

         return redirect()->back();

    }

    public function validateBuyerSetting($request){

          $request->validate([
                'number' =>  'required|regex:/[0-9]{9}/',
          ]);

          $input = $request->input();

          $data = $request->only(['country','currency','number']);

          if($request->filled('languages'))
          {
             $data['languages'] = json_encode($request->languages);
          }
          else
          {
           $data['languages'] = json_encode([User::DEFALT_LANGUAGE]);
          }

          if($request->filled(['day','month','year'])){
            $data['dob'] = $request->year.'-'.$request->month.'-'.$request->day;
          }

          return $data;

    } 

    public function validationGirlSetting($request){

          $request->validate([
                'number' =>  'required|regex:/[0-9]{9}/',
          ]);

          $input = $request->input();

         $data = $request->except(['_token','day','month','year','currency','languages']);

          if($request->filled('languages'))
          {
             $data['languages'] = json_encode($request->languages);
          }
          else
          {
           $data['languages'] = json_encode([User::DEFALT_LANGUAGE]);
          }

          if($request->filled(['day','month','year'])){
            $data['dob'] = $request->year.'-'.$request->month.'-'.$request->day;
          }

          return $data;

    }
}
