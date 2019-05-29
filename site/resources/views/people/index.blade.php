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
      $('body').on('click', '.delete-client', function(e){
        e.preventDefault();
        var _data = {
          _token: '{{ csrf_token() }}',
          id: $(this).attr('data-id')
        }
        $.post('{{ route("people.destroy") }}', _data , function(data){
          location.reload();
        });
      });
      $('body').on('click','#people-search-btn', function(){
        var _data = {
          _token: '{{ csrf_token() }}',
          list_type: $('#list-type').val(),
          q: $('#people-search-text').val()
        };
        $.post('{{ route("people.search") }}', _data, function(data){
          data = $.parseJSON(data);
          $('#people_rows').html(data.people);
        });
      });
      $('body').on('click', '.client-item', function(){
        location.href = $(this).attr('edit-url');
      });
    });
  </script>
@endsection