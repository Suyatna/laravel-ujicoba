@extends('layouts.app')
@section('judul', $user->name)

@section('content')

  <div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 style="padding:15px">{{ $user->name }}</h4>
                  <h5>{{ $user->email }}</h5>
                </div>
              </div>
            </div>

            <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <center><h2>Post User</h2></center>
                </div>
              </div>
            </div>

            @foreach($user->post as $s)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a href="{{ route('post.show', ['slug' => $s->slug]) }}">{{ $s->title }}</a> </div>

                    <div style="padding:10px">
                       <p> {{ $s->content }} </p><br>
                       Kategori : <a href="{{ route('show.kategori', ['nama' => $s->kategori->slug]) }}" class="btn btn-info" >
                                  <i>{{ $s->kategori->name }}</i>
                                </a><br>
                       User    : <a href="{{ route('show.user', ['nama' => $user->id]) }}" class="btn btn-primary" >
                                  <i>{{ $user->name }}</i>
                                  </a>

                                  @if(Auth::user()->id == $s->user->id)
                                  <a href="{{ route('post.edit', ['id_post' => $s->slug]) }}" class="btn btn-success" >
                                  <i>edit</i>
                                  </a>
                                  <a href="{{ route('post_delete', ['id_post' => $s->id]) }}" class="btn btn-danger" >
                                  <i>hapus</i>
                                  </a>
                                  @endif
                       </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
  </div>


@endsection
