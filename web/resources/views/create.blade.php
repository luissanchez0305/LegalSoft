
<!-- create.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Creacion de datos | LegalSoft</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script  data-src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  </head>
  <body>
    <div class="container">
      <h2>Creacion de datos</h2><br/>
      <form method="post" action="{{url('data')}}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Nombre:</label>
            <input type="text" class="form-control" name="name">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Apellido:</label>
            <input type="text" class="form-control" name="last_name">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript">
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
         });
    </script>
  </body>
</html>