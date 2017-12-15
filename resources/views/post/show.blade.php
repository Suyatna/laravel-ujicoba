@extends('layouts.app')
@section('judul', $post->title)

@section('content')

<div class="container">
    <div class="col-md-12">
      <div class="panel panel-default">
          <div class="panel-heading">{{ $post->title }}</div>

          <div class="panel-body">
              {{ $post->content }}
          </div>
      </div>
    </div>

    <div class="col-md-6">
      <form action="{{ route('save_komen', ['slug' => $post->slug])}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
        <input type="hidden" name="id_post" value="{{ $post->id }}">
        <div class="form-group">
          <textarea name="content" rows="5" class="form-control"> {{ old('content') }}</textarea>
        </div>

        @if($errors->has('content'))
        <span class="text-danger">{{ $errors->first('content') }}</span><br>
        @endif

        <input type="submit" class="btn btn-info" value="Komen">

      </form>

    </div>

    <div class="col-md-12">
      <center><h2>Komentar</h2></center>

      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

      @foreach($post->comment as $comment)
      <div class="panel panel-default">
          <div class="panel-heading">{{ $comment->user->name }}</div>

          <div class="panel-body">
            {{ $comment->message }}
          </div>
      </div>
      @endforeach

    </div>
</div>


@endsection
