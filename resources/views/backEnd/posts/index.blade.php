@extends('backEnd.originalDashboard')
@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>


          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> All Posts
              <a href="{{route('post.create')}}" class="float-right btn btn-sm btn-dark">Add Post</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                 @if(Session::has('success'))
                     <p class="text-success">{{session('success')}}</p>
                 @endif
                 @if(Session::has('error'))
                     <p class="text-danger">{{session('error')}}</p>
                 @endif
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">user_id</th>
                            <th scope="col">Category</th>
                            <th scope="col">Title</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Post Image</th>
                            <th scope="col">Post Thumb</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td>{{$post->user_id}}</td>
                            <td>{{$post->category->title}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->detail}}</td>
                            <td>{{$post->tags}}</td>
                            <td><img src="{{asset('imgs/full/'.$post->full_image)}}" width="50"></td>
                            <td><img src="{{asset('imgs/thumb/'.$post->thumb)}}" width="50"></td>
                            <td>
                                <a href="{{route('post.edit', $post->id)}}" class="btn btn-warning float-left mr-1">Edit</a>
                                <form action="{{route('post.destroy', $post->id)}}" method="post" class="float-left">
                                  @csrf 
                                  @method('delete')
                                  <input type="submit" value="Delete" class="btn btn-danger">
                                </form>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
              </div>
            </div>
          </div>
@endsection