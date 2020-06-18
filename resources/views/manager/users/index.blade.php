@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Usuários Sistema</h2>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Papél</th>
                    <th>Criado Em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        {{$user->role()->count() ? $user->role->name : 'Sem papél associado!'}}
                    </td>
                    <td>{{$user->created_at->format('d/m/Y H:i:s')}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-sm btn-primary">EDITAR</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum usuário cadastrado!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$users->links()}}
    </div>

@endsection