<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Fortify\TwoFactorAuthenticatable;


class Client extends Authenticatable
{
    use HasFactory,TwoFactorAuthenticatable ;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone');

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
