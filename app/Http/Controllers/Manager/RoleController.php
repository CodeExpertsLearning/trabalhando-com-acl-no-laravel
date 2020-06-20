<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\RoleRequest;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
	/**
	 * @var Role
	 */
	private $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$roles = $this->role->paginate(10);

        return view('manager.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('manager.roles.create');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param RoleRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(RoleRequest $request)
    {
	    try {
	    	$this->role->create($request->all());

		    flash('Papél criado com sucesso!')->success();
		    return redirect()->route('roles.index');

	    }catch (\Exception $e) {
		    $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar criação...';

		    flash($message)->error();
		    return redirect()->back();
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('roles.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$role = $this->role->find($id);
	    return view('manager.roles.edit', compact('role'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param RoleRequest $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(RoleRequest $request, $id)
    {
	    try {
		    $role = $this->role->find($id);
		    $role->update($request->all());

		    flash('Papél atualizado com sucesso!')->success();
		    return redirect()->route('roles.index');

	    }catch (\Exception $e) {
		    $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar atualização...';

		    flash($message)->error();
		    return redirect()->back();
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
			$role = $this->role->find($id);
			$role->delete();

			flash('Papél removido com sucesso!')->success();
			return redirect()->route('roles.index');

        }catch (\Exception $e) {
        	$message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar remoção...';

        	flash($message)->error();
        	return redirect()->back();
        }
    }

	/**
	 * @param int $role
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function syncResources(int $role)
	{
		$role = $this->role->find($role);
		$resources = \App\Resource::all(['id', 'resource']);

		return view('manager.roles.sync-resources', compact('role', 'resources'));
	}

	/**
	 *
	 */
	public function updateSyncResources($role, Request $request)
	{
		try{
			$role = $this->role->find($role);
			$role->resources()->sync($request->resources);

			flash('Recursos adicionados com sucesso!')->success();
			return redirect()->route('roles.resources', $role);

		}catch (\Exception $e) {
			$message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar adição de recursos...';

			flash($message)->error();
			return redirect()->back();
		}
	}
}
