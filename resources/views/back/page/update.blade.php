@extends('back.layouts.master')
@section('admin_title',$page->title.' sayfasını güncelle')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{$page->title}} Güncellemesi</h6>
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
            <form action="{{route('page.update',$page->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Makale Başlığı</label>
                    <input type="text" name="title" value="{{$page->title}}" class="form-control" required>
                </div>
                <hr>

                <hr>
                <div class="form-group">
                    <label for="">Fotoğraf</label><br>
                    <img src="{{asset($page->image)}}" width="300" class="img-thumbnail rounded" alt="">
                    <input type="file" name="image" class="form-control" >
                </div>
                <hr>
                <div class="form-group">
                    <label for="">İçerik</label>
                    <textarea id="editor" name="content" class="form-control" required >{!! $page->content !!}</textarea>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
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
  $('#editor').summernote({'minHeight' : 200});
});
</script>
<script src="{{asset('vendor/flasher/flasher-toastr.min.js')}}"></script>
@endsection
