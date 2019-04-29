<?php

namespace Ajtarragona\ACL\Requests;

use Ajtarragona\WebComponents\Requests\BaseRequest;

class NewUserValidate extends BaseRequest
{
    
    public function rules()
    {
         return [
            'name' => 'required',
            'username' => 'required|min:4|max:12|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
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
