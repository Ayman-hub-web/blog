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
              <i class="fas fa-table"></i> All Categories
              <a href="{{route('category.create')}}" class="float-right btn btn-sm btn-dark">Add Category</a>
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
                            <th scope="col">Title</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->title}}</td>
                            <td>{{$category->detail}}</td>
                            <td><img src="{{asset('imgs/'.$category->image)}}" width="70"></td>
                            <td>
                                <a href="{{route('category.edit', $category->id)}}" class="btn btn-warning float-left mr-1">Edit</a>
                                <form action="{{route('category.destroy', $category->id)}}" method="post">
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
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
@endsection