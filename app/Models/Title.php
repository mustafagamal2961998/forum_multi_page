<?php

namespace App\Models;

use App\Models\Scopes\TitleScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    public $fillable=[
        'title_name',
        'status',
    ];

    protected static function booted()
    {
        static::addGlobalScope('WhereActive',new TitleScope());
    }

    //SATRT RELATIONSHIPS
    public function categories(){
        return $this->hasMany(Category::class,'title_id');
    }
    //END RELATIONSHIPS

}
