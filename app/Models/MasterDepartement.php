<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDepartement extends Model
{
    use HasFactory;
    protected $table = 'master_departements';
    protected $connection = 'mysql2';
    protected $guarded =[];

    function divisionRelation() {
        return $this->hasOne(MasterDivision::class,'id','division_id');
    }
    function digitalRelation() {
        return $this->hasMany(DigitalBookHeader::class, 'deptId','id');
    }
    
}
