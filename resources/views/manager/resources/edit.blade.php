@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Editar Recurso Sistema</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
            <form action="{{route('resources.update', $resource->id)}}"  method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nome do Recurso</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Ex.: Listar Tópicos" value="{{$resource->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Recurso (recurso.subrecurso)</label>
                    <input type="text" class="form-control @error('resource') is-invalid @enderror" name="resource" placeholder="Ex.: threads.index" value="{{$resource->resource}}">
                    @error('resource')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Faz parte do menu?</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="isMenu1" name="is_menu" class="custom-control-input" value="1" @if($resource->is_menu) checked @endif>
                        <label class="custom-control-label" for="isMenu1">Sim</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="isMenu2" name="is_menu" class="custom-control-input" value="0"  @if(!$resource->is_menu) checked @endif>
                        <label class="custom-control-label" for="isMenu2">Não</label>
                    </div>

                </div>

                <div class="form-group">
                    <button class="btn btn-success">Atualizar Recurso</button>
                </div>
            </form>
        </div>
    </div>

@endsection