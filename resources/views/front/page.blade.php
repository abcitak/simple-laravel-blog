@extends('front.layouts.master')
@section('site_title',$page->title )

@section('content')

    <div class="col-md-12 col-lg-12 col-xl-12">
        {!! $page->content !!}
    </div>
@endsection
