<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientMenus extends Model
{
    use HasFactory;
    protected $table = 'client_menus';
    protected $guarded =[];

    function menusRelation() {
        return $this->hasOne(ClientMenus::class,'id','parentSubmenus');
    }
}
