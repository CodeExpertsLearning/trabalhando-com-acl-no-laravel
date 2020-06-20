@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Criar Módulo</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
            <form action="{{route('modules.store')}}" method="post">
                @csrf

                <div class="form-group">
                    <label>Nome do Módulo</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Ex.: Configurações" value="{{old('name')}}">

                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-success">Criar Módulo</button>
                </div>
            </form>
        </div>
    </div>

@endsection