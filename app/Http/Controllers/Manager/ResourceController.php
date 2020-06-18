<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ResourceRequest;
use App\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
	/**
	 * @var Resource
	 */
	private $resource;

	public function __construct(Resource $resource)
	{
		$this->resource = $resource;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$resources = $this->resource->paginate(10);

		return view('manager.resources.index', compact('resources'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('manager.resources.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param ResourceRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(ResourceRequest $request)
	{
		try {
			$this->resource->create($request->all());

			flash('Recurso atualizado com sucesso!')->success();
			return redirect()->route('resources.index');

		}catch (\Exception $e) {
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
		return redirect()->route('resources.edit', $id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$resource = $this->resource->find($id);
		return view('manager.resources.edit', compact('resource'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param ResourceRequest $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(ResourceRequest $request, $id)
	{
		try {
			$resource = $this->resource->find($id);
			$resource->update($request->all());

			flash('Recurso atualizado com sucesso!')->success();
			return redirect()->route('resources.index');

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
			$resource = $this->resource->find($id);
			$resource->delete();

			flash('Recurso removido com sucesso!')->success();
			return redirect()->route('resources.index');

		}catch (\Exception $e) {
			$message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar remoção...';

			flash($message)->error();
			return redirect()->back();
		}
	}
}
