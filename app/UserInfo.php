<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
   protected $table = "users_info";

   protected $fillable = [
     'desirable_amount',
     'medical_checkup',
     'certificate',
     'breast_size',
     'hair_color',
     'eye_color',
     'languages',
     'currency',
     'user_id',
     'country',
     'number',
     'height',
     'weight',
     'dob',
   ];

    public function user()
	{
	     return $this->belongsTo('App\User');
	}
}
