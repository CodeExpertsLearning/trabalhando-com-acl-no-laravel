@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Adicionar Recursos para o módulo: <strong>{{$module->name}}</strong></h2>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <hr>
            <form action="{{route('modules.resources.update', $module->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    @forelse($resources as $resource)
                        <div class="col-md-4 pt-4 pb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       name="resources[]"
                                       class="custom-control-input"
                                       id="customCheck{{$resource->id}}"
                                       value="{{$resource->id}}"
                                       @if($module->resources->contains($resource)) checked @endif
                                >
                                <label class="custom-control-label" for="customCheck{{$resource->id}}">{{$resource->resource}}</label>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-danger">Nenhum recurso disponível</div>
                        </div>
                    @endforelse

                    <div class="form-group col-md-12">
                        <div class="">
                            <hr>
                            <button class="btn btn-success" type="submit">Adicionar Recursos ao Módulo</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection