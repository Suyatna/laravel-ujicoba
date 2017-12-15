@extends('layouts.app')
@section('judul', 'New Post')
@section('content')
<div class="container">
    <form action="{{ route('post.masuk') }}" method="post">

    {{ csrf_field() }}

    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Input Title Here">
    </div>

    <div class="form-group">
  <label for="sel1">Pilih Kategorit:</label>
  <select class="form-control" name="kategori">
    @foreach($kategori as $k)
        <option value="{{ $k->id }}">{{ $k->name }}</option>
    @endforeach
  </select>
</div>

    <div class="form-group">
        <label for="content">Content</label>
    <textarea name="content" rows="5" class="form-control"> {{ old('content') }} </textarea>
    </div>

    <input type="submit" class="btn btn-primary" value="Kirim">
    </form>
</div>
@endsection
