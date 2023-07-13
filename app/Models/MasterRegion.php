<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRegion extends Model
{
    use HasFactory;
    protected $table = 'tbl_kabkot';
    protected $connection = 'mysql2';
}
