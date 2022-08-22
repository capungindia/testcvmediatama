<?php

namespace App\Repositories;

use App\Models\Videos;
use App\Repositories\BaseRepository;

/**
 * Class VideosRepository
 * @package App\Repositories
 * @version August 19, 2022, 5:22 pm UTC
*/

class VideosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'filename'
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
        return Videos::class;
    }
}
