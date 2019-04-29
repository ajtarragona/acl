<?php

namespace Ajtarragona\ACL\Requests;

use Ajtarragona\WebComponents\Requests\BaseRequest;

class PermissionValidate extends BaseRequest
{
    

    public function rules()
    {
         return [
            'display_name' => 'required',
            'name' => 'required'
        ];
    }


}
