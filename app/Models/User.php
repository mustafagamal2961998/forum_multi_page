<?php

namespace App\Models;

use App\Helpers\UserSystemInfoHelper;
use App\Models\Scopes\UserScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Stevebauman\Location\Facades\Location;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ip',
        'avatar',
        'cover',
        'browser',
        'device',
        'os',
        'country',
        'rank_id',
//        'job_id',
        'signature_status',
        'status',
        'verify_code'
    ];
    protected static function booted()
    {
        static::addGlobalScope('ActiveOrArchive',new UserScope());
    }

    public function scopeOrder(Builder $builder){
        return $builder->orderBy('id','desc');
    }

    public function scopeUpdateInfo(Builder $builder){
        $UserIp = UserSystemInfoHelper::get_ip();
        if($UserIp !='127.0.0.1'){
            $Location = Location::get($UserIp);
        }
        return $builder->update([
            'ip'=>UserSystemInfoHelper::get_ip(),
            'browser'=>UserSystemInfoHelper::get_browsers(),
            'device'=>UserSystemInfoHelper::get_device(),
            'os'=>UserSystemInfoHelper::get_os(),
            'country'=>$Location->countryName ?? '',
        ]);
    }


//SATRT RELATIONSHIPS
    public function topics(){
        return $this->hasMany(Topic::class,'user_id');
    }
    public function rank(){
        return $this->belongsTo(Rank::class,'rank_id');
    }

    public function signature(){
        return $this->hasOne(Signature::class,'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'user_id');
    }
    public function rate(){
        return $this->hasMany(Rate::class,'user_id');
    }
//END RELATIONSHIPS




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
