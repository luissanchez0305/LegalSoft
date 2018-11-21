<!-- index.blade.php -->
@section('index-title')
Clientes | LegalSoft
@stop
@extends('layout.main')
@section('index-context')
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
        </tr>
      </thead>
      <tbody>

        @foreach($data_items as $data)
        <tr>
          <td>{{$data['id']}}</td>
          <td>{{$data['name']}}</td>
          <td>{{$data['last_name']}}</td>

          <td><a href="{{action('dataController@edit', $data['id'])}}" class="btn btn-warning">Edit</a></td>
          <td>
            <form action="{{action('dataController@destroy', $data['id'])}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-danger" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @stop