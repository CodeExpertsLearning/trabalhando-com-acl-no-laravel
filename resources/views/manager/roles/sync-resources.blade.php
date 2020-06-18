@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Sincronizar Papél: <strong>{{$role->name}}</strong> e Recursos</h2>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <hr>
            <form action="{{route('roles.resources.update', $role->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    @foreach($resources as $resource)
                        <div class="col-md-4 pt-4 pb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       name="resources[]"
                                       class="custom-control-input"
                                       id="customCheck{{$resource->id}}"
                                       value="{{$resource->id}}"
                                       @if($role->resources->contains($resource)) checked @endif
                                >
                                <label class="custom-control-label" for="customCheck{{$resource->id}}">{{$resource->resource}}</label>
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group col-md-12">
                        <div class="">
                            <hr>
                            <button class="btn btn-success" type="submit">Adicionar Recursos ao Papél</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection