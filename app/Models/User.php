<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_active',
        'name',
        'second_name',
        'patronymic',
        'balls',
        'lottery',
        
        'phone',
        'email',
        'index',
        'area',
        'district',
        'settlement',
        'street',
        'house',
        'appartment',

        'gifts_for_points',
        'gift_for_lottery',
        'awarded',

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'user_active' => 'boolean',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function search($query)
    {
        return self::whereRaw("MATCH(`name`, second_name, patronymic, phone, email, `index`, area, district, settlement, street, house, appartment) AGAINST(? IN NATURAL LANGUAGE MODE)", [$query])
        ->latest()    
        ->get([
                "id",
                "user_active",
                "name",
                "second_name",
                "patronymic",
                "balls",
                "lottery",
                "phone",
                "email",
                "index",
                "area",
                "district",
                "settlement",
                "street",
                "house",
                "appartment",
                "gifts_for_points",
                "gift_for_lottery",
                "awarded",
            ]);
    }
}
