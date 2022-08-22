<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Users;

class UpdateUsersRequest extends FormRequest
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
        $rules = Users::$rules;

        $rules['username'] = $rules['username'].",username,".$this->route('user');
        $rules['email'] = $rules['email'].",email,".$this->route('user');

        if(is_null($this->get('password')))
            unset($rules['password']);

        return $rules;
    }
}
