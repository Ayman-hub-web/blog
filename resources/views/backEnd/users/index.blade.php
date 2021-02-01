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
              <i class="fas fa-table"></i> All Users
              <a href="#" class="float-right btn btn-sm btn-dark">Add User</a>
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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <form action="{{route('admin.user.delete', $user->id)}}" method="post" class="float-left">
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