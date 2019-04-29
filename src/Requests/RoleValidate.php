<?php

namespace Ajtarragona\ACL\Requests;

use Ajtarragona\WebComponents\Requests\BaseRequest;

class RoleValidate extends BaseRequest
{

    public function rules()
    {
         return [
            'display_name' => 'required',
            'name' => 'required'
        ];
    }


}
