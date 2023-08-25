<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        'sign_name',
        'font_family',
        'text_color',
        'user_id'
    ];


    //SATRT RELATIONSHIPS
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    //END RELATIONSHIPS

}
