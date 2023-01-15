@extends('back.layouts.master')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{$pages->count()}} sayfa bulundu
        </h6>
    </div>
    <div class="card-body">
        <div id="orderAlert" style="display: none;" class="alert alert-success">
            Sıralama işlemi başarılı!
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Resim</th>
                        <th>Sayfa Adı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody id="orders">
                    @foreach($pages as $page)
                    <tr id="page_{{$page->id}}">
                        <td width="3px" style="cursor: move;text-align:center"><i class="fa fa-arrows-alt fa-2x handle"></i></td>
                        <td><img src="{{asset($page->image)}}" alt="" width="100px"></td>
                        <td>{{$page->title}}</td>
                        <td>
                            <input type="checkbox" class="switch" page-id="{{$page->id}}" data-on="Aktif" data-off="Pasif" @if($page->status == 1) checked @endif data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                        </td>
                        <td>
                            <a target="_blank" href="{{route('pages',$page->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('page.update.process',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('page.delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
<style>
    .ui-sortable-helper {
        background: #EBEBEB;
    }
</style>
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $('#orders').sortable({
        'handle' : '.handle',
        'update' : function()
        {
            var data = $('#orders').sortable('serialize');

            $.get("{{route('page.orders')}}?"+data, function(data,status){
                $('#orderAlert').show().delay(2000).fadeOut();
            });
        }
    });
</script>
<script>
  $(function() {
    $('.switch').change(function() {
        id = $(this)[0].getAttribute('page-id');
        statu = $(this).prop('checked');
        $.get("{{route('admin.page.switch')}}", {id:id,statu:statu}, function(data, status){});
    })
  })
</script>
@endsection
