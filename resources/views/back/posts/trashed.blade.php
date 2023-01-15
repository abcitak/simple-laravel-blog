@extends('back.layouts.master')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{$posts->count()}} makale bulundu</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Tarih</th>
                        <th>Hit</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td><img src="{{asset($post->image)}}" alt="" width="100px"></td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->getCategory->name}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->hit}}</td>

                        <td>
                            <a href="{{route('admin.delete.recovery',$post->id)}}" title="Geri Al" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('admin.delete.hardDelete',$post->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function() {
    $('.switch').change(function() {
        id = $(this)[0].getAttribute('post-id');
        statu = $(this).prop('checked');
        $.get("{{route('admin.switch')}}", {id:id,statu:statu}, function(data, status){});
    })
  })
</script>
@endsection
