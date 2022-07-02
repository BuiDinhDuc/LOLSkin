<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';
    use HasFactory;

    public function universe(){
        return $this->belongsTo(Universe::class);
    }
    protected $table = 'categories';
}
