<?php

namespace App\Models\Crud;

use Illuminate\Database\Eloquent\Model;



class Crud extends Model
{

    public $table = 'cruds';
    

    protected $primaryKey = 'i_d';

    public $fillable = [
        'name',
        'description',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
