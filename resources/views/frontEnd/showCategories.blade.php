@extends('frontEnd.layout.original')
@section('content')
    <div class="row mt-4">
    @foreach($categories as $category)
        <div class="col-md-6 mx-auto">
            <div class="card">
            <a href="{{ route('getCategoryPosts', $category->id) }}"><h5 class="card-title pt-4 text-center">{{$category->title}}</h5></a>
                <img src="{{asset('imgs/'.$category->image)}}" class="card-img-top" height="150">
                <a href="{{ route('getCategoryPosts', $category->id) }}"><p class="card-footer">This Category have {{$category->posts->count()}} {{Str::plural('post', $category->posts()->count())}}</p></a>
            </div>
        </div>
        @endforeach
    </div>
@endsection