<?php

namespace App\Http\Requests\Crud;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Crud\Crud;

class UpdateCrudRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Crud::$rules;
    }
}
