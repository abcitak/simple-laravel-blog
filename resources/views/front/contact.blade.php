@extends('front.layouts.master')
@section('site_title',"İletişim" )

@section('content')

    <div class="col-md-10 col-lg-8 col-xl-7">
        <p>İstediğiniz zaman bizimle iletişime geçebilirsiniz</p>
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                       <li> {{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="my-5">
            <form action="{{route('contact.post')}}" method="POST">
                @csrf
                <div class="control-group">
                <div class="form-floating">
                    <input type="text" name="name" id="name" required class="form-control" value="{{old('name')}}" placeholder="Ad Soyad">
                    <label for="name">Ad Soyad</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" id="email" type="email" value="{{old('email')}}"  name="email" placeholder="Enter your email..." required />
                    <label for="email">E-Posta</label>

                </div>
                <div class="form-floating">
                    <select name="subject" class="form-select">
                        <option value="">Konu Seçiniz</option>
                        <option @if(old('subject') == 'Bilgi') selected @endif value="bilgi" >Bilgi</option>
                        <option @if(old('subject') == 'Destek') selected @endif value="destek">Destek</option>
                        <option @if(old('subject') == 'Genel') selected @endif value="genel" >Genel</option>
                        <label for="subject">Konu</label>

                    </select>

                </div>
                <div class="form-floating">
                    <textarea class="form-control" id="message" value="{{old('message')}}"  name="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                    <label for="message">Mesajınız</label>
                </div>
                <br />

                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>

                </div>
            </form>
        </div>
    </div>
@endsection
