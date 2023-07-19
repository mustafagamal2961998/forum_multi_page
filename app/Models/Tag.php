<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $fillable =[
        'tags',
        'topic_id'
    ];



//SATRT RELATIONSHIPS
    public function tag(){
        return $this->belongsTo(Topic::class,'topic_id','id');
    }
//END RELATIONSHIPS
}
