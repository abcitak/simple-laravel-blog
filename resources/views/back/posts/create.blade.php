@extends('back.layouts.master')
@section('admin_title','Makele Oluştur')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Makale Oluştur</h6>
    </div>
    <div class="card-body">
        @if($errors->any())

        <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
        @endif
            <form action="{{route('makaleler.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Makale Başlığı</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select required name="category" class="form-control">
                        <option value="">Seçiniz</option>
                       @foreach($categories as $category)
                       <option value="{{$category->id}}">{{$category->name}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Fotoğraf</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">İçerik</label>
                    <textarea id="editor" name="content" class="form-control" required >{{old('content')}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
    </div>
</div>

@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
$(document).ready(function() {
  $('#editor').summernote({'height' : 300});
});
</script>
@endsection
