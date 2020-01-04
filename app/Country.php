<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  public function scopeName($query,$name){
  	return $query->select('name')->whereCode($name);
  }
}
