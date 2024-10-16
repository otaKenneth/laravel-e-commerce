<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // Adding the HasApiTokens trait of "Laravel Passport" package (different from Sanctum's one)        // https://laravel.com/docs/9.x/passport#:~:text=add%20the,Laravel%5CPassport%5CHasApiTokens

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;
    use /* HasApiTokens, */ HasFactory, Notifiable, \Laravel\Passport\HasApiTokens; // Adding the HasApiTokens trait of "Laravel Passport" package (different from Sanctum's one)        // https://laravel.com/docs/9.x/passport#:~:text=add%20the,Laravel%5CPassport%5CHasApiTokens

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'google_id',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'status'
    ];

    protected $with = ['deliveryAddress'];

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

    public function userDeliveryAddresses() {
        return $this->hasMany(\App\Models\DeliveryAddress::class);
    }

    public function deliveryAddress() {
        return $this->userDeliveryAddresses()->take(1);
    }

    public function chats() {
        return $this->belongsToMany(Chats::class, 'chat_users', 'user_id', 'chat_id');
    }
}