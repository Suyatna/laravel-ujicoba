@extends('layouts.app')
@section('judul', $post->title)
@section('content')
<div class="container">
    <form action="{{ route('post.save_edit', ['id_post' => $post->slug]) }}" method="post">

    {{ csrf_field() }}

    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $post->title }}" placeholder="Input Title Here">
    </div>

    <div class="form-group">
  <label for="sel1">Pilih Kategorit:</label>
  <select class="form-control" name="kategori">
    @foreach($kategori as $k)

      @if($k->id == $post->categories_id)
        <option value="{{ $k->id }}">{{ $k->name }}</option>
       @else
       <option value="{{ $k->id }}">{{ $k->name }}</option>
       @endif

    @endforeach
  </select>
</div>

    <div class="form-group">
        <label for="content">Content</label>
    <textarea name="content" rows="5" class="form-control">{{ $post->content }}</textarea>
    </div>

    <input type="submit" class="btn btn-primary" value="Kirim">
    </form>
</div>
@endsection
