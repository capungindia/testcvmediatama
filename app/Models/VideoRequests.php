<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Blameable;

/**
 * Class VideoRequests
 * @package App\Models
 * @version August 19, 2022, 6:33 pm UTC
 *
 * @property integer $user_id
 * @property integer $video_id
 * @property string $verified_at
 * @property integer $verifier_id
 * @property integer $allowed_duration
 * @property string $created_by
 * @property string $updated_by
 */
class VideoRequests extends Model
{
    use Blameable;

    public $table = 'video_requests';

    public $fillable = [
        'user_id',
        'video_id',
        'verified_at',
        'verifier_id',
        'allowed_duration',
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
        'video_id' => 'integer',
        'verified_at' => 'date',
        'verifier_id' => 'integer',
        'allowed_duration' => 'integer',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'allowed_duration' => 'numeric'
    ];

    /**
     * Relationships
     *
     * @var array
     */        

    public function video(){
        return $this->belongsTo('App\Models\Videos', 'video_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\Users', 'user_id');
    }

    public function verifier(){
        return $this->belongsTo('App\Models\Users', 'verifier_id');
    }

    public function notification(){
        return $this->hasOne('App\Models\Notifications', 'reference_id');
    }
}
