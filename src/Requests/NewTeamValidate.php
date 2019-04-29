<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;

class NewTeamValidate extends BaseRequest
{
    
    public function rules()
    {
         return [
            'display_name' => 'required',
            'name' => 'required|unique:permissions,name'
        ];
    }


}
