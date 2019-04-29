<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;

class NewRoleValidate extends BaseRequest
{
    

    public function rules()
    {
         return [
            'display_name' => 'required',
            'name' => 'required|unique:roles,name'
        ];
    }


}
