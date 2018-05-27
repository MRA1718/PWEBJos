<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //

        protected $fillable = [
            'id_user', 'nama_pengeluaran', 'biaya_pengeluaran','tgl_pengeluaran'
        ];
        protected $table ='expenses';
        public $timestamps = false;
}
