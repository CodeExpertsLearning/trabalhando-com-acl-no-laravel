@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Criar Recurso Sistema</h2>
        </div>
    </div>

    <div class="row">
       <div class="col-md-12">
           <hr>
           <form action="{{route('resources.store')}}"  method="post">
               @csrf
               <div class="form-group">
                   <label>Nome do Recurso</label>
                   <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Ex.: Listar Tópicos">

                   @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                   @enderror
               </div>

               <div class="form-group">
                   <label>Recurso (recurso.subrecurso)</label>
                   <input type="text" class="form-control @error('name') is-invalid @enderror" name="resource" placeholder="Ex.: threads.index">
                   @error('resource')
                   <div class="invalid-feedback">
                       {{$message}}
                   </div>
                   @enderror
               </div>

               <div class="form-group">
                   <label> Faz parte do menu?</label>
                   <div class="custom-control custom-radio">
                       <input type="radio" id="isMenu1" name="is_menu" class="custom-control-input  @error('is_menu') is-invalid @enderror" value="1">
                       <label class="custom-control-label" for="isMenu1">Sim</label>
                   </div>

                   <div class="custom-control custom-radio">
                       <input type="radio" id="isMenu2" name="is_menu" class="custom-control-input  @error('is_menu') is-invalid @enderror" value="0">
                       <label class="custom-control-label" for="isMenu2">Não</label>
                   </div>

               </div>

               <div class="form-group">
                   <button class="btn btn-success">Cadastrar Recurso</button>
               </div>
           </form>
       </div>
    </div>

@endsection