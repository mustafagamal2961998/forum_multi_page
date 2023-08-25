<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    public $fillable =[
        'rank_name',
//        'rank_level',
        'rank_icon',
        'rank_bg_color',
        'rank_text_color',
        'rank_font_weight',
    ];


//SATRT RELATIONSHIPS
    public function users(){
        return $this->hasMany(User::class,'rank_id');
    }
//SATRT RELATIONSHIPS
}
