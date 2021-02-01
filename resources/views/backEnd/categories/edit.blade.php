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
              <i class="fas fa-table"></i> Edit Category
              <a href="{{route('category.index')}}" class="float-right btn btn-sm btn-dark">All Data</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                @if($errors)
                  @foreach($errors->all() as $error)
                    <p class="text-danger">{{$error}}</p>
                  @endforeach
                @endif

                @if(Session::has('success'))
                <p class="text-success">{{session('success')}}</p>
                @endif
                @if(Session::has('error'))
                <p class="text-danger">{{session('error')}}</p>
                @endif

                <form method="post" action="{{route('category.update', $category->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <table class="table table-bordered">
                      <tr>
                          <th>Title</th>
                          <td><input type="text" name="title" class="form-control" value="{{$category->title}}" /></td>
                      </tr>
                      <tr>
                          <th>Detail</th>
                          <td><input type="text" name="detail" class="form-control" value="{{$category->title}}" /></td>
                      </tr>
                      <tr>
                          <th>Image</th>
                          <td> <img src="{{asset('imgs/'.$category->image)}}" width="70"></td>
                          <td>
                          <input type="file" name="cat_image" />
                          <input type="hidden" name="cat_image"  value="{{$category->image}}" />
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <input type="submit" class="btn btn-primary" value ="Update" />
                          </td>
                      </tr>
                  </table>
                </form>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
@endsection