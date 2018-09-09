<?php

namespace App\Policies;

use App\Model\Admin\Admin as User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\Model\User\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function view(User $user)
    {
     return $this->getPermission($user, 14);
    }

	protected function getPermission($user, $permissionId)
	{
		foreach ($user->roles as $role) {
			foreach ($role->permissions as $permission) {
				if ($permission->id == $permissionId) {
					return true;
				}
			}
		}
		
		return false;
	}
}
