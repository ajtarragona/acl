<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;

class TeamValidate extends BaseRequest
{
    

    public function rules()
    {
         return [
            'display_name' => 'required',
            'name' => 'required'
        ];
    }


}
