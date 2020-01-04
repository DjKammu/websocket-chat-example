<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Bid extends Model
{
    CONST INITIAL_BID = 1000;

    CONST PENDING = 'pending';

    CONST ACCEPTED = 'accepted';

    CONST FINISHED  = 'finished';

    CONST PER_PAGE = 15;   

    CONST PERCENTAGE = 10; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'bid_by', 'amount','status'
    ];

    
    public function girl($query)
    {
        return $query->whereRole(self::ROLE_GIRL);
    }

    public function bidBy(){
      return $this->belongsTo(User::class,'bid_by','id');
    }
    
    public function bidGirl(){
     return $this->belongsTo(User::class,'user_id','id'); 
    } 
    
    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
