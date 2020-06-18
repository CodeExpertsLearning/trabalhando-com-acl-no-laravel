<?php
namespace App\Http\Views;

class MenuViewComposer
{
	public function compose($view)
	{
		$roleUser = auth()->user()->role;

		$modulesFiltered = [];

		foreach($roleUser->modules as $key => $module) {
			$modulesFiltered[$key]['name'] = $module->name;

			foreach($module->resources  as $resource) {
				if($resource->roles->contains($roleUser)) {
					$modulesFiltered[$key]['resources'][] = $resource;
				}
			}
		}

		return $view->with('modules', $modulesFiltered);
	}
}