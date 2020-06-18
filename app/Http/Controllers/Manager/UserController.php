<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\UserRequest;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
	/**
	 * @var User
	 */
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = $this->user->paginate(10);

        return view('manager.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles = \App\Role::all('id', 'name');

        return view('manager.users.edit', compact('user', 'roles'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UserRequest $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(UserRequest $request, $id)
    {
        try{
        	$data = $request->all();

        	if($data['password']){

        		$validator = Validator::make($data, [
        			'password' => 'required|string|min:8|confirmed'
		        ]);

        		if($validator->fails())
        			return redirect()->back()->withErrors($validator);

				$data['password'] = bcrypt($data['password']);

	        } else {
        		unset($data['password']);
	        }

			$user = $this->user->find($id);
			$user->update($data);

			$role = \App\Role::find($data['role']);
			$user = $user->role()->associate($role);
			$user->save();

			flash('Usuário atualizado com sucesso!')->success();
			return redirect()->route('users.index');

        }catch (\Exception $e) {
	        $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar atualização...';

	        flash($message)->error();
	        return redirect()->back();
        }
    }
}
