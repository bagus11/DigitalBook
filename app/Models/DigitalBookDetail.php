<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalBookDetail extends Model
{
    use HasFactory;
    protected $table = 'digital_book_details';
    protected $guarded =[];

    function locationRelation() {
        return $this->hasOne(MasterLocation::class,'id','locationId');
    }
    function headerRelation() {
        return $this->hasOne(DigitalBookHeader::class,'requestCode','requestCode');
    }
    function isoRelation() {
        return $this->hasOne(MasterISO::class,'id','isoId');
    }
   
}
