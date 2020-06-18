@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Recursos Sistema</h2>
            <a href="{{route('resources.create')}}" class="btn btn-success">Criar Recurso</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Recurso</th>
                    <th>Criado Em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @forelse($resources as $resource)
                <tr>
                    <td>{{$resource->id}}</td>
                    <td>{{$resource->name}}: <span class="badge badge-primary">{{$resource->resource}}</span></td>
                    <td>{{$resource->created_at->format('d/m/Y H:i:s')}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('resources.edit', $resource->id)}}" class="btn btn-sm btn-primary">EDITAR</a>
                            <form action="{{route('resources.destroy', $resource->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">REMOVER</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum recurso cadastrado!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$resources->links()}}
    </div>

@endsection