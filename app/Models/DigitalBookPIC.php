<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalBookPIC extends Model
{
    use HasFactory;
    protected $table = 'digital_book_pic';
    protected $guarded =[];

    function userRelation() {
        return $this->belongsTo(User::class,'userId');
    }
}
