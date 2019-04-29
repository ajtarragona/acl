@input(['name'=>'name', 'required'=>true, 'label'=>__('Name'),'value'=>$role->name]) 
@input(['name'=>'display_name', 'required'=>true, 'label'=>__('Display Name'),'value'=>$role->display_name]) 
@textarea(['name'=>'description', 'label'=>__('Description'),'value'=>$role->description])

@select(['icon'=>'key','name'=>'permission_id', 'label'=>__('Permissions'),'options'=>$permissions,'selected'=>$role->permissionIds(),'multiple'=>true,'required'=>true,'data'=>['actions-box'=>true,'live-search'=>true,'width'=>'100%']]) 


