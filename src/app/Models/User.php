<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'role_id', 'email', 'password', 'icon_image',
    ];

    public function getDataUser()
    {
        return $this->load(['items', 'addresses',]);
    }

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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }
    /* ログインユーザーが住所登録しているかチェックする */
    public function isAddressByAuthUser()
    {
        if (!Auth::check()) {
            return false;
        }
        return $this->addresses->where('user_id', Auth::id())->isNotEmpty();
    }
}
