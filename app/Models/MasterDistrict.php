<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDistrict extends Model
{
    use HasFactory;
    protected $table = 'tbl_kecamatan';
    protected $connection = 'mysql2';
}
