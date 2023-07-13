<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterVillage extends Model
{
    use HasFactory;
    protected $table = 'tbl_kelurahan';
    protected $connection = 'mysql2';
}
