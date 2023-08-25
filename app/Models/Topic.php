<?php

namespace App\Models;

use App\Models\Scopes\TopicScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Topic extends Model
{
    use HasFactory;

    public $fillable=[
        'title',
        'content',
        'category_id',
        'user_id',
        'tags_id',
        'status',
        'views',
//        'rate',
        'signature_status',
        'owner_follow',
    ];


    protected static function booted()
    {
        static::addGlobalScope('WhereActive',new TopicScope());
    }


    public function scopeOrder(Builder $builder){
        return $builder->orderBy('id','desc');
    }


//SATRT RELATIONSHIPS
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function tag(){
        return $this->hasOne(Tag::class,'topic_id')->withDefault();
    }
    public function comments(){
        return $this->hasMany(Comment::class,'topic_id');
    }
    public function rates(){
        return $this->hasMany(Rate::class,'topic_id');
    }
//END RELATIONSHIPS

}


