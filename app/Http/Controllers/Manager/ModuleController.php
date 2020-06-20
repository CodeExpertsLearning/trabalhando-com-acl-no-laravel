<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Resource;
use Illuminate\Http\Request;
use App\Module;
use App\Http\Requests\Manager\ModuleRequest;

class ModuleController extends Controller
{
	/**
	 * @var Module
	 */
	private $module;

	public function __construct(Module $module)
	{
		$this->module = $module;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$modules = $this->module->paginate(10);

		return view('manager.modules.index', compact('modules'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('manager.modules.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param ModuleRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(ModuleRequest $request)
	{
		try {
			$this->module->create($request->all());

			flash('Módulo criado com sucesso!')->success();
			return redirect()->route('modules.index');

		} catch (\Exception $e) {
			$message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar atualização...';

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
		return redirect()->route('modules.edit', $id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @param Resource $resource
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$module = $this->module->find($id);

		return view('manager.modules.edit', compact('module'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param ModuleRequest $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(ModuleRequest $request, $id)
	{
		try {
			$module = $this->module->find($id);
			$module->update($request->all());

			flash('Módulo atualizado com sucesso!')->success();
			return redirect()->route('modules.index');

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
			$module = $this->module->find($id);
			$module->delete();

			flash('Módulo removido com sucesso!')->success();
			return redirect()->route('modules.index');

		}catch (\Exception $e) {
			$message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar remoção...';

			flash($message)->error();
			return redirect()->back();
		}
	}

	public function syncResources(Module $module, Resource $resource)
	{
		$resources = $resource->whereNull('module_id')
		                     ->where('is_menu', true)
		                     ->get();

		return view('manager.modules.sync-resources', compact('module', 'resources'));
	}

	public function updateSyncResources(Module $module, Request $request, Resource $resource)
	{
		try{
			foreach($request->resources as $r) {
				$resourceModel = $resource->find($r);
				$resourceModel->module()->associate($module);
				$resourceModel->save();
			}

			flash('Recursos adicionados para o módulo!')->success();
			return redirect()->back();
		} catch (\Exception $e) {
			$message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar adição de recursos para o módulo...';

			flash($message)->error();
			return redirect()->back();
		}
	}
}
