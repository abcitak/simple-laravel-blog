@extends('front.layouts.master')
@section('site_title','Anasayfa')

@section('content')
<div class="col-md-8">
 <!-- Post preview-->
    @foreach($posts as $post)
    <div class="post-preview">
        <a href="{{route('singlePost',[$post->getCategory->slug,$post->slug])}}">
            <h2 class="post-title">{{$post->title}}</h2>
            <h3 class="post-subtitle">{{Str::limit($post->content,75)}}</h3>
        </a>
        <p class="post-meta">
            <a href="#!">{{$post->getCategory->name}}</a>
            <span style="float:right">{{$post->created_at->diffForHumans()}}</span>
        </p>
    </div>
    @endforeach
{{$posts->links()}}


    <!-- Pager-->
</div>



       @include('front.widgets.widget')
@endsection
