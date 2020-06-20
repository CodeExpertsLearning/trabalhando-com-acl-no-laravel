<?php
namespace App\Http\Views;

use App\Module;

class MenuViewComposer
{
	private $module;

	public function __construct(Module $module)
	{
		$this->module = $module;
	}

	public function compose($view)
	{
		$user = auth()->user();

		$modulesFiltered = session()->get('modules')?: [];

		if(!$modulesFiltered) {

			if($user->isAdmin()) {
				$modulesFiltered = $this->module->with('resources')->get()->toArray();
			} else {

				foreach($user->role->modules as $key => $module) {
					$modulesFiltered[$key]['name'] = $module->name;

					foreach($module->resources  as $k => $resource) {
						if($resource->roles->contains($user->role)) {

							$modulesFiltered[$key]['resources'][$k]['name'] = $resource->name;
							$modulesFiltered[$key]['resources'][$k]['resource'] = $resource->resource;
						}
					}
				}

			}

			session()->put('modules', $modulesFiltered);
		}

		return $view->with('modules', $modulesFiltered);
	}
}