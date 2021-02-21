<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\model\admin\Role;
use App\model\Vendor\Vendor;
use App\model\VendorUser\VendorUser;
use App\Notifications\CustomResetPasswordNotification;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function checkIfUserRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->role->name)) ? true : false;
    }
    public function hasRole($types)
    {
        if (is_array($types)) {
            foreach ($types as $type) {
                if ($this->checkIfUserRole($type)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserRole($types);
        }
        return false;
    }
    public function vendoruser()
    {
        return $this->hasOne(VendorUser::class, 'user_id');
    }
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'user_id');
    }
    public function point()
    {
        return $this->hasOne(PickupPoint::class, 'user_id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
    public static function byEmail($email)
    {
        return static::where('email', $email);
    }
    public function hasVerifiedEmail()
    {
        return $this->active;
    }

    public function status()
    {

        return \App\model\Vendor\Vendor::where('user_id', $this->id)->value('stage');
    }

    public function routeNotificationForSlack($notification)
    {
        return env('slackuser', '');
    }

    public function routeNotificationForOneSignal()
    {
        return ['email' => $this->email];
    }
}
