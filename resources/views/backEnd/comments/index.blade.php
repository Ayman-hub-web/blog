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
              <i class="fas fa-table"></i> All Comments
            </div>
            <div class="card-body">
              <div class="table-responsive">
              @if(Session::has('success'))
                <div class="text-success">
                    {{Session::get('success')}}
                </div>
              @endif
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Comment</th>
                            <th scope="col">User</th>
                            <th scope="col">Post</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                            <th scope="row">{{$comment->id}}</th>
                            <td>{{$comment->comment}}</td>
                            <td>@if(!empty($comment->user_id)) {{$comment->user->name}} @endif</td>
                            <td>{{$comment->post_id}}</td>
                            <td><a href="{{route('admin.comment.delete', $comment->id)}}" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
@endsection