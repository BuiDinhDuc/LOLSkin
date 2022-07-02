<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    protected $primaryKey = 'id';
    use HasFactory;
    protected $table = 'champions';

}
