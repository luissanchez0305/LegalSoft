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
          <li class="nav-item">
            <a class="nav-link" id="pills-services-tab" data-toggle="pill" href="#pills-files" role="tab" aria-controls="pills-files" aria-selected="false">Documentos</a>
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
          <div class="tab-pane fade" id="pills-files" role="tabpanel" aria-labelledby="pills-files-tab">
            @include('people.files-info')
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
    .ac-control{
      border-color: #f0ad4e;
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
      $('body').on('click','input[name="is_agent_resident"]', function(e){
        if($(this).val() == "0"){
          $('#agent_resident_container').removeClass('hidden');
        }
        else{
          $('#agent_resident_container').addClass('hidden');
        }

      });

      $('body').on('click', '#add-shareholder-btn', function(e){
        let data = {
            _token: '{{ csrf_token() }}',
            shareholder_clientId: $('#shareholder_clientId').val(),
            shareholder_client_peopleId: $('#shareholder_client_peopleId').val(),
            shareholder_client_people_name: $('#shareholder_client_people_name').val(),
            shareholder_client_people_certification_number: $('#shareholder_client_people_certification_number').val(),
            shareholder_client_people_action_typeId: $('#shareholder_client_people_action_typeId').val(),
            shareholder_client_people_ruc: $('#shareholder_client_people_ruc').val(),
            shareholder_client_people_country_birthId: $('#shareholder_client_people_country_birthId').val(),
            shareholder_client_people_country_nationalityId: $('#shareholder_client_people_country_nationalityId').val(),
            shareholder_client_people_phone_number: $('#shareholder_client_people_phone_number').val(),
            shareholder_client_people_email: $('#shareholder_client_people_email').val(),
            shareholder_client_people_percentage: $('#shareholder_client_people_percentage').val()
        };

        $.post("{{ route('people.add_shareholder') }}",
              data,
              function(response){
                $('.shareholder_row_container').remove();
                $('#shareholder_container').append(response);

                $('#shareholder_client_peopleId').val('0');
                $('#shareholder_client_people_name').val('');
                $('#shareholder_client_people_certification_number').val('');
                $('#shareholder_client_people_action_typeId').find('option:eq(0)').prop('selected', true);
                $('#shareholder_client_people_ruc').val('');
                $('#shareholder_client_people_country_birthId').val('0');
                $('#shareholder_people_country_birth_name').val('');
                $('#shareholder_client_people_country_nationalityId').val('0');
                $('#shareholder_people_country_nationality_name').val('');
                $('#shareholder_client_people_phone_number').val('');
                $('#shareholder_client_people_email').val('');
                $('#shareholder_client_people_percentage').val('');
              }
          );
      });

      $('body').on('click', '.shareholder-delete', function(e){
        $.post("{{ route('people.delete_shareholder') }}",
                          {
                              _token: '{{ csrf_token() }}',
                              id: $(this).attr('data-id'),
                              client_id: $('#client_id').val()
                          },
                          function(response){
                            $('.shareholder_row_container').remove();
                            $('#shareholder_container').append(response);
                          }
                      );

      });

      $('.ac-control').keyup(function(){
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
          var _data = { q: query, _token: _token };
          switch($this.attr('ac-method')){
            case 'countries':
              _url = "{{ route('helper.autocomplete_countries') }}";
              break;
            case 'clients':
              _url = "{{ route('helper.autocomplete_clients') }}";
              break;
            case 'producs':
              _url = "{{ route('helper.autocomplete_products') }}";
              break;
            case 'types_share':
              _url = "{{ route('helper.autocomplete_types_share') }}";
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

      $('body').on('click', '#addFileButton', function(){
          $('#file-item-type option:eq(0)').prop('selected', true);
          $('#file-name').val('');
          $('#file-item-description').val('');
          var $fileSection = $('.new-file-section');
          if($fileSection.hasClass('hidden'))
              $fileSection.removeClass('hidden');
          else
              $fileSection.addClass('hidden');
      });

      $('body').on('click', '.document_delete', function(){
        $.post("{{ route('people.delete_file') }}",
                          {
                              _token: '{{ csrf_token() }}',
                              id: $(this).attr('data-id'),
                              client_id: $('#client_id').val()
                          },
                          function(response){
                            $('#files_container').html(response);
                          }
                      );
      });

      $('body').on('click', '#add-new-file-button', function(){
          var file_data = $('#file-name').prop('files')[0];
          var form_data = new FormData();
          form_data.append('file', file_data);

          $.ajax({
              url: '/api/upload.php', // point to server-side PHP script
              dataType: 'text',  // what to expect back from the PHP script, if anything
              cache: false,
              contentType: false,
              processData: false,
              data: form_data,
              type: 'post',
              success: function(php_script_response){
                  if(php_script_response.toLowerCase().indexOf('error') == -1 && php_script_response.toLowerCase().indexOf('warning') == -1)
                      $.post("{{ route('people.add_file') }}",
                          {
                              _token: '{{ csrf_token() }}',
                              file_name: php_script_response,
                              client_id: {{ $people->id }},
                              file_item_type: $('#file-item-type').val(),
                              file_description: $('#file-item-description').val()
                          },
                          function(response){
                            $('#files_container').html(response);
                          }
                      );
                  else{
                      if(php_script_response.indexOf('file type') > -1)
                          $('#file-upload-result').html('Tipo de archivo incorrecto');
                      else
                          $('#file-upload-result').html('Error al subir archivo');

                      setTimeout(function(){ $('#file-upload-result').html(''); }, 5000);
                  }
              }
           });
      });
    </script>
@endsection