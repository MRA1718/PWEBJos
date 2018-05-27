<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    //

    protected $fillable = [
        'id_user', 'nama_pemasukan', 'biaya_pemasukan','tgl_pemasukan'
    ];
    protected $table ='incomes';
    public $timestamps = false;
}
