@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>{{$thread->title}}</h2>
            <hr>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   <small> Criado por {{$thread->user->name}} a {{$thread->created_at->diffForHumans()}}</small>
                </div>
                <div class="card-body">
                    {{$thread->body}}
                </div>
                <div class="card-footer">
                    @can('update', $thread)
                        <a href="{{route('threads.edit', $thread->slug)}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="#" class="btn btn-sm btn-danger"
                           onclick="event.preventDefault(); document.querySelector('form.thread-rm').submit();">Remover</a>

                        <form action="{{route('threads.destroy', $thread->slug)}}" method="post"  class="thread-rm" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>
            </div>
            <hr>
        </div>

        @if($thread->replies->count())
        <div class="col-12">
            <h5>Respostas</h5>
            <hr>
            @foreach($thread->replies as $reply)
                <div class="card" style="margin-bottom: 15px;">
                    <div class="card-body">
                        {{$reply->reply}}
                    </div>
                    <div class="card-footer">
                        <small>Respondido por {{$reply->user->name}} a {{$reply->created_at->diffForHumans()}}</small>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
        @auth
            <div class="col-12">
                <hr>
                <form action="{{route('replies.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="thread_id" value="{{$thread->id}}">
                        <label>Responder</label>
                        <textarea name="reply" id="" cols="30" rows="5" class="form-control @error('reply') is-invalid @enderror">{{old('reply')}}</textarea>
                        @error('reply')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Responder</button>
                </form>
            </div>
        @else
            <div class="col-12 text-center">
                <h5>É preciso está logado para responder ao tópico!</h5>
            </div>
        @endauth
    </div>
@endsection