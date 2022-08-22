<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Blameable;

/**
 * Class Notifications
 * @package App\Models
 * @version August 19, 2022, 10:27 pm UTC
 *
 * @property integer $user_id
 * @property string $reference_type
 * @property integer $reference_id
 * @property string $message
 * @property string|\Carbon\Carbon $read_at
 * @property string $created_by
 * @property string $updated_by
 */
class Notifications extends Model
{
    use Blameable;

    public $table = 'notifications';
    



    public $fillable = [
        'user_id',
        'reference_type',
        'reference_id',
        'message',
        'read_at',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'reference_type' => 'string',
        'reference_id' => 'integer',
        'message' => 'string',
        'read_at' => 'datetime',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|numeric',
        'reference_type' => 'required|string|max:50',
        'reference_id' => 'required|numeric',
        'message' => 'required|string'
    ];

    
}
