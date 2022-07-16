<?php

namespace App\Models;

use Facebook;
use DateTimeInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
    protected $table = 'users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'fullname',
        'avatar',
        'status',
        'role',
        'token',
        // 'email_verify',
        // 'social',
        // 'social_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function getStatusVnAttribute()
    {
        if ($this->status == STATUS_ACTIVE) {
            return __('Đang kích hoạt');
        } elseif ($this->status == STATUS_DISABLE) {
            return __('Không kích hoạt');
        }

        return __('Đợi xác thực');
    }

    public static function getFaceLoginUrl()
    {
        $fb = new Facebook\Facebook([
            'app_id' => env('FACEBOOK_APP_ID', ' '),
            'app_secret' => env('FACEBOOK_APP_SECRET', ''),
            'default_graph_version' => 'v3.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email', 'public_profile'];
        $loginUrl = $helper->getLoginUrl(route('auth.fbcallback', 'facebook'), $permissions);
        $faceLoginUrl = htmlspecialchars($loginUrl);

        return $faceLoginUrl;
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'owner_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
