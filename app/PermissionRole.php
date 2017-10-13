<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';

    protected $fillable = [
    	'permission_id',
    	'role_id'
    ];

    public $timestamps = true;

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
