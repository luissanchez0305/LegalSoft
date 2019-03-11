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
        <form method="POST" action="{{ route('people.update') }}">
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
            <a class="nav-link" id="pills-services-tab" data-toggle="pill" href="#pills-services" role="tab" aria-controls="pills-services" aria-selected="false">Persona Jurídica</a>
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
          <div class="row" id="action-submit-button">
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
    .card-default{
      color: #808080 !important;
    }
    label{
      padding: 10px 0px 0px 0px;
    }
    .ac-container{
      position: absolute;
    }
    .ac-control{
      border-color: #f0ad4e;
    }
    #relation-legal-first-step h5, #relation-legal-second-step h5{
      cursor: pointer;
    }
  </style>
@endsection

@section('js')
    <script type="text/JavaScript">
      var xhr;
      var timeout;
      $('.nav-link').click(function(){
        let $this = $(this);
        if($this.attr('id') == 'pills-services-tab'){
          $('#action-submit-button').addClass('hidden');
        }
        else{
          $('#action-submit-button').removeClass('hidden');
        }
      });

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
            relation_legalId: $('#relation_legalId').val(),
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
                              relation_legalId: $('#relation_legalId').val()
                          },
                          function(response){
                            $('.shareholder_row_container').remove();
                            $('#shareholder_container').append(response);
                          }
                      );
      });

      $('.ac-control').blur(function(){
        $('.ac-container').fadeOut();
      });

      $('.ac-control').keyup(function(){
        if(timeout){
          clearTimeout(timeout);
        }
        if(xhr){
            xhr.abort();
        }
        var $this = $(this);
        var $list_container = $this.next();
        if($this.attr('ac-master-field'))
          $('#'+$this.attr('ac-master-field')).val('0');
        else
          $this.prev().val('0');
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
          timeout = setTimeout(function(){
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
          }, 800);
        }
      });

      $('body').on('click', '.ac-item', function(){
        var $this = $(this);
        let $input = $this.closest('.ac-container').prev();
        let master_field = $input.attr('ac-master-field');
        if(master_field){
          $('#' + master_field).val($this.attr('data-val'));
          $('#' + master_field).next().val($this.attr('data-item1'));
          $input.val($this.attr('data-item2'));
        }
        else{
          $master_item_field = $('input[ac-master-field="'+$input.prev().attr('id')+'"]');
          if($master_item_field.length > 0){
            $input.val($this.attr('data-item1'));
            $master_item_field.val($this.attr('data-item2'));
          }
          else{
            $input.val($this.html());
          }
          $input.prev().val($this.attr('data-val'));
        }
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

      $('body').on('click','#legal_relation_create_btn', function(){
          $('#relation_legalId').val('0');
          $('#relation-legal-first-step .card-header').removeClass('card-default').addClass('card-primary');
          $('#relation-legal-first-step .card-block').removeClass('hidden');
          $('#relation-legal-second-step .card-header').removeClass('card-primary').addClass('card-default');
          $('#relation-legal-second-step .card-block').addClass('hidden');

          $('.legal_relation_container, #legal_relation_cancel').removeClass('hidden');
          $('#legal_relation_next').addClass('hidden');

          $('.legal_relation_container, #legal_relation_cancel').removeClass('hidden');

          $('#relation_legalId').val(0);
          $('#legal_person_name').val('');
          $('#relation_objectives').val('');
          $('#is_agent_residentYes').prop('checked',true);
          $('#is_agent_residentNo').prop('checked',false);
          $('#resident_agent_id').val('0');
          $('#resident_agent').val('');

          $('#board_directorId').val(0);
          $('#board_director_name').val('');
          $('#legal_secretarioId').val(0);
          $('#board_secretario_name').val('');
          $('#legal_tesoreroId').val(0);
          $('#board_tesorero_name').val('');

          $('.shareholder_row_container').remove();
      });

      $('body').on('click','#legal_relation_cancel', function(){
          $('.legal_relation_container, #legal_relation_cancel').addClass('hidden')
      });

      $('body').on('click','#legal_relation_next, #relation-legal-second-step h5', function(){
          $('#relation-legal-first-step .card-header').removeClass('card-primary').addClass('card-default');
          $('#relation-legal-first-step .card-block').addClass('hidden');
          $('#relation-legal-second-step .card-header').removeClass('card-default').addClass('card-primary');
          $('#relation-legal-second-step .card-block').removeClass('hidden');
      });

      $('body').on('click', '#legal_relation_add', function(){
        let data = {
          _token: '{{ csrf_token() }}',
          legal_relation_id: $('#relation_legalId').val(),
          client_id: $('#client_id').val(),
          name: $('#legal_person_name').val(),
          ruc: $('#relation_objectives').val(),
          is_agent_resident: $('input[name="is_agent_resident"]:checked').val(),
          agent_resident_id: $('#resident_agent_id').val(),
          agent_resident_name: $('#resident_agent').val(),
          board_director_id: $('#board_directorId').val(),
          board_director_name: $('#board_director_name').val(),
          board_director_last_name: $('#board_director_last_name').val(),
          board_director_unique_id: $('#board_director_id').val(),
          board_secretary_id: $('#legal_secretarioId').val(),
          board_secretary_name: $('#board_secretario_name').val(),
          board_secretary_last_name: $('#board_secretario_last_name').val(),
          board_secretary_unique_id: $('#board_secretario_id').val(),
          board_treasurer_id: $('#legal_tesoreroId').val(),
          board_treasurer_name: $('#board_tesorero_name').val(),
          board_treasurer_last_name: $('#board_tesorero_last_name').val(),
          board_treasurer_unique_id: $('#board_tesorero_id').val()
        };
        $.post("{{ route('people.add_legal_relation') }}", data ,
            function(data){
              data = $.parseJSON(data);
              if(data.status == 'success'){
                $('#relation-legal-first-step .card-header').removeClass('card-primary').addClass('card-default');
                $('#relation-legal-first-step .card-block').addClass('hidden');
                $('#relation-legal-second-step .card-header').removeClass('card-default').addClass('card-primary');
                $('#relation-legal-second-step .card-block').removeClass('hidden');
                $('#relation_legalId').val(data.legal_relation_id);
              }
              else{
                // TODO poner mensaje de error en transaccion
              }
            }
          );
      });

      $('#relation-legal-first-step h5').first().click(function(){
        $('#relation-legal-first-step .card-header').removeClass('card-default').addClass('card-primary');
        $('#relation-legal-first-step .card-block').removeClass('hidden');
        $('#relation-legal-second-step .card-header').removeClass('card-primary').addClass('card-default');
        $('#relation-legal-second-step .card-block').addClass('hidden');
      });

      $('body').on('click','.legal_relation_edit', function (){
        $('.legal_relation_container, #legal_relation_cancel').addClass('hidden');
        $.post("{{ route('people.edit_legal_relation') }}",
          {
            _token: '{{ csrf_token() }}',
            id: $(this).attr('data-id'),
          },
          function(data){
            data = $.parseJSON(data);

            $('#relation-legal-first-step .card-header').removeClass('card-default').addClass('card-primary');
            $('#relation-legal-first-step .card-block').removeClass('hidden');
            $('#relation-legal-second-step .card-header').removeClass('card-primary').addClass('card-default');
            $('#relation-legal-second-step .card-block').addClass('hidden');

            $('.legal_relation_container, #legal_relation_cancel').removeClass('hidden');
            $('#legal_relation_next').removeClass('hidden');

            $('#relation_legalId').val(data.legal_relation.id);
            $('#legal_person_name').val(data.legal_relation.legal_person_name);
            $('#relation_objectives').val(data.legal_relation.ruc);
            if(data.legal_relation.resident_agent_id != null){
              $('#is_agent_residentYes').prop('checked',false);
              $('#is_agent_residentNo').prop('checked',true);
              $('#resident_agent_id').val(data.legal_relation.resident_agent_id);
              $('#resident_agent').val(data.legal_relation.resident_agent_name);
              $('#agent_resident_container').removeClass('hidden');
            }
            else{
              $('#is_agent_residentYes').prop('checked',true);
              $('#is_agent_residentNo').prop('checked',false);
              $('#resident_agent_id').val('0');
              $('#resident_agent').val('');
              $('#agent_resident_container').addClass('hidden');
            }

            for(let i = 0; i < data.boards.length; i++){
              let board = data.boards[i];
              switch(board.type_name){
                case 'Director':
                  $('#board_directorId').val(board.people_id);
                  $('#board_director_name').val(board.people_name);
                  $('#board_director_last_name').val(board.people_last_name);
                  $('#board_director_id').val(board.people_unique_id);
                  break;
                case 'Secretario':
                  $('#legal_secretarioId').val(board.people_id);
                  $('#board_secretario_name').val(board.people_name);
                  $('#board_secretario_last_name').val(board.people_last_name);
                  $('#board_secretario_id').val(board.people_unique_id);
                  break;
                case 'Tesorero':
                  $('#legal_tesoreroId').val(board.people_id);
                  $('#board_tesorero_name').val(board.people_name);
                  $('#board_tesorero_last_name').val(board.people_last_name);
                  $('#board_tesorero_id').val(board.people_unique_id);
                  break;
              }
            }

            $('.shareholder_row_container').remove();
            $('#shareholder_container').append(data.shareholders);
          });
      });

      $('body').on('click','.legal_relation_delete', function (){
        $.post("{{ route('people.delete_legal_relation') }}",
          {
            _token: '{{ csrf_token() }}',
            $id: $(this).attr('data-id')
          },
          function(data){
            console.log(data);
          });

      });
    </script>
@endsection