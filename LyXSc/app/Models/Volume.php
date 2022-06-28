<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'number', 'id', 'comic_id'
    ];

    public function comic(){

        return $this->belongsTo( Comic::class, 'comic_id', 'id');
    }
    public function chapters(){
        return $this->hasMany( Chapter::class, 'volume_id', 'id');
    }
}
