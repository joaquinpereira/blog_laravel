<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRoleRequest extends FormRequest
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
        $rules = [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
        ];

        if($this->method() !== 'POST'){
            $rules = ['display_name' => 'required'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'identificador del role',
            'display_name' => 'nombre del role'
        ];
    }


}
