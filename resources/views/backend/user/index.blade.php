@extends('backend.layouts.index')

@section('title')
    | Users
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('user.create')}}" class="btn btn-success"> <i class="fa fa-plus"> New User </i> </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-12">
                    <table class="table table-bordered table-active dataTable">
                        <thead>
                        <tr>
                            <th scope="col"> SL</th>
                            <th scope="col"> Name</th>
                            <th scope="col"> Email </th>
                            <th scope="col"> Image </th>
                            <th scope="col"> Gender </th>
                            <th scope="col"> Phone </th>
                            <th scope="col"> Join </th>
                            <th scope="col"> Address </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $key=>$user)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->image == true)
                                <img width="50px" height="50px" src="{{asset($user->image)}}">
                                @else
                                    <img width="50px" height="50px" src="{{asset('backend/assets/img/user_no_image.png')}}">
                                @endif
                            </td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>{{$user->address}}</td>
                            <td>
                                @if($user->status == 1)
                                    <a href="{{route('user.status',$user->id)}}" class="btn"> <i class="fa fa-thumbs-up"> </i> </a>
                                @else
                                    <a href="{{route('user.status',$user->id)}}" class="btn"> <i class="fa fa-thumbs-down"> </i> </a>
                                @endif
                                    <a href="{{route('user.edit',$user->id)}}" class="btn"> <i class="fa fa-edit"> </i> </a>
                                <a href="{{route('user.delete',$user->id)}}" class="btn"> <i class="fa fa-trash"> </i> </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection
