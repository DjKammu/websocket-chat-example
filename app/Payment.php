<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Payment extends Model
{
    CONST SUCCESSWITHWARNING  = 'SUCCESSWITHWARNING';
    
    CONST SUCCESS = 'SUCCESS';

    CONST FAILURE = 'FAILURE';

    CONST PAID = 'PAID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'bid_id', 
        'user_id','amount','payment_status'
    ];


}
