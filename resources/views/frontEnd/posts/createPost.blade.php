@extends('frontEnd.layout.original')
@section('content')
    <div class="row mt-4">
        <div class="col-9 mx-auto text-center">
        <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Add Post
              <a href="#" class="float-right btn btn-sm btn-dark">All Posts</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                @if($errors)
                  @foreach($errors->all() as $error)
                    <p class="text-danger">{{$error}}</p>
                  @endforeach
                @endif

                @if(Session::has('error'))
                <p class="text-danger">{{session('error')}}</p>
                @endif

                @if(Session::has('success'))
                <p class="text-success">{{session('success')}}</p>
                @endif

                <form method="post" action="{{route('savePostData')}}" enctype="multipart/form-data">
                  @csrf
                  <table class="table table-bordered">
                      <tr>
                          <th>Title</th>
                          <td><input type="text" name="title" class="form-control" /></td>
                      </tr>
                      <tr>
                          <th>Category</th>
                          <td>
                            <select name="category" id="category" class="form-control">
                              @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->title}}</option>
                              @endforeach
                            </select>
                          </td>
                      </tr>
                      <tr>
                          <th>Thumbnail</th>
                          <td><input type="file" name="post_thumb" class="form-control" /></td>
                      </tr>
                      <tr>
                          <th>Full Image</th>
                          <td><input type="file" name="post_image"  class="form-control"/></td>
                      </tr>
                      <tr>
                        <th>Detail</th>
                        <td><textarea name="detail" id="detail" class="form-control"></textarea></td>
                      </tr>
                      <tr>
                        <th>Tags</th>
                        <td><textarea name="tags" id="tags" class="form-control"></textarea></td>
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
          </div>
        </div>
    </div>
@endsection