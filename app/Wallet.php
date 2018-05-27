<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Wallet extends Model
{
    //
    //
    protected $fillable= [
      'id_user','uang'
    ];

    protected $table = "wallets";


}
