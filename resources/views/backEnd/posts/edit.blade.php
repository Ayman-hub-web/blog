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
              <i class="fas fa-table"></i> Edit Post
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

                <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <table class="table table-bordered">
                      <tr>
                          <th>Title</th>
                          <td><input type="text" name="title" class="form-control" value="{{$post->title}}"/></td>
                      </tr>
                      <tr>
                          <th>Category</th>
                          <td>
                            <select name="category" id="category" class="form-control">
                              @foreach($categories as $category)
                              <option @if($post->cat_id == $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                              @endforeach
                            </select>
                          </td>
                      </tr>
                      <tr>
                          <th>Thumbnail</th>
                          <td><img src="{{asset('imgs/thumb/'.$post->thumb)}}" width="60"></td>
                          <input type="hidden" name="post_thumb"  value="{{$post->thumb}}" />
                          <td><input type="file" name="post_thumb" class="form-control" /></td>
                      </tr>
                      <tr>
                          <th>Full Image</th>
                          <td><img src="{{asset('imgs/full/'.$post->full_image)}}" width="60"></td>
                          <input type="hidden" name="post_image"  value="{{$post->full_image}}" />
                          <td><input type="file" name="post_image"  class="form-control"/></td>
                      </tr>
                      <tr>
                        <th>Detail</th>
                        <td><textarea name="detail" id="detail" class="form-control">{{$post->detail}}</textarea></td>
                      </tr>
                      <tr>
                        <th>Tags</th>
                        <td><textarea name="tags" id="tags" class="form-control">{{$post->tags}}</textarea></td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <input type="submit" class="btn btn-primary" value="Save Post" />
                          </td>
                      </tr>
                  </table>
                </form>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
@endsection