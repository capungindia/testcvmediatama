<?php

namespace App\Repositories;

use App\Models\Notifications;
use App\Repositories\BaseRepository;

/**
 * Class NotificationsRepository
 * @package App\Repositories
 * @version August 19, 2022, 10:27 pm UTC
*/

class NotificationsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'reference_type',
        'reference_id',
        'message',
        'read_at',
        'created_by',
        'updated_by'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Notifications::class;
    }
}
