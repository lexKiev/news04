<?php

namespace App\Policies;

use App\Model\Admin\Admin as User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
	use HandlesAuthorization;
	
	/**
	 * Determine whether the user can view the article.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function view(User $user)
	{
		//
	}
	
	/**
	 * Determine whether the user can create articles.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $this->getPermission($user, 5);
		
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
	
	/**
	 * Determine whether the user can update the article.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function update(User $user)
	{
		return $this->getPermission($user, 6);
	}
	
	/**
	 * Determine whether the user can manage tags.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function tag(User $user)
	{
		return $this->getPermission($user, 12);
	}
	
	/**
	 * Determine whether the user can manage tags.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function commentaries(User $user)
	{
		return $this->getPermission($user, 15);
	}
	
	/**
	 * Determine whether the user can manage categories.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function category(User $user)
	{
		return $this->getPermission($user, 13);
	}
	
	/**
	 * Determine whether the user can delete the article.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function delete(User $user)
	{
		return $this->getPermission($user, 7);
	}
	
	/**
	 * Determine whether the user can restore the article.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function restore(User $user)
	{
		//
	}
	
	/**
	 * Determine whether the user can permanently delete the article.
	 *
	 * @param  \App\Model\User\User $user
	 * @return mixed
	 */
	public function forceDelete(User $user)
	{
		//
	}
}
