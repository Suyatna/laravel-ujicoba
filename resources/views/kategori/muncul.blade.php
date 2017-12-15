@extends('layouts.app')
@section('judul', 'Kategori '.$posts[0]->kategori->name)


@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posting Kategori {{ $posts[0]->kategori->name }}</div>
                </div>
            </div>
        </div>

    @foreach($posts as $p)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <a href="{{ route('post.show', ['slug' => $p->slug]) }}">{{ $p->title }}</a> </div>

                <div style="padding:10px">
                   <p> {{ $p->content }} </p><br>
                   Kategori : <a href="{{ route('show.kategori', ['nama' => $p->kategori->slug]) }}" class="btn btn-info" >
                              <i>{{ $p->kategori->name }}</i>
                            </a><br>
                   User    : <a href="{{ route('show.user', ['nama' => $p->user->id]) }}" class="btn btn-primary" >
                              <i>{{ $p->user->name }}</i>
                              </a>

                              @if(Auth::user()->id == $p->user->id)
                              <a href="{{ route('post.edit', ['id_post' => $p->slug]) }}" class="btn btn-success" >
                              <i>edit</i>
                              </a>
                              <a href="{{ route('post_delete', ['id_post' => $p->id]) }}" class="btn btn-danger" >
                              <i>hapus</i>
                              </a>
                              @endif
                   </div>
            </div>
        </div>
        @endforeach

    </div>
</div>


@endsection
