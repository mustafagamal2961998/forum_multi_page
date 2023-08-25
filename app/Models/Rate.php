<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $fillable = [
        'rate',
        'user_id',
        'topic_id'
    ];


//SATRT RELATIONSHIPS
    public function topic(){
        return $this->belongsTo(Topic::class,'topic_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
//END RELATIONSHIPS
}
