<!-- index.blade.php -->
@extends('layout.plain')
@section('page-title', 'Bitliance - Creación/Modificación de cliente')

@section('body')
    @section('page-heading')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $action_type_text }}
            </h1>
        </div>
        <div class="col-lg-12 p-0">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/people/{{ $legal_relation_client ? 'juridica' : 'natural' }}">Listado General</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> {{ $people->name }} {{ $people->last_name }}
                </li>
                <li>
                  <a href="{{route('people.pdf_format',$id)}}"><i class="fa fa-print"></i></a>
                </li>
            </ol>
          </div>
    </div>
    <!-- /.row -->
    @endsection
    <div class="row">
        <div>

          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">General</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ $new_client ? 'disabled' : '' }}" id="pills-finance-tab" data-toggle="pill" href="#pills-finance" role="tab" aria-controls="pills-finance" aria-selected="false">Finanzas y Servicios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ $legal_relation_client ? 'hidden' : '' }} {{ $new_client ? 'disabled' : '' }}" id="pills-services-tab" data-toggle="pill" href="#pills-services" role="tab" aria-controls="pills-services" aria-selected="false">Personas Jurídicas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ $new_client ? 'disabled' : '' }}" id="pills-files-tab" data-toggle="pill" href="#pills-files" role="tab" aria-controls="pills-files" aria-selected="false">Documentos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ $new_client ? 'disabled' : '' }}" id="pills-risk-tab" data-toggle="pill" href="#pills-risk" role="tab" aria-controls="pills-risk" aria-selected="false">Riesgo</a>
            </li>
            <div style="float: right;">
              {{ $created_date }}
            </div>
            <div style="float: right; padding: 0 10px 0 0;">
              {{ $generated_id }}
            </div>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active in" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab" form="general-info">
              @include('people.general-info')
            </div>
            <div class="tab-pane fade" id="pills-finance" role="tabpanel" aria-labelledby="pills-finance-tab" form="finance-info">
              @include('people.finance-info')
            </div>
            <div class="tab-pane fade" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab">
              @include('people.relations-info')
            </div>
            <div class="tab-pane fade" id="pills-files" role="tabpanel" aria-labelledby="pills-files-tab">
              @include('people.files-info')
            </div>
            <div class="tab-pane fade" id="pills-risk" role="tabpanel" aria-labelledby="pills-risk-tab">
              @include('people.risk-info')
            </div>
          </div>
          <div class="row" id="action-submit-button">
            <div class="form-group col-md-12">
              <button type="button" class="btn btn-success" id="form-general-save">Guardar</button>
            </div>
            <div class="col-md-12" id="form-general-status"></div>
          </div>
          <!-- /.row -->
        </div>
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
      z-index: 10000000;
    }
    .ac-control{
      border-color: #f0ad4e;
    }
    .ac-control.error{
      border-bottom-color: red !important;
    }
    .ac-item, #relation-legal-first-step h5, #relation-legal-second-step h5{
      cursor: pointer;
    }
    label.error{
      position: absolute;
    }
  </style>
@endsection

@section('js')    
  <script type="text/javascript">
    var xhr;
    var timeout;

    let val = new validate();
    val.init();
    $('.nav-link').click(function(){
      let $this = $(this);
      if(!$this.hasClass('disabled')){
        if($this.attr('id') == 'pills-services-tab' || $this.attr('id') == 'pills-files-tab' || $this.attr('id') == 'pills-risk-tab'){
          $('#action-submit-button').addClass('hidden');
        }
        else{
          $('#action-submit-button').removeClass('hidden');
        }
      }
      else{
        return false;
      }
    });

    $('.field_date').datepicker({
      maxDate: "0D",
      changeMonth: true,
      changeYear: true
    });
    $('body').on('click','input[name="final_recipient"]', function(e){
      if($(this).val() == "0"){
        $('#final_recipient_container').removeClass('hidden');
      }
      else{
        $('#final_recipient_container').addClass('hidden');
      }
    });

    $('body').on('click','input[name="is_pep"]', function(e){
      if($(this).val() == "1"){
        $('#pep_oficial_job_container').removeClass('hidden');
      }
      else{
        $('#pep_oficial_job_container').addClass('hidden');
      }
    });

    $('body').on('click','input[name="is_pep_family"]', function(e){
      if($(this).val() == "1"){
        $('#pep_family_container').removeClass('hidden');
      }
      else{
        $('#pep_family_container').addClass('hidden');
      }
    });

    $('body').on('click','input[name="is_agent_resident"]', function(e){
      if($(this).val() == "0"){
        $('#agent_resident_container').removeClass('hidden');
      }
      else{
        $('#agent_resident_container').addClass('hidden');
        $('#agent_resident_container label.error').remove();
        $('#agent_resident_container .error').removeClass('error');
      }
    });

    ac_control = function (obj){
      if(timeout){
        clearTimeout(timeout);
      }
      if(xhr){
        xhr.abort();
      }
      var $this = $(obj);
      var $list_container = $this.next()[0].localName == 'label' ? $this.next().next() : $this.next();
      let ac_method = $this.attr('ac-method');

      if(ac_method != 'clients'){
        if($this.attr('ac-master-field'))
          $('#' + $this.attr('ac-master-field')).val('0');
        else
          $this.prev().val('0');
      }
      ul = '<ul class="dropdown-menu" style="display:block; position:relative;">[data]</ul>';
      var $list_container = $this.next()[0].localName == 'label' ? $this.next().next() : $this.next();
      var query = $this.val();
      if(query != ''){
        var _token = $('input[name="_token"]').val();
        var _url;
        var _data = { q: query, _token: _token };
        switch(ac_method){
          case 'countries':
            _url = "{{ route('helper.autocomplete_countries') }}";
            break;
          case 'clients':
            _url = "{{ route('helper.autocomplete_clients') }}";
            break;
          case 'products':
            _url = "{{ route('helper.autocomplete_products') }}";
            break;
          case 'types_share':
            _url = "{{ route('helper.autocomplete_types_share') }}";
            break;
          case 'oficial_job':
            _url = "{{ route('helper.autocomplete_oficial_jobs') }}";
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
                $list_container.html(ul.replace('[data]',data));
              }
            }
          });
        }, 500);
      }
    }

    $('body').on('click', '.ac-control', function(){
      ul = '<ul class="dropdown-menu" style="display:block; position:relative;">[data]</ul>';
      var $this = $(this);
      var $list_container = $this.next()[0].localName == 'label' ? $this.next().next() : $this.next();
      if($this.attr('ac-method') == 'clients'){
        $list_container.fadeIn();
        $list_container.html(ul.replace('[data]', '<li><a class="ac-item new">Nuevo Cliente</a></li>'));
      }

      $this.blur(function(){
        $this.off('blur');
        if($list_container)
          $list_container.fadeOut();

        if(xhr)
          xhr.abort();
      });
    });

    $('.ac-control').keyup(function(){
      ac_control(this);
    });

    $('body').on('click', '.ac-item', function(e){
      e.preventDefault();
      var $this = $(this);
      var $container = $this.closest('.ac-container'); 
      let $input = $container.prev()[0].localName == 'label' ? $container.prev().prev() : $container.prev();
      let master_field = $input.attr('ac-master-field');
      let $master_item_fields = [];

      if($this.hasClass('new')){
        if(master_field){
          $('#' + master_field).val('0');
          $('#' + master_field).next().val('');
          $master_item_fields = $('input[ac-master-field="'+ master_field+'"]');
        }
        else{
          $input.prev().val('0');
          $input.val('');
          $master_item_fields = $('input[ac-master-field="'+$input.prev().attr('id')+'"]');
        }
        for(var i = 0; i < $master_item_fields.length; i++){
          let obj = $master_item_fields[i];
          let $obj = $(obj);
          $obj.val('');
        }

        return;
      }

      if(master_field){
        $('#' + master_field).val($this.attr('data-val'));
        $('#' + master_field).next().val($this.attr('data-item1'));
        $master_item_fields = $('input[ac-master-field="'+ master_field+'"]');
        $input.val($this.attr('data-item2'));
      }
      else{
        $master_item_fields = $('input[ac-master-field="'+$input.prev().attr('id')+'"]');
        if($master_item_fields.length > 0){
          $input.val($this.attr('data-item1'));
        }
        else{
          $input.val($this.html());
        }
        ($input.prev()[0].localName == 'input' && $input.prev()[0].type == 'text' ? 
          $input.prev().prev() : $input.prev()).val($this.attr('data-val'));
        $input.removeClass('error');
      }
      for(var i = 0; i < $master_item_fields.length; i++){
        let obj = $master_item_fields[i];
        let $obj = $(obj);
        $obj.val($this.attr($obj.attr('ac-master-data')));
      }
      $container.html('');
    });

    $('body').on('click', '#add-new-person', function(){
        $('#client-Id').val('0');
        $('#client-typeId').val('7'); // tipo de cliente: subcliente (7)
        $('#name').val('');
        $('#last_name').val('');
        $('#email').val('');
        $('#passport_number').val('');
        $('#unique_id').val('');
        $('#gender option:eq(0)').prop('selected', true);
        $('#phone_fixed').val('');
        $('#phone_mobile').val('');
        $('#ocuppation').val('');
        $('#final_recipientYes').click();
        $('#final_recipientId, #final_recipient_name, #final_recipient_last_name').val('')
        $('#is_pepNo').click();
        $('#pep_oficial_job_text').val('');
        $('#is_pep_familyNo').click();
        $('#pep_familyId').val('0')
        $('#pep_family_name, #pep_family_last_name').val('');
          $('#country_nationalityId, #nationality, #country_birthId, #birth, #country_residenceId, #residence').val('');
          $('#address_physical, #address_mail').val('');

        $('.person.active').removeClass('active');
    });

    $('body').on('click', '.person', function(){
      let $this = $(this);
      if(!$this.hasClass('active')){
        $.post('{{ route("people.get_general_info") }}', { _token: $('input[name="_token"]').val(), id: $this.attr('data-id') }, function(data){
          data = $.parseJSON(data);
          $('#client-Id').val(data.people.id);
          $('#client-typeId').val(data.people.type_clientId);
          $('#name').val(data.people.name);
          $('#last_name').val(data.people.last_name);
          $('#email').val(data.people.email);
          $('#passport_number').val(data.people.passport_number);
          $('#unique_id').val(data.people.unique_id_number);
          $('#gender option[value="' + data.people.genderId + '"]').prop('selected', true);
          $('#phone_fixed').val(data.people.phone_fixed);
          $('#phone_mobile').val(data.people.phone_mobile);
          $('#ocuppation').val(data.people.ocuppation);

          if(data.people.final_recipientId){
            $('#final_recipientNo').click();
            $('#final_recipientId').val(data.people.final_recipientId);
            $('#final_recipient_name').val(data.final_recipient_name);
            $('#final_recipient_last_name').val(data.final_recipient_last_name);
          }
          else{
            $('#final_recipientYes').click();
          }

          if(data.people.pep_oficial_job){
            $('#is_pepYes').click();
            $('#pep_oficial_job_text').val(data.people.pep_oficial_job);
          }
          else{
            $('#is_pepNo').click();
            $('#pep_oficial_job_text').val('');
          }

          if(data.people.pep_family){
            $('#is_pep_familyYes').click();
            $('#pep_familyId').val(data.people.pep_family);
            $('#pep_family_name').val(data.pep_family_name);
            $('#pep_family_last_name').val(data.pep_family_last_name);
          }
          else{
            $('#is_pep_familyNo').click();
            $('#pep_familyId').val('0');
            $('#pep_family_name').val('');
            $('#pep_family_last_name').val('');
          }

          $('#country_nationalityId').val(data.people.country_nationalityId);
          $('#nationality').val(data.country_nationality);
          $('#country_birthId').val(data.people.country_birthId);
          $('#birth').val(data.country_birth);
          $('#country_residenceId').val(data.people.country_residenceId);
          $('#residence').val(data.country_residence);
          $('#address_physical').val(data.people.address_physical);
          $('#address_mail').val(data.people.address_mail);

          $('.person.active').removeClass('active');
          $this.addClass('active');
        });
      }
    });

    $('body').on('click', '#form-general-save', function(){
      $.validator.addMethod('dependsOnPassport', function(value_ruc, element){
        return value_ruc.length > 0 
      });
      $.validator.addMethod('dependsOnRuc', function(value_passport, element){
        return value_passport.length > 0 
      });
      val.validate_form($('#' + $('.tab-pane.active').attr('form')),
        {
          rules: {
            nationality: {
              check_zero: true
            },
            birth: {
              check_zero: true
            },
            residence: {
              check_zero: true
            },
            country_activity_financial: {
              check_zero: true
            },
            unique_id:{
              dependsOnPassport: {
                depends: function (element) {
                  return $('#client-typeId').val() == '2' || ($('#client-typeId').val() == '1' && $('#passport_number').val().length == 0);
                }
              }
            },
            passport_number:{
              dependsOnRuc: {                  
                depends: function (element){
                  return $('#client-typeId').val() == '2' || ($('#client-typeId').val() == '1' && $('#unique_id').val().length == 0);
                }
              }
            }

          }
        },
        function(){
          $('#form-general-status').html('Guardando...');
          let d = new Date($('#foundation_date').val());
          let _months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
          const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d)
          const mo = new Intl.DateTimeFormat('en', { month: 'short' }).format(d)
          const da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d)
          let foundation_date_format = `${ye}-${_months.indexOf(mo) + 1}-${da}`;
          console.log(foundation_date_format);
          var _data = {
            _token: $('input[name="_token"]').val(),
            action_type: $('.tab-pane.active').attr('form'),
            type: '{{ $action_type }}',
            client_id: $('#client-Id').val(),
            client_relatedId: $('#client-relatedId').val(),
            client_typeId: $('#client-typeId').val(),
            name: $('#name').val(),
            last_name: $('#last_name').val(),
            unique_id: $('#unique_id').val(),
            phone_fixed: $('#phone_fixed').val(),
            passport_number: $('#passport_number').val(),
            phone_mobile: $('#phone_mobile').val(),
            email: $('#email').val(),
            gender: $('#gender').val(),
            ocuppation: $('#ocuppation').val(),
            channel: $('#channel').val(),
            foundation_date: foundation_date_format,
            final_recipient: $('input[name="final_recipient"]:checked').val(),
            final_recipientId: $('#final_recipientId').val(),
            final_recipient_name: $('#final_recipient_name').val(),
            final_recipient_last_name: $('#final_recipient_last_name').val(),
            is_pep_oficial_job: $('input[name="is_pep"]:checked').val(),
            pep_oficial_job: $('#pep_oficial_job_text').val(),
            pep_familyId: $('#pep_familyId').val(),
            pep_family_name: $('#pep_family_name').val(),
            pep_family_last_name: $('#pep_family_last_name').val(),
            is_pep_family: $('input[name="is_pep_family"]:checked').val(),
            country_nationalityId: $('#country_nationalityId').val(),
            country_birthId: $('#country_birthId').val(),
            country_residenceId: $('#country_residenceId').val(),
            address_physical: $('#address_physical').val(),
            address_mail: $('#address_mail').val(),
            activity_financial: $('#activity_financial').val(),
            annual_income_limits: $('#annual_income_limits').val(),
            country_activity_financialId: $('#country_activity_financialId').val(),
            legacy_limits: $('#legacy_limits').val(),
            productId: $('#product').val(),
            relation_objectives_txt: $('#relation_objectives_txt').val(),
            legal_structure:$('#legal_structure').val(),
            writing_number:$('#writing_number').val()
          }
          $.post('{{ route("people.update") }}', _data, function(data){
                data = $.parseJSON(data);
                if(data.status == 'success'){
                  $('#form-general-status').html('Guardado');
                  setTimeout(function(){
                    $('#form-general-status').html('');
                  }, 5000);
                  $('.nav-link.disabled').removeClass('disabled');
                  if($('#client-typeId').val() == '1'){
                    if(data.people_id != $('#client-relatedId').val() && $('#client-Id').val() == '0'){
                      $('#persons-container .col-sm-2:last').before('<div class="col-sm-2"><a data-id="' + data.people_id + '" class="btn btn-link person active">' +
                        $('#name').val() + ' ' + $('#last_name').val() + '</a></div>');
                      if($('#client-relatedId').val() == '0')
                        $('#client-relatedId').val(data.people_id);
                      $('#persons-container').removeClass('hidden');
                      $('#form-general-save').html('Guardar Cambios');
                    }
                    else{
                      $('a[data-id="' + data.people_id + '"]').html($('#name').val() + ' ' + $('#last_name').val());
                    }
                  }
                  $('#client-Id').val(data.people_id);
                }
                else
                {
                  $('#form-general-status').html('Ha ocurrido un error');
                }
          });

        }, false, $('#form-general-status'));

    });
  
    jQuery.validator.addMethod("sumpercentage", function(value, element){
      let total = 0;
      $('.share_percentage').each(function(i,o){
        total += parseInt($(o).html());
      });
      if (total + parseInt(value) > 100) {
          return false;
      } else {
          return true;
      };
    }, "La suma de los porcentajes debe ser menor a 100"); 
    $('body').on('click', '#add-shareholder-btn', function(){
      val.validate_form($('#new-shareholder-container'),
        {
          rules:{
            shareholder_people_country_birth_name: {
              check_zero: true
            },
            shareholder_people_country_nationality_name:{
              check_zero: true
            },
            shareholder_client_people_percentage: {
              sumpercentage: true,
              check_zero: true
            }
          }

        },
        function(){
          let data = {
            _token: $('input[name="_token"]').val(),
            relation_legalId: $('#relation_legalId').val(),
            shareholder_client_peopleId: $('#shareholder_client_peopleId').val(),
            shareholder_client_people_name: $('#shareholder_client_people_name').val(),
            shareholder_client_people_certification_number: $('#shareholder_client_people_certification_number').val(),
            shareholder_client_people_action_typeId: $('#shareholder_client_people_action_typeId').val(),
            shareholder_client_people_id: $('#shareholder_client_people_id').val(),
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
              $('#shareholder_client_people_id').val('');
              $('#shareholder_client_people_country_birthId').val('0');
              $('#shareholder_people_country_birth_name').val('');
              $('#shareholder_client_people_country_nationalityId').val('0');
              $('#shareholder_people_country_nationality_name').val('');
              $('#shareholder_client_people_phone_number').val('');
              $('#shareholder_client_people_email').val('');
              $('#shareholder_client_people_percentage').val('');
            }
          );
        }, false, null);
    });

    $('body').on('click', '.shareholder-delete', function(e){
      $.post("{{ route('people.delete_shareholder') }}",
                        {
                            _token: $('input[name="_token"]').val(),
                            id: $(this).attr('data-id'),
                            relation_legalId: $('#relation_legalId').val()
                        },
                        function(response){
                          $('.shareholder_row_container').remove();
                          $('#shareholder_container').append(response);
                        }
                    );
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
                            _token: $('input[name="_token"]').val(),
                            id: $(this).attr('data-id'),
                            client_id: '{{ $people->id }}'
                        },
                        function(response){
                          $('#files_container').html(response);
                        }
                    );
    });

    $('body').on('click', '#add-new-file-button', function(){
        val.validate_form($('#add-new-file-form'), null,
          function(){
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
                    if(php_script_response.toLowerCase().indexOf('error') == -1 && php_script_response.toLowerCase().indexOf('warning') == -1){
                      $.post("{{ route('people.add_file') }}",
                          {
                              _token: $('input[name="_token"]').val(),
                              file_name: php_script_response,
                              client_id: '{{ $people->id }}',
                              file_item_type: $('#file-item-type').val(),
                              file_description: $('#file-item-description').val()
                          },
                          function(response){
                            $('#files_container').html(response);
                          });
                    }
                    else{
                      if(php_script_response.indexOf('file type') > -1)
                          $('#file-upload-result').html('Tipo de archivo incorrecto');
                      else
                          $('#file-upload-result').html('Error al subir archivo');

                      setTimeout(function(){ $('#file-upload-result').html(''); }, 5000);
                    }
                }
            });
        }, $('#file-upload-result'));
    });

    var board_last_name_obj = '<input type="text" class="form-control ac-control" name="board_last_names" value="" ac-method="clients" ac-master-field="board_people_[[tr_index]]" ac-master-data="data-item2" required title="Inserte el apellido" onkeyup="ac_control(this)">' +
              '<div class="ac-container"></div>';

    board_people_type_change = function(obj){
      let $obj = $(obj);
      if($obj.val() == '2'){
        $obj.parents('tr').find('td').eq(2).html('&nbsp;');
      }
      else{
        $obj.parents('tr').find('td').eq(2).html(board_last_name_obj.replace('[[tr_index]]', $obj.attr('data-index')));
      }
    }

    $('body').on('click', '.legal_relation_create_item', function(){
      $('#relation_board-error').addClass('hidden').removeClass('error');
      var tr_index = $('#relation_board tr').length;
      let typeId = $(this).attr('data-type');
      $('#relation_board').append('<tr>' +
            '<td>' +
                '<select class="form-control" data-index="' + tr_index + '" id="board_people_type_' + tr_index + '" name="board_people_types" required title="Escoja un tipo" onchange="board_people_type_change(this)">' +
                  '<option value="1" ' + (typeId == '1' ? 'selected="selected"' : '') + '>Per. Natural</option>' +
                  '<option value="2" ' + (typeId == '2' ? 'selected="selected"' : '') + '>Per. Jurídica</option> ' +
                '</select>' +
            '</td>' +
            '<td>' +
              '<input type="hidden" value="' + typeId + '" id="board_people_type_' + tr_index + '" name="board_people_types">' +
              '<input type="hidden" value="new" id="board_people_status_' + tr_index + '" name="board_people_status">' +
              '<input type="hidden" value="0" id="board_relation_' + tr_index + '" name="board_relations_ids">' +
              '<input type="hidden" value="0" id="board_people_' + tr_index + '" name="board_people_ids">' +
              '<input type="text" class="form-control ac-control" name="board_name" id="board_name_' + tr_index + '" value="" ac-method="clients" required title="Inserte el nombre" onkeyup="ac_control(this)">' +
              '<div class="ac-container"></div>' +
            '</td>' +
            '<td>' +
              (typeId == '1' ? board_last_name_obj.replace('[[tr_index]]', tr_index) : '&nbsp;') +
            '</td>' +
            '<td>' +
              '<input type="text" ac-master-field="board_people_' + tr_index + '" ac-master-data="data-unique-id" class="form-control ac-control" name="board_ids" value="" ac-method="clients" required title="Inserte el ID del director" onkeyup="ac_control(this)">' +
              '<div class="ac-container"></div>' +
            '</td>' +
            '<td style="text-align: right;">' +
              '<select name="board_types">' +
                '<option value="1">Director</option>' +
                '<option value="2">Secretario</option>' +
                '<option value="3">Tesorero</option>' +
                '<option value="4">Presidente</option>' +
                '<option value="5">Vicepresidente</option>' +
                '<option value="6">Vocal</option>' +
                '<option value="7">Otro</option>' +
              '</select>' +
            '</td>' +
            '<td>' +
              '<button type="button" id="legal_relation_delete" class="btn btn-sm btn-link"><i class="fa fa-times"></i></button>' +
            '</td>' +
          '</tr>');
    });

    $('body').on('click', '#legal_relation_delete', function(){
      let $this = $(this);
      let tr = $this.parents('tr').first();
      tr.find('input[name="board_people_status"]').val('delete');
      tr.hide();
    });

    $('body').on('click','#legal_relation_create_btn', function(){
        $('#relation_legalId').val('0');
        $('#relation_board').html('');
        $('#legal_relations_people_container').addClass('hidden');
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
        $('#board_director_last_name').val('');
        $('#board_director_id').val('');
        $('#legal_secretarioId').val(0);
        $('#board_secretario_name').val('');
        $('#board_secretario_last_name').val('');
        $('#board_secretario_id').val('');
        $('#legal_tesoreroId').val(0);
        $('#board_tesorero_name').val('');
        $('#board_tesorero_last_name').val('');
        $('#board_tesorero_id').val('');

        $('.shareholder_row_container').remove();

        $('#relation-legal-first-step .help-block.form-error, #relation-legal-second-step .help-block.form-error').remove();
        $('#relation-legal-first-step .form-control, #relation-legal-second-step .form-control').attr('style',null).removeClass('error')
    });

    $('body').on('click','#legal_relation_cancel', function(){
        $('.legal_relation_container, #legal_relation_cancel').addClass('hidden');
        $('#legal_relations_people_container').removeClass('hidden');
        $('#relation-legal-first-step label.error').remove();
        $('#relation-legal-first-step .error').removeClass('error');
        $('#relation-legal-second-step label.error').remove();
        $('#relation-legal-second-step .error').removeClass('error');
    });

    $('body').on('click','#legal_relation_next, #relation-legal-second-step h5', function(){
      if($('#relation_legalId').val() != '0'){
        $('#relation-legal-first-step .card-header').removeClass('card-primary').addClass('card-default');
        $('#relation-legal-first-step .card-block').addClass('hidden');
        $('#relation-legal-second-step .card-header').removeClass('card-default').addClass('card-primary');
        $('#relation-legal-second-step .card-block').removeClass('hidden');
      }
    });

    $('body').on('click', '#legal_relation_add', function(){
      val.validate_form($('#relation-legal-first-step-form'),
        {
          rules:{
            resident_agent:{
              check_zero: true
            }
          }
        },
        function(){
          if($('#relation_board tr:visible').length == 0){
            $('#relation_board-error').removeClass('hidden').addClass('error');
            return;
          }
          let board_people_types = {};
          let board_people_status = {};
          let board_relations_ids = {};
          let board_people_ids = {};
          let board_names = {};
          let board_last_names = {};
          let board_ids = {};
          let board_types = {};
          $('#relation_board tr').each(function(index,obj){
            let $obj = $(obj);
            let typeId = $obj.find('select[name="board_people_types"]').val();
            board_people_types['board_people_type' + index] = typeId;
            board_people_status['board_people_status' + index] = $obj.find('input[name="board_people_status"]').val();
            board_relations_ids['board_relations_ids' + index] = $obj.find('input[name="board_relations_ids"]').val();
            board_people_ids['board_people_ids' + index] = $obj.find('input[name="board_people_ids"]').val();
            board_names['board_names' + index] = $obj.find('input[name="board_name"]').val();
            board_last_names['board_last_names' + index] = typeId == '1' ? $obj.find('input[name="board_last_names"]').val() : '';
            board_ids['board_ids' + index] = $obj.find('input[name="board_ids"]').val();
            board_types['board_types' + index] = $obj.find('select[name="board_types"] option:selected').val();
          });
          let data = {
            _token: $('input[name="_token"]').val(),
            legal_relation_id: $('#relation_legalId').val(),
            client_id: '{{ $people->id }}',
            name: $('#legal_person_name').val(),
            ruc: $('#relation_objectives').val(),
            writing_number:$('#relation_writing_number').val(),
            is_agent_resident: $('input[name="is_agent_resident"]:checked').val(),
            agent_resident_id: $('#resident_agent_id').val(),
            agent_resident_name: $('#resident_agent').val(),
            board_people_types,
            board_people_status,
            board_relations_ids,
            board_people_ids,
            board_names,
            board_last_names,
            board_ids,
            board_types
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
                  $('#relation_board tr').each(function(index,obj){
                    let $obj = $(obj);
                    let $status = $obj.find('input[name="board_people_status"]');
                    $obj.find('input[name="board_relations_ids"]').val(data.board_relations_ids[index]);
                    if($status.val() != 'delete'){
                      $status.val('edit');
                    }
                  });
                }
                else{
                  // TODO poner mensaje de error en transaccion
                }
              }
            );
        }, true, null);
    });

    $('#relation-legal-first-step h5').first().click(function(){
      $('#relation-legal-first-step .card-header').removeClass('card-default').addClass('card-primary');
      $('#relation-legal-first-step .card-block').removeClass('hidden');
      $('#relation-legal-second-step .card-header').removeClass('card-primary').addClass('card-default');
      $('#relation-legal-second-step .card-block').addClass('hidden');
    });

    $('body').on('click','.legal_relation_edit', function (){
      $('.legal_relation_container, #legal_relation_cancel').addClass('hidden');
      $('#relation-legal-first-step label.error').remove();
      $('#relation-legal-first-step .error').removeClass('error');
      $('#relation-legal-second-step label.error').remove();
      $('#relation-legal-second-step .error').removeClass('error');
      $.post("{{ route('people.edit_legal_relation') }}",
        {
          _token: $('input[name="_token"]').val(),
          id: $(this).attr('data-id'),
        },
        function(data){
          data = $.parseJSON(data);
          $('#legal_relations_people_container').addClass('hidden');

          $('#relation-legal-first-step .help-block.form-error, #relation-legal-second-step .help-block.form-error').remove();
          $('#relation-legal-first-step .form-control, #relation-legal-second-step .form-control').attr('style',null).removeClass('error');

          $('#relation-legal-first-step .card-header').removeClass('card-default').addClass('card-primary');
          $('#relation-legal-first-step .card-block').removeClass('hidden');
          $('#relation-legal-second-step .card-header').removeClass('card-primary').addClass('card-default');
          $('#relation-legal-second-step .card-block').addClass('hidden');

          $('.legal_relation_container, #legal_relation_cancel').removeClass('hidden');
          $('#legal_relation_next').removeClass('hidden');

          $('#relation_legalId').val(data.legal_relation.id);
          $('#legal_person_name').val(data.legal_relation.legal_person_name);
          $('#relation_objectives').val(data.legal_relation.ruc);
          $('#relation_writing_number').val(data.writing_number);

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

          $('#relation_board').html(data.boards);

          $('.shareholder_row_container').remove();
          $('#shareholder_container').append(data.shareholders);
          if(data.total_shareholders_percetage == 100){
            $('#shareholder_new_form').hide();
          }
          else{
            $('#shareholder_new_form').show();            
          }
        });
    });

    $('body').on('click','.legal_relation_delete', function (){
      $.post("{{ route('people.delete_legal_relation') }}",
        {
          _token: $('input[name="_token"]').val(),
          $id: $(this).attr('data-id'),
          $client_id: '{{ $people->id }}'
        },
        function(data){
          console.log(data);
        });
    });    
  </script>
@endsection