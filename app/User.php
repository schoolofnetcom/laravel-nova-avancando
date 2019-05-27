<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    protected function getPhotoAttribute()
    {
        if (empty($this->attributes['photo'])) {
            return 'default.png';
        }
        return $this->attributes['photo'];
    }

    public function activeToggle()
    {
        $this->attributes['active'] = !$this->attributes['active'];
        $this->save();
    }

    public function notify(string $subject, string $message)
    {
        \Log::info($subject . ' - ' . $message . ' - ' . $this->id);
    }
}
