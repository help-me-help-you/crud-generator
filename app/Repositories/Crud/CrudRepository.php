<?php

namespace App\Repositories\Crud;

use App\Models\Crud\Crud;
use InfyOm\Generator\Common\BaseRepository;

class CrudRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Crud::class;
    }
}
