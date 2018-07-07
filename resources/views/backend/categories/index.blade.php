@extends('layouts.backend')

@section('title', 'MyBlog | Categories')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categories
        <small>display all categories</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashed :3</a></li>
        <li><a href="{{ route('backend.categories.index') }}">Categories</a></li>
        <li class="active">All Categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border clearfix ">
          <div class="pull-left">
          	<a href="{{ route('backend.categories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>New Entry</a>
          </div>
          <div class="pull-right" style="padding:7px 0;">
          </div>
        </div>
        <div class="box-body">
          @include('backend.partials.message')

        	@if( ! $categories->count())
	        	<div class="alert alert-warning">
	        		<strong>No record found</strong>
	        	</div>
        	@else
            @include('backend.categories.table')
	        @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        	<div class="pull-left">
	          {{ $categories->appends( Request::query() )->render() }}
      		</div>
      		<div class="pull-right">
      			<small>{{ $categoriesCount }} {{ str_plural('Item', $categoriesCount) }}</small>
      		</div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
	<script type="text/javasript">
		$('ul.pagination').addClass('no-margin pagination-sm');
	</script>
@endsection