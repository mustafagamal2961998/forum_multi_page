<?php

namespace App\Models;

use App\Models\Scopes\CategoryScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable=[
        'name',
        'description',
        'title_id',
        'status',
    ];
    protected static function booted()
    {
        static::addGlobalScope('WhereActive',new CategoryScope());
    }

    //SATRT RELATIONSHIPS
    public function title(){
        return $this->belongsTo(Title::class,'title_id');
    }
    public function topics(){
        return $this->hasMany(Topic::class,'category_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'category_id','id');
    }
    //END RELATIONSHIPS

}
