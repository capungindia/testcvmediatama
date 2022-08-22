<?php

namespace App\Repositories;

use App\Models\VideoRequests;
use App\Repositories\BaseRepository;

/**
 * Class VideoRequestsRepository
 * @package App\Repositories
 * @version August 19, 2022, 6:33 pm UTC
*/

class VideoRequestsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'allowed_duration',
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
        return VideoRequests::class;
    }
}
