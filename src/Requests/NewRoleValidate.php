<?php

namespace Ajtarragona\ACL\Requests;

use Ajtarragona\WebComponents\Requests\BaseRequest;

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
