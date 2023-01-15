@extends('back.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="{{route('category.create')}}" method="post">
                    @csrf
                    <label for="">Kategori Adı</label>
                    <input type="text" name="category" required class="form-control"><br>
                    <button type="submit" class="btn btn-primary btn-block">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tüm Kategoriler</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Toplam Makale</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->PostCount()}}</td>
                                <td>
                                    <input type="checkbox" class="switch" category-id="{{$category->id}}" data-on="Aktif" data-off="Pasif" @if($category->status == 1) checked @endif data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                </td>
                                <td>
                                    <a category-id="{{$category->id}}" title="Düzenle" class="btn btn-sm btn-primary edit-click" data-toggle="modal" data-target="#editModal"><i class="fa fa-pen"></i></a>


                                    <a category-id="{{$category->id}}" category-count="{{$category->PostCount()}}" title="Sil" class="btn btn-sm btn-danger remove-click" category-name="{{$category->name}}" data-toggle="modal" data-target="#removeModal"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

 <!-- Remove Modal -->
 <div id="removeModal" class="modal fade remove" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Sil</h4>
                </div>
                <div class="modal-body">
                    <div id="removeAlert" class="alert alert-danger "></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <form action="{{route('category.delete')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="category_id">
                        <button type="submit" id="removeButton" class="btn btn-success">Sil</button>
                    </form>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div id="editModal" class="modal fade edit" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategori Düzenle</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('category.update')}}" method="POST">
                        @csrf
                        <label for="">Kategori Adı</label>
                        <input type="text" name="category" class="form-control" id="category" required>
                        <input type="hidden" name="id" id="category_id">
                        <label for="">Kategori Kısa Ad</label>
                        <input type="text" name="slug" class="form-control" id="slug" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </div>
            </form>
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

        $('.remove-click').click(function() {
            id = $(this)[0].getAttribute('category-id');
            count = $(this)[0].getAttribute('category-count');
            name = $(this)[0].getAttribute('category-name');
            $('#category_id').val(id);
            if(id == 1)
            {
                $('#removeAlert').html('Genel kategorisi silinemez. Silinen diğer kategorilere ait makaleler buraya eklenecektir.');
                $('#removeAlert').show();
                $('#removeButton').hide();
                return;
            }
            $('#removeAlert').html('');
            $('#removeAlert').hide();

            if(count > 0)
            {
                $('#removeAlert').html(count+" makalesi bulunan <b>"+ name + "</b> kategorisini silmek istiyor musunuz ?");
                $('#removeAlert').show();
            }

            $('#removeButton').show();


        });

        $('.edit-click').click(function() {
            id = $(this)[0].getAttribute('category-id');
            $.ajax({
                url: '{{route("category.getData")}}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#category').val(data.name);
                    $('#slug').val(data.slug);
                    $('#category_id').val(data.id);
                }
            });
        });

        $('.switch').change(function() {
            id = $(this)[0].getAttribute('category-id');
            statu = $(this).prop('checked');
            $.get("{{route('category.switch')}}", {
                id: id,
                statu: statu
            }, function(data, status) {});
        })
    })
</script>
@endsection
