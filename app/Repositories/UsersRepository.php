<?php

namespace App\Repositories;

use App\Models\Users;
use App\Repositories\BaseRepository;

/**
 * Class UsersRepository
 * @package App\Repositories
 * @version August 19, 2022, 3:42 pm UTC
*/

class UsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'username',
        'email',
        'password',
        'role'
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
        return Users::class;
    }
}
