<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalBookHeader extends Model
{
    use HasFactory;
    protected $table = 'digital_book_headers';
    protected $connection = 'mysql';
    protected $guarded =[];

    function detailRelation() {
        return $this->hasMany(DigitalBookDetail::class,'requestCode','requestCode');
    }
    function departementRelation() {
        return $this->hasOne(MasterDepartement::class,'id','deptId');
    }
}
