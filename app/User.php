<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\UserInfo;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;

    use HasMediaTrait;

    CONST ROLE_GIRL  = 'girl';
    
    CONST ROLE_BUYER = 'buyer';

    CONST LAST_YEAR = 100;

    CONST FIRST_YEAR = 19;

    CONST MIN_GALERY = 2;

    CONST DEFALT_LANGUAGE = 'English';

    CONST PER_PAGE = 12;
    
    CONST NEW_CAT = 'new';
    
    CONST NEW_CAT_TITLE = 'New';

    CONST RELEVENCE_CAT = 'relevance';
    
    CONST RELEVENCE_CAT_TITLE = 'Relevance';

    CONST COUNTRY_CAT = 'country';
    
    CONST COUNTRY_CAT_TITLE = 'From My Country';

    CONST BIDS_CAT = 'bids';
    
    CONST BIDS_CAT_TITLE = 'By Bids';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function UserInfo(){
      return $this->hasOne(UserInfo::class);
    }
    
    public function scopeGirls($query)
    {
        return $query->whereRole(self::ROLE_GIRL);
    }
    // public function registerMediaConversions(Media $media = null)
    // {
    //     $this->addMediaConversion('thumb')
    //         ->width(50)
    //         ->height(50);
    // }

    public function bids(){
        return $this->hasMany(Bid::class);
    }
    
    public function buyerBids(){
        return $this->hasMany(Bid::class,'bid_by','id');
    }
    
    public function acceptedBid(){
        return $this->bids()->where('status',Bid::ACCEPTED)->first();
    }

    Public function isBidAccepted(){
      return (bool) $this->acceptedBid();
    }
    // public function userCountry($location){
    //     return $this->UserInfo()->whereLocation($location);
    // }

}
