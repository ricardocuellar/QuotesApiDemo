<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','body','status','user_id'];
    protected $allowIncluded = ['comments'];
    protected $allowFilter = ['status', 'created_at'];

    const DRAFT = 1;
    const ACCEPTED = 2;
    const DECLINE = 3;

    //Relation one to many
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Relation one to many inverse
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeIncluded(Builder $query){

        if(empty($this->allowIncluded) || empty(request('included'))){
            return;
        }

        $relations = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        foreach($relations as $key=>$relationship){
            if(!$allowIncluded->contains($relationship)){
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    public function scopeFilter(Builder $query){
        if(empty($this->allowFilter) || empty(request('filter'))){
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach($filters as $filter => $value){
            if($allowFilter->contains($filter)){
                $query->where($filter, 'LIKE','%' . $value . '%');
            }
        }
    }
}
