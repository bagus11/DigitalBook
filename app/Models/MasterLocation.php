<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLocation extends Model
{
    use HasFactory;
    protected $table = 'master_kantor';
    protected $connection = 'mysql2';
    protected $guarded =[];
    function provinceRelation(){
        return $this->hasOne(MasterProvince::class, 'id', 'id_prov');
    }

    function regionRelation(){
        return $this->hasOne(MasterRegion::class, 'id', 'id_city');
    }

    function districtRelation(){
        return $this->hasOne(MasterDistrict::class, 'id', 'id_district');
    }

    function villageRelation(){
        return $this->hasOne(MasterVillage::class, 'id', 'id_village');
    }

}
