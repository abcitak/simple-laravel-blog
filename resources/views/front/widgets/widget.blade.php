@isset($categories)
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <ul class="list-group">
            @foreach($categories as $category)
            <a href="{{route('Categories',$category->slug)}}">
                <li class="list-group-item @if(Request::segment(2) == $category->slug) active @endif">{{$category->name}}
                    <span style="float: right" class="badge bg-danger">{{$category->PostCount()}}</span>
                </li>
            </a>
            @endforeach
        </ul>
    </div>
</div>
@endisset
