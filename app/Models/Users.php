<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Blameable;

/**
 * Class Users
 * @package App\Models
 * @version August 19, 2022, 3:42 pm UTC
 *
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $created_by
 * @property string $updated_by
 */
class Users extends Authenticatable
{
    use Notifiable, Blameable;
    
    public $table = 'users';
    

    public $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'username' => 'string',
        'email' => 'string',
        'password' => 'string',
        'role' => 'string',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:100',
        'username' => 'required|max:50|unique:users',
        'email' => 'required|max:100|unique:users',
        'password' => 'required|min:8|confirmed',
        'role' => 'required'
    ];

    /**
     * Relationships
     *
     * @var array
     */
    public function notifications(){
        return $this->hasMany('App\Models\Notifications', 'user_id');
    }

    public function video_requests(){
        return $this->hasMany('App\Models\VideoRequests', 'user_id');
    }

    /**
     * Assessors
     *
     * @var array
     */    
    public function getUnreadNotificationsAttribute(){
        return $this->notifications->whereNull('read_at');
    }
}
