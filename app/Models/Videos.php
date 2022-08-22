<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Blameable;

/**
 * Class Videos
 * @package App\Models
 * @version August 19, 2022, 5:22 pm UTC
 *
 * @property string $title
 * @property string $description
 * @property string $filename
 * @property string $created_by
 * @property string $updated_by
 */
class Videos extends Model
{

    use Blameable;

    public $table = 'videos';
    



    public $fillable = [
        'title',
        'description',
        'filename',
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
        'title' => 'string',
        'description' => 'string',
        'filename' => 'string',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:100',
        'description' => 'required',
        'filename' => 'required'
    ];

    /**
     * Realtionships
     *
     * @var array
     */
    public function video_requests(){
        return $this->hasMany('App\Models\VideoRequests', 'video_id');
    }
}
