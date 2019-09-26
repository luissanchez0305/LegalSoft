<!-- index.blade.php -->
@extends('layout.plain')
@section('page-title', 'Listado de Clientes - LegalSoft507')

@section('body')
    @section('page-heading')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Listado de clientes
                <a href="{{ action('PeopleController@create', ['type_text' => 'natural']) }}" class="btn btn-warning">Nueva Persona Natural</a>
                <a href="{{ action('PeopleController@create', ['type_text' => 'jurídica']) }}" class="btn btn-warning">Nueva Persona Jurídica</a>
            </h1>
        </div>
        <div class="col-lg-6">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list-ul"></i> Listado General
                </li>
            </ol>
        </div>
        <div class="col-xl-2 form-group input-group">
            <input type="text" class="form-control" id="people-search-text">
            <span class="input-group-btn">
              <input type="hidden" id="list-type" value="{{ $id }}" />
              <button class="btn btn-secondary" placeholder="Buscar" type="button" id="people-search-btn"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </div>
    <!-- /.row -->
    @endsection
    <div class="row">
      @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div>
      @endif
        <div class="col-xl-8">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Tipo de cliente</th>
                      <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="people_rows">
                {!!html_entity_decode($clients)!!}
                </tbody>
            </table>
          </div>
        </div>
    </div>
      <!-- /.row -->
  @stop

@section('js')
  <script type="text/javascript" src="/js/index.js"></script>
@endsection