@extends('layouts.backend')

@section('title', 'MyBlog | Edit User')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Edit User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashed :3</a></li>
        <li><a href="{{ route('backend.users.index') }}">Users</a></li>
        <li class="active">Edit User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        {!! Form::model($user, [
            'method' => 'PUT',
            'route' => ['backend.users.update', $user->id],
            'files' => TRUE,
            'id'    => 'user-form'
        ]) !!}

        @include('backend.users.form')

        {!! Form::close() !!}
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection