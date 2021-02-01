@extends('frontEnd.layout.original')
@section('content')
    <div class="row mt-4">
        <div class="col-6 mx-auto text-center">
        @if(Session::has('success'))
        <div class="btn btn-success">{{Session::get('success')}}</div>
        @endif
            <div class="card">
                <h5 class="card-title pt-4">{{$detail->title}}</h5>
                <img src="{{asset('imgs/thumb/'.$detail->thumb)}}" class="card-img-top">
                <div class="card-body">
                    <p class="card-text">{{$detail->detail}}</p>
                    <span>{{$detail->views}} {{Str::plural('view', $detail->views)}}</span>
                </div>
                <div class="card-footer">
                    {{$detail->category->title}}
                </div>
            </div>
        </div>
    </div>
        <!-- Kommentare -->
    <div class="row">
        <div class="col-md-6 mt-5 mx-auto text-center">
        @auth
            <div class="card">
                <h5 class="card-header">Add Comment</h5>
                <div class="card-body">
                <form action="{{url('save_comment/'.Str::slug($detail->title).'/'.$detail->id)}}" method="post">
                    @csrf
                    <textarea name="comment" id="comment" class="form-control"></textarea>
                    @error('comment')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <input type="submit" value="Add Comment" class="btn btn-dark">
                </form>
                </div>
            </div>
        @endauth
            <div class="card">
            @if($detail->comments->count() > 0)
                <h5 class="card-header">Comments<span class="badge badge-dark">{{$detail->comments->count()}}</span></h5>
                @foreach($detail->comments as $comment)
                <blockquote class="blockquote">
                    <p class="mb-0">{{$comment->comment}}</p>
                    @if($comment->user_id == 0)
                    <footer class="blockquote-footer">Admin</footer>
                    @else
                    <footer class="blockquote-footer">{{$comment->user->name}}</footer>
                    @endif
                </blockquote>
                @endforeach
            @else
                <p>No Comments for this Post</p>
            @endif
            </div>
        </div>
    </div>
@endsection