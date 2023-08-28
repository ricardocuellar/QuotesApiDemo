<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    const BORRADOR = 1;
    const PUBLICADO = 2;

    //Relation one to many
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Relation one to many inverse
    public function user(){
        return $this->belongsTo(User::class);
    }
}
