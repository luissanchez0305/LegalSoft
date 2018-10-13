<!-- edit.blade.php -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Editar informacion | LegalSoft</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <h2>Editar informacion</h2><br  />
        <form method="post" action="{{action('dataController@update', $id)}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" value="{{$data->name}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="last_name">Apellido</label>
            <input type="text" class="form-control" name="last_name" value="{{$data->last_name}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>