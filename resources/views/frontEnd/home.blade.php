@extends('frontEnd.layout.original')
@section('content')

                <div class="row mb-4">
                    @if(count($posts) > 0 )
                        @foreach($posts as $post)
                            <div class="col-md-3">
                                <div class="card">
                                <a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}"><img src="{{asset('imgs/thumb/'.$post->thumb)}}" class="card-img-top" height="200px" width="200"></a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}">{{$post->title}}</a></h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="alert alert-danger">No Post found</p>
                    @endif
                </div>
                {{ $posts->links() }}
@endsection