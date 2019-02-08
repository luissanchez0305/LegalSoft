<!-- index.blade.php -->
@extends('layout.plain')
@section('page-title', 'Listado de Inscritos - LegalSoft507')

@section('body')
    @section('page-heading')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Listado de inscritos <a href="{{ action('PeopleController@create') }}" class="btn btn-warning">Nuevo</a>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Listado General
                </li>
            </ol>
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
        <div class="col-xl-6 col-lg-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>

                @foreach($people as $item)
                  <tr>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['last_name']}}</td>

                    <td>
                      <div class="row">
                          <div class="col-xl-6 text-xs-center">
                              <a href="{{ action('PeopleController@edit', $item['id']) }}" class="btn btn-warning">Editar</a>
                          </div>
                          <div class="col-xl-6 text-xs-center">
                              <form action="{{ action('PeopleController@destroy', $item['id']) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input name="_method" type="hidden" value="DELETE"/>
                                <button class="btn btn-danger" type="submit">Borrar</button>
                              </form>
                          </div>
                      </div>
                      <!-- /.row -->
                    </td>
                    <td>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
          </div>
        </div>
    </div>
      <!-- /.row -->
  @stop

@section('index-javascript')
  <script type="text/javascript">
    $(function() {
      $('.close-dropdown').click(function(){
        $('.nav-dropdown-wrapper').removeClass('in');
      });
      $('#hamburger').click(function(){
        $('body').toggleClass('visible');
      });
      $('.top-menu .nav-item:not(.image-item):not(.theme-color-item)').click(function(e){
        e.stopPropagation();
        if($('.top-menu .nav-item').hasClass('active-nav') && !($(this).hasClass('active-nav'))){
          $('.top-menu .nav-item').removeClass('active-nav');
          $('.nav-dropdown-wrapper').removeClass('in');
        }
        reqId = $(this).find('.nav-link').attr('data-target');
        if($(this).hasClass('active-nav')){
          $('.nav-dropdown-wrapper').removeClass('in');
          $(this).removeClass('active-nav');
        } else{
          $(this).addClass('active-nav');
          setTimeout(function(){
            $('.navbar-fixed-top').find(reqId).addClass('in');
            $('.side-menu').find(reqId).addClass('in');
          }, 200);
        }

      });
      $('.theme-picker').click(function() {
              changeTheme($(this).attr('data-theme'));
          });

          function changeTheme(theme) {

              $('<link>')
              .appendTo('head')
              .attr({type : 'text/css', rel : 'stylesheet'})
              .attr('href', '/css/app-'+theme+'.css');

              $.get('api/change-theme?theme='+theme);
          }
      $('body').click(function(){
        $('.top-menu .nav-item').removeClass('active-nav');
        $('.nav-dropdown-wrapper').removeClass('in');
      });
    });
  </script>
@stop