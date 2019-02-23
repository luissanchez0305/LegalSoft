<!-- index.blade.php -->
@extends('layout.plain')
@section('page-title', 'Listado de Clientes - LegalSoft507')

@section('body')
    @section('page-heading')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $action_type_text }} cliente
            </h1>

            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/people">Listado General</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> {{ $people->name }} {{ $people->last_name }}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    @endsection
    <div class="row">
        <form method="POST" action="{{ action('PeopleController@update', $id) }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
          <input type="hidden" name="type" value="{{ $action_type }}"/>
          <input type="hidden" name="client_id" id="client_id" value="{{ $people->id }}"
          <input name="_method" type="hidden" value="PATCH">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">General</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-finance-tab" data-toggle="pill" href="#pills-finance" role="tab" aria-controls="pills-finance" aria-selected="false">Finanzas y Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-services-tab" data-toggle="pill" href="#pills-services" role="tab" aria-controls="pills-services" aria-selected="false">Per. Jurídica, Directores y Accionistas</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active in" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
            @include('people.general-info')
          </div>
          <div class="tab-pane fade" id="pills-finance" role="tabpanel" aria-labelledby="pills-finance-tab">
            @include('people.finance-info')
          </div>
          <div class="tab-pane fade" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab">
            @include('people.relations-info')
          </div>
        </div>

          <!-- /.row -->
          <div class="row">
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-success">{{ $action_type_text }}</button>
            </div>
          </div>
          <!-- /.row -->
        </form>
    </div>
    <!-- /.row -->
@endsection

@section('style')
  <style>
    label{
      padding: 10px 0px 0px 0px;
    }
    .ac-container{
      position: absolute;
    }
  </style>
@endsection

@section('js')
    <script type="text/JavaScript">
      var xhr;
      $('body').on('click','input[name="final_recipient"]', function(e){
        if($(this).val() == "0"){
          $('#final_recipient_container').removeClass('hidden');
        }
        else{
          $('#final_recipient_container').addClass('hidden');
        }

      });
      $('#nationality, #birth, #residence, #final_recipient_text, #country_activity_financial, #relation_legal_name').keyup(function(){
        if(xhr){
            xhr.abort();
        }
        var $this = $(this);
        var $list_container = $this.next();
        $list_container.html('');
        var query = $this.val();
        if(query != ''){
          var _token = $('input[name="_token"]').val();
          var _url;
          var _data = { q: query, _token: _token, id:  };
          switch($this.attr('ac-method')){
            case 'countries':
              _url = "{{ route('helper.autocomplete_countries') }}";
              _data = { q: query, _token: _token };
              break;
            case 'clients':
              _url = "{{ route('helper.autocomplete_clients') }}";
              _data = { q: query, _token: _token, id: $('#client_id').val() };
              break;
            case 'producs':
              _url = "{{ route('helper.autocomplete_products') }}";
              break;
          }
          xhr = $.ajax({
            url: _url,
            method: "POST",
            data: _data,
            success: function(data){
              if(data.length > 0){
                $list_container.fadeIn();
                ul = '<ul class="dropdown-menu" style="display:block; position:relative;">' + data + '</ul>';
                $list_container.html(ul);
              }
            }
          });
        }
      });
      $('body').on('click', '.ac-item', function(){
        var $this = $(this);
        $this.closest('.ac-container').prev().val($this.html());
        $this.closest('.ac-container').prev().prev().val($this.attr('data-val'));
        $this.closest('.ac-container').fadeOut();
      });
    </script>
@endsection