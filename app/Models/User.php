<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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


    public function fines()
     {
       return $this->hasMany(Fine::class); 
     }
    public function booking()
     {
        return $this->hasMany(Booking::class);
     }
     public function admin()
     {
        return $this->hasOne(Admin::class);
     }
     public function acstaff()
     {
        return $this->hasOne(Acstaff::class);
     }
     public function issuer()
     {
        return $this->hasOne(Issuer::class);
     }
     public function student()
     {
        return $this->hasOne(Student::class);
     }
     public function nonacstaff()
     {
        return $this->hasOne(Nonacstaff::class);
     }
}
