@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Criar Tópico</h2>
            <hr>
        </div>
        <div class="col-12">
            <form action="{{route('threads.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Escolha um canal para o tópico</label>
                    <select name="channel_id" id="" class="form-control @error('channel_id') is-invalid  @enderror">
                        <option value="">Selecione um canal</option>
                        @foreach($channels as $channel)

                            <option value="{{$channel->id}}"
                                @if(old('channel_id') == $channel->id) selected @endif
                            >{{$channel->name}}</option>

                        @endforeach
                    </select>
                    @error('channel_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Titulo Tópico</label>
                    <input type="text" class="form-control @error('title') is-invalid  @enderror" name="title" value="{{old('title')}}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Conteúdo Tópico</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid  @enderror">{{old('body')}}</textarea>
                    @error('body')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-lg btn-success">Criar Tópico</button>
            </form>
        </div>
    </div>
@endsection