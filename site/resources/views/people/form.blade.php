<!-- index.blade.php -->
@extends('layout.plain')
@section('page-title', 'Listado de Inscritos - LegalSoft507')

@section('body')
    @section('page-heading')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $action_type_text }} inscrito
            </h1>

            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/people">Listado General</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> {{ $name }} {{ $last_name }}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    @endsection
    <div class="row">
        <form method="post" action="{{ action('PeopleController@update', $id) }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
          <input type="hidden" name="type" value="{{ $action_type }}"/>
          <input name="_method" type="hidden" value="PATCH">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="name">Nombre</label>
              <input type="text" class="form-control" name="name" value="{{$people->name}}">
            </div>
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="last_name">Apellido</label>
              <input type="text" class="form-control" name="last_name" value="{{$people->last_name}}">
            </div>
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
              <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
            </div>
          </div>
          <!-- /.row -->
        </form>
    </div>
    <!-- /.row -->
@endsection