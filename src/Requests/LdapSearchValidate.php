<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;

class LdapSearchValidate extends BaseRequest
{
    
    public function rules()
    {
         return [
            'ldap_filter' => 'required|min:3'
        ];
    }


}
