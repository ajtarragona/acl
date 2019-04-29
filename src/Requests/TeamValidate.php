<?php

namespace Ajtarragona\ACL\Requests;

use Ajtarragona\WebComponents\Requests\BaseRequest;

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
