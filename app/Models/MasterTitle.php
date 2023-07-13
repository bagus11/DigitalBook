<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTitle extends Model
{
    use HasFactory;
    protected $table = 'master_jabatan';
    protected $connection = 'mysql2';
    protected $guarded =[];

    function departementRelation(){
        return $this->hasOne(MasterDepartement::class,'id','departement_id');
    }
}
