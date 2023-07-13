<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalBookDetailLog extends Model
{
    use HasFactory;
    protected $table = 'digital_book_detail_logs';
    protected $guarded =[];

    function userRelation() {
        return $this->hasOne(User::class,'id', 'userId');
    }
    function detailRelation() {
        return $this->hasMany(DigitalBookDetail::class,'detailCode','detailCode');
    }
    
}
