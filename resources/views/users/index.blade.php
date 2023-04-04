
@extends('layouts.app')

<?php $role = strval($_SESSION["role"]); ?>
@if ($role === "Admin")


  @section('content')
  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Users Management</h2>
          </div>
          <div class="pull-right">
              <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
          </div>
      </div>
  </div>


  @if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
  @endif


  <table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Name</th>
    <th>Email</th>
    <th>Roles</th>
    <th width="280px">Action</th>
  </tr>
  @foreach ($data as $key => $user)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        @if(!empty($user->getRoleNames()))
          @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
          @endforeach
        @endif
      </td>
      <td>
        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
          {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}

          @if($user->isBlocked == false)
              <a class="btn btn-danger" href="{{ route('blockUser',$user ->id) }}">Block</a>
          @else
              <a class="btn btn-danger" href="{{ route('unblockUser',$user->id) }}">UnBlock</a>
          @endif
      </td>
    </tr>
  @endforeach
  </table>


  {!! $data->render() !!}

  <br>
  <h1>Active logged in users</h1>
  <hr>
  <table class="table table-bordered">
      <tr>
          <th>Name</th>
      </tr>
     @foreach ($users as $activity)
      <tr>
        <td>{{$activity->user->name}}</td>
      </tr>
      @endforeach
  </table>
  <p class="text-center text-primary"><small>Users</small></p>

  <br>
  <h1>Active guest users</h1>
  <hr>
  <?php foreach ($guests as $activity) {
      echo $activity -> ip_address . '<br>';
  } ?>

  <p class="text-center text-primary"><small>Users</small></p>

  @endsection
@endif
