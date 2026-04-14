<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'phone', 'user_role_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userRole()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function userOrders()
    {
        return $this->hasMany(UserOrder::class);
    }

    public function userCartItems()
    {
        return $this->hasMany(UserCartItem::class);
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class);
    }

    public function userFavoriteItems()
    {
        return $this->hasMany(UserFavoriteItem::class);
    }
}
