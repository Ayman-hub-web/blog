<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('lib/bs4/bootstrap.min.css')}}" type="text/css">
    <!-- JQuery -->
    <script type="text/javascript" src="{{asset('lib/jquery-3.5.1.min.js')}}"></script>
    <!-- JS -->
    <script type="text/javascript" src="{{asset('lib/bs4/bootstrap.bundle.min.js')}}"></script>
    <!-- @if(Auth::check())
<script type="text/javascript"> 
    window.location.href="{{url('/login')}}";
</script>
@endif -->
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{url('/home')}}">CodeArtisanLab</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('showCategories') }}">Categories</a>
        </li>
        @guest
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('login') }}">login</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('register') }}">register</a>
        </li>
        @else
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('savePostForm') }}">Add Post</a>
        </li>
        <li class="nav-item">
		        <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{url('logout')}}">Logout</a>
		      </li>
		      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            	</form>
        <li class="nav-item">
            <a class="nav-link" href="#">My Account</a>
        </li>
        @endguest
        </ul>
    </div>
    </nav>
    <div class="container mt-4">
    <div class="row">
            <div class="col-md-8">
                @yield('content')
            </div>
            <div class="col-md-4">
            <!-- Search -->
                <div class="card mb-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                    <form action="{{ route('home') }}" method="post">
                    @csrf
                        <div class="input-group">
                            <input type="text" name="q" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="submit" id="button-addon2">Search</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Recent Posts -->
            <div class="card mb-4">
                    <h5 class="card-header">Recent Posts</h5>
                    <div class="list-group list-group-flush">
                    @foreach($recent_posts as $recent_post)
                        <a href="{{url('detail/'.Str::slug($recent_post->title).'/'.$recent_post->id)}}" class="list-group-item">{{$recent_post->title}}</a>
                    @endforeach
                    </div>
            </div>
            <!-- Popular Posts -->
            <div class="card mb-4">
                    <h5 class="card-header">Popular Posts</h5>
                    <div class="list-group list-group-flush">
                    @foreach($popular_posts as $popular_post)
                        <a href="{{url('detail/'.Str::slug($popular_post->title).'/'.$popular_post->id)}}" class="list-group-item">{{$popular_post->title}} <span class="badge badge-info float-right">{{$popular_post->views}}</span></a>
                    @endforeach
                    </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>