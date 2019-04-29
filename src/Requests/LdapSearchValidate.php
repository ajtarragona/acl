<?php

namespace Ajtarragona\ACL\Requests;

use Ajtarragona\WebComponents\Requests\BaseRequest;

class LdapSearchValidate extends BaseRequest
{
    
    public function rules()
    {
         return [
            'ldap_filter' => 'required|min:3'
        ];
    }


}
