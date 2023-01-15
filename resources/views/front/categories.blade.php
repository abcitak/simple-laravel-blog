@extends('front.layouts.master')
@section('site_title',$category->name.' Kategorisi')

@section('content')
                <div class="col-md-8">
                    <!-- Post preview-->
                @if(count($posts) > 0)
                    @foreach($posts as $post)
                    <div class="post-preview">
                        <a href="{{route('singlePost',[$post->getCategory->slug,$post->slug])}}">
                            <h2 class="post-title">{{$post->title}}</h2>
                            <h3 class="post-subtitle">{{Str::limit($post->content,75)}}</h3>
                        </a>
                        <p class="post-meta">
                            {{$post->getCategory->name}}
                            <span style="float:right">{{$post->created_at->diffForHumans()}}</span>
                        </p>
                    </div>
                    @endforeach
                    {{$posts->links()}}
                    <hr class="my-4" />
                    <!-- Pager-->
                    @else
                        <div class="alert alert-primary">
                            {{$category->name}} kategorisine ait yazı bulunamadı
                        </div>
                    @endif
                </div>



       @include('front.widgets.widget')
@endsection
