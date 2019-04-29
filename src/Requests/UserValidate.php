<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;

class UserValidate extends BaseRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'name' => 'required',
            'username' => 'required|min:4|max:25',
            'email' => 'required|email'
        ];
    }

  /*  public function messages(){
        return [
            'name.required' => 'El camp nom és obligatori!',
            'name.min' => 'El nom ha de tenir 3 caracters!',
            'responsable.required' => 'El responsable és obligatori!',
        ];
    }*/
}
