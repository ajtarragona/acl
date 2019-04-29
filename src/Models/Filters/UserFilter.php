<?php
namespace Ajtarragona\ACL\Models\Filters;
use Ajtarragona\WebComponents\Models\BaseFilter;

class UserFilter extends BaseFilter{
	public $textfilter;	
	public $role_id;

	public function __construct($filter=false)
	{
		$this->textfilter = false;
		$this->role_id = false;
		
		if($filter){
			if(isset($filter["textfilter"])) $this->textfilter=$filter["textfilter"];
			if(isset($filter["role_id"])) $this->role_id=$filter["role_id"];
		}

	}
	
}