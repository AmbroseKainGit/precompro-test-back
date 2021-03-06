<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use SoftDeletes;
  protected $table = 'order';
  protected $guard = [];



  public function account()
  {
    return $this->belongsTo('App\Models\Account', 'id_account','id');
  }
}
