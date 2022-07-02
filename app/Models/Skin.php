<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skin extends Model
{
    protected $primaryKey = 'id';
    use HasFactory;
    protected $table = 'skins';

    public function champion(){
        return $this->belongsTo(Champion::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
