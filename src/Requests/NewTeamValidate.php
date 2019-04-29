<?php

namespace Ajtarragona\ACL\Requests;

use Ajtarragona\WebComponents\Requests\BaseRequest;

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
