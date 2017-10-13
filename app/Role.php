<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';

    protected $fillable = [
    	'id',
    	'name',
    	'display_name',
    	'description'
    ];

    public $timestamps = true;
    
    public function permissionrole()
    {
    	return $this->hasMany(PermissionRole::class);
    }

    public function roleuser()
    {
        return $this->hasMany(RoleUser::class);
    }
}
