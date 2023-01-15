@extends('front.layouts.master')
@section('site_title',$post->title )

@section('content')

                <div class="col-md-8 col-lg-5 col-xl-7">
                    <div class="text-primary">Okunma Sayısı : {{$post->hit}}</div>
                    <hr>
                    {!! $post->content !!}
                </div>

       @include('front.widgets.widget');

@endsection
