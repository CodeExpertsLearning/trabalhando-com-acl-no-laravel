@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Módulos Sistema</h2>
            <a href="{{route('modules.create')}}" class="btn btn-success">Criar Módulo</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Total de Recursos</th>
                    <th>Criado Em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @forelse($modules as $module)
                <tr>
                    <td>{{$module->id}}</td>
                    <td>{{$module->name}}</td>
                    <td>{{$module->resources->count()}}</td>
                    <td>{{$module->created_at->format('d/m/Y H:i:s')}}</td>
                    <td>
                        <div class="btn-group">

                            <a href="{{route('modules.edit', $module->id)}}" class="btn btn-sm btn-primary">EDITAR</a>
                            <form action="{{route('modules.destroy', $module->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">REMOVER</button>
                            </form>
                            <a href="{{route('modules.resources', $module->id)}}" class="btn btn-sm btn-dark">Adicionar Recursos</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum módulo cadastrado!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$modules->links()}}
    </div>

@endsection