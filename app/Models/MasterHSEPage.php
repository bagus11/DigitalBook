<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterHSEPage extends Model
{
    use HasFactory;
    protected $table = 'master_hse_pages';
    protected $guarded =[];   
    
    function pageRelation() {
        return $this->hasOne(ClientMenus::class,'id','pageId');
    }
    function submenusRelation() {
        return $this->hasOne(ClientMenus::class,'id','parentSubmenus');
    }
}
