@extends('frontEnd.layout.original')
@section('content')
    <div class="row mt-4">
    @foreach($categoryPosts as $post)
        <div class="col-md-6 mx-auto">
            <div class="card">
            <h5 class="card-title pt-4 text-center">{{$post->title}}</h5>
                <img src="{{asset('imgs/thumb/'.$post->thumb)}}" class="card-img-top" height="200">
            </div>
        </div>
    @endforeach
    </div>
@endsection