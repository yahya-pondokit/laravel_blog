@extends('layouts.backend')

@section('title', 'MyBlog | Add new post')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
        <small>ADD NEW POST HERE, hehe</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashed :3</a></li>
        <li><a href="{{ route('backend.blog.index') }}">Blog</a></li>
        <li class="active">Add new</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        {!! Form::model($post, [
            'method' => 'POST',
            'route' => 'backend.blog.store',
            'files' => TRUE,
            'id'    => 'post-form'
        ]) !!}

        @include('backend.blog.form')

        {!! Form::close() !!}
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection

@include('backend.blog.script')