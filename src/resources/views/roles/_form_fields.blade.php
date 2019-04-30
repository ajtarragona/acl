@input(['name'=>'name', 'required'=>true, 'label'=>__('acl::auth.Name'),'value'=>$role->name]) 
@input(['name'=>'display_name', 'required'=>true, 'label'=>__('acl::auth.Display name'),'value'=>$role->display_name]) 
@textarea(['name'=>'description', 'label'=>__('acl::auth.Description'),'value'=>$role->description])

@select(['icon'=>'key','name'=>'permission_id', 'label'=>__('acl::auth.Permissions'),'options'=>$permissions,'selected'=>$role->permissionIds(),'multiple'=>true,'required'=>true,'data'=>['actions-box'=>true,'live-search'=>true,'width'=>'100%']]) 


