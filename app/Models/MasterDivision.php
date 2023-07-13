<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDivision extends Model
{
    use HasFactory;
    protected $table = 'master_division';
    protected $connection = 'mysql2';
    protected $guarded =[];

    function digitalRelation() {
        return $this->hasMany(DigitalBookHeader::class,'divId','id');
    }
    function departementRelation() {
        return $this->hasMany(MasterDepartement::class,'division_id','id');
    }
}
