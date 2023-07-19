<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $fillable =[
        'content',
        'topic_id',
        'user_id',
        'category_id'
    ];
    public function scopeOrder(Builder $builder){
        return $builder->orderBy('id','desc');
    }


//SATRT RELATIONSHIPS
    public function topic(){
        return $this->belongsTo(Topic::class,'topic_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }


//END RELATIONSHIPS
}
