<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Laravel\Fortify\TwoFactorAuthenticatable;


class Client extends Authenticatable
{
    use HasFactory,TwoFactorAuthenticatable;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name','email','password', 'phone','provider','provider_id','provider_token');

    protected $hidden = [
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'provider_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function setProviderTokenAttribute($value)
    {
        $this->attributes['provider_token'] = Crypt::encryptString($value);
    }
    public function getProviderTokenAttribute($value)
    {
        return Crypt::decryptString($value);
    }


}
