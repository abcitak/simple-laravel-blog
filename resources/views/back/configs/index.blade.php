@extends('back.layouts.master')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Ayarlar</h6>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{route('config.update')}}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Site Başlığı</label>
                    <input type="text" name="site_title" value="{{$config->site_title}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Durumu</label>
                        <select name="active" value="" class="form-control">
                            <option  @if($config->active == 1) selected @endif value="1">Açık</option>
                            <option @if($config->active == 0) selected @endif value="0">Kapalı</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Site Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Site Favicon</label>
                    <input type="file" name="favicon" class="form-control">
                </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Facebook</label>
                        <input type="text" name="facebook" value="{{$config->facebook}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Twitter</label>
                    <input type="text" name="twitter" value="{{$config->twitter}}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Github</label>
                        <input type="text" name="github" value="{{$config->github}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Linkedin</label>
                    <input type="text" name="linkedin" value="{{$config->linkedin}}" class="form-control">
                </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Youtube</label>
                        <input type="text" name="youtube" value="{{$config->youtube}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Instagram</label>
                    <input type="text" name="instagram" value="{{$config->instagram}}" class="form-control">
                </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-md btn-success">Güncelle</button>
            </div>
        </form>
    </div>
</div>

@endsection
