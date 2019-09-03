<div class="row">
  <form id="general-info" autocomplete="off">
    <input autocomplete="off" name="hidden" type="text" style="display:none;">
    <input type="hidden" id="client-Id" name="client-Id" value="{{ $people->id ?? $id }}">
    <input type="hidden" id="client-relatedId" name="client-relatedId" value="{{ $people->id ?? $id }}">
    <input type="hidden" id="client-typeId" name="client-typeId" value="{{ $legal_relation_client ? 2 : 1 }}">
    <div class="col-xl-6">
      <div class="card card-default">
        <fieldset class="form-group col-md-12">
          <div class="col-md-4">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $people->name }}" required title="Ingrese el nombre">
          </div>
          @if($legal_relation_client)
          <div class="col-md-4">
            <label for="unique_id" class="persona-natural">RUC/NIT</label>
            <input type="text" class="form-control persona-natural" name="unique_id" id="unique_id" value="{{ $people->unique_id_number }}" title="Ingrese la cédula">
          </div>
          @else
          <div class="col-md-4">
            <label for="last_name" class="{{ $legal_relation_client ? 'hidden' : '' }}">Apellido</label>
            <input type="text" class="form-control {{ $legal_relation_client ? 'hidden' : '' }}" name="last_name" id="last_name" value="{{ $people->last_name }}" required title="Ingrese el apellido">
          </div>
          @endif

          <div class="col-md-4">
            <label for="email">email</label>
            <input type="text" class="form-control" name="email" id="email" value="{{ $people->email }}" required data-validation="email" title="Ingrese el email">
          </div>
        </fieldset>
        <fieldset class="form-group col-md-12">
          @if(!$legal_relation_client)
          <div class="col-md-4">
            <label for="unique_id" class="persona-natural">Cédula</label>
            <input type="text" class="form-control persona-natural" name="unique_id" id="unique_id" value="{{ $people->unique_id_number }}" title="Ingrese Ruc o Pasaporte">
          </div>
          @endif

          <div class="col-md-4">
            <label for="passport_number" class="persona-natural {{ $legal_relation_client ? 'hidden' : '' }}">Pasaporte</label>
            <input type="text" class="form-control persona-natural {{ $legal_relation_client ? 'hidden' : '' }}" name="passport_number" id="passport_number" value="{{ $people->passport_number }}" title="Ingrese Ruc o Pasaporte">
          </div>

          <div class="col-md-4">
            <label for="gender" class="{{ $legal_relation_client ? 'hidden' : '' }}">Sexo</label>
            <select class="form-control {{ $legal_relation_client ? 'hidden' : '' }}" name="gender" id="gender" required title="Escoja el sexo">
              <option></option>
              <option value="1" {{ $people->genderId == 1 ? 'selected="selected"' : '' }}>Mujer</option>
              <option value="2" {{ $people->genderId == 2 ? 'selected="selected"' : '' }}>Hombre</option>
            </select>
          </div>
        </fieldset>
        <fieldset class="form-group col-md-12">
          <div class="col-md-3">
            <label for="phone_fixed">Teléfono Principal</label>
            <input type="text" class="form-control" name="phone_fixed" id="phone_fixed" value="{{ $people->phone_fixed }}" required title="Ingrese el teléfono principal">
          </div>

          <div class="col-md-3">
            <label for="phone_mobile">{{ $legal_relation_client ? 'Fax' : 'Teléfono Móvil' }}</label>
            <input type="text" class="form-control" name="phone_mobile" id="phone_mobile" value="{{ $people->phone_mobile }}" required title="Ingrese el teléfono móvil">
          </div>

          <div class="col-md-3 {{ $legal_relation_client ? 'hidden' : '' }}">
            <label for="ocuppation" class="{{ $legal_relation_client ? 'hidden' : '' }}">Actividad Profesional</label>
            <select class="form-control {{ $legal_relation_client ? 'hidden' : '' }}" name="ocuppation" id="ocuppation" required title="Escoja la act. profesional">
              <option></option>
              <option value="1" {{ $people->occupationId == 1 ? 'selected="selected"' : '' }}>Act. profesional 1</option>
              <option value="2" {{ $people->occupationId == 2 ? 'selected="selected"' : '' }}>Act. profesional 2</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="channel">Canal</label>
            <select class="form-control" name="channel" id="channel" required title="Escoja el canal">
              <option></option>
              <option value="1" {{ $people->channelId == 1 ? 'selected="selected"' : '' }}>Directo</option>
              <option value="2" {{ $people->channelId == 2 ? 'selected="selected"' : '' }}>Referido</option>
              <option value="2" {{ $people->channelId == 3 ? 'selected="selected"' : '' }}>Página web</option>
            </select>
          </div>
        </fieldset>
        <fieldset class="form-group col-md-12 {{ $legal_relation_client ? 'hidden' : '' }}">
          <div class="col-md-12">
            <div class="col-md-6">
              <label for="final_recipient">Es usted el beneficiario final de la relación?</label>
            </div>
            <div class="col-md-6">
              <label class="radio-inline">
                  <input type="radio" name="final_recipient" id="final_recipientYes" value="1" {{ $final_recipient_name == null ? 'checked' : '' }}>Si
              </label>
              <label class="radio-inline">
                  <input type="radio" name="final_recipient" id="final_recipientNo" value="0" {{ $final_recipient_name != null ? 'checked' : '' }}>No
              </label>
              <div class="{{ $final_recipient_name != null ? '' : 'hidden' }}" id="final_recipient_container">
                <label for="final_recipient_name">Ingrese el nombre del beneficiario</label>
                <div class="col-sm-6">
                  <input type="hidden" value="{{ $people->final_recipientId }}" id="final_recipientId" name="final_recipientId">
                  <input type="text" class="form-control ac-control" name="final_recipient_name" id="final_recipient_name" value="{{$final_recipient_name}}" ac-method="clients" required title="Ingrese el beneficiario" placeholder="Nombre" title="Ingrese el nombre" data-validation-depends-on="final_recipient" data-validation-depends-on-value="0">
                  <div class="ac-container"></div>
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control ac-control" name="final_recipient_last_name" id="final_recipient_last_name" value="{{$final_recipient_last_name}}" ac-method="clients" ac-master-field="final_recipientId" ac-master-data="data-item2" title="Ingrese el apellido" placeholder="Apellido" title="Ingrese el beneficiario">
                  <div class="ac-container"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
              <label for="is_pep">Ocupa o ha ocupado algún cargo público en los dos últimos años?</label>
            </div>
            <div class="col-md-6">
              <label class="radio-inline">
                  <input type="radio" name="is_pep" id="is_pepYes" value="1" {{ $people->pep_oficial_job != null ? 'checked' : '' }}>Si
              </label>
              <label class="radio-inline">
                  <input type="radio" name="is_pep" id="is_pepNo" value="0" {{ $people->pep_oficial_job != null ? '' : 'checked' }}>No
              </label>
              <div class="{{ $people->pep_oficial_job != null ? '' : 'hidden' }}" id="pep_oficial_job_container">
                <label for="pep_oficial_job_text">Ingrese el cargo público</label>
                <input type="hidden" value="{{ $people->pep_oficial_job }}" id="pep_oficial_jobId" name="pep_oficial_jobId">
                <input type="text" class="form-control ac-control" name="pep_oficial_job_text" id="pep_oficial_job_text" value="{{ $people->pep_oficial_job }}" ac-method="oficial_job" required title="Cargo público" data-validation-depends-on="is_pep" data-validation-depends-on-value="0">
                <div class="ac-container"></div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
              <label for="is_pep_family">Tiene algún familiar dentro del primer o segundo grado de consanguinidad de afinidad que haya ocupado un cargo público en los dos últimos años?</label>
            </div>
            <div class="col-md-6">
              <label class="radio-inline">
                  <input type="radio" name="is_pep_family" id="is_pep_familyYes" value="1"  {{ $pep_family_name != null ? 'checked' : '' }}>Si
              </label>
              <label class="radio-inline">
                  <input type="radio" name="is_pep_family" id="is_pep_familyNo" value="0" {{ $pep_family_name != null ? '' : 'checked' }}>No
              </label>
              <div class="{{ $pep_family_name != null ? '' : 'hidden' }}" id="pep_family_container">
                <label for="pep_family_name">Ingrese el nombre del familiar</label>
                <div class="col-sm-6">
                  <input type="hidden" value="{{ $people->pep_family ?? '0' }}" id="pep_familyId" name="pep_familyId">
                  <input type="text" class="form-control ac-control" name="pep_family_name" id="pep_family_name" value="{{ $pep_family_name }}" ac-method="clients" required title="Ingrese el nombre" placeholder="Nombre" data-validation-depends-on="is_pep_family" data-validation-depends-on-value="0">
                  <div class="ac-container"></div>
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control ac-control" name="pep_family_last_name" id="pep_family_last_name" value="{{ $pep_family_last_name }}" ac-method="clients" title="Ingrese el apellido" placeholder="Apellido" ac-master-field="pep_familyId" ac-master-data="data-item2">
                  <div class="ac-container"></div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="card card-default">
        <fieldset class="form-group col-md-12">
          <div class="col-md-4">
            <label for="nationality">{{ $legal_relation_client ? 'Lugar de constitución' : 'Nacionalidad' }}</label>
            <input type="hidden" value="{{ $people->country_nationalityId }}" id="country_nationalityId" name="country_nationalityId">
            <input type="text" autocomplete="off" class="form-control ac-control" id="nationality" name="nationality" value="{{ $country_nationality }}" ac-method="countries" required title="Ingrese la nacionalidad">
            <div class="ac-container"></div>
          </div>
          <div class="col-md-4">
            <label for="birth" class="{{ $legal_relation_client ? 'hidden' : '' }}">Lugar de Nacimiento</label>
            <input type="hidden" value="{{ $people->country_birthId }}" id="country_birthId" name="country_birthId">
            <input type="text" class="form-control ac-control {{ $legal_relation_client ? 'hidden' : '' }}" id="birth" name="birth" value="{{ $country_birth }}" ac-method="countries" required title="Ingrese el lugar de nacimiento">
            <div class="ac-container"></div>
          </div>
          <div class="col-md-4">
            <label for="residence" class="{{ $legal_relation_client ? 'hidden' : '' }}">Lugar de Residencia</label>
            <input type="hidden" value="{{ $people->country_residenceId }}" id="country_residenceId" name="country_residenceId">
            <input type="text" class="form-control ac-control {{ $legal_relation_client ? 'hidden' : '' }}" id="residence" name="residence" value="{{ $country_residence }}" ac-method="countries" required title="Ingrese el lugar de residencia" >
            <div class="ac-container"></div>
          </div>
        </fieldset>
        <fieldset class="form-group col-md-12">
          <div class="col-md-6">
            <label for="address_physical">Dirección Física</label>
            <textarea class="form-control" rows="3" id="address_physical" name="address_physical" required title="Ingrese direccion física">{{ $people->address_physical }}</textarea>
          </div>
          <div class="col-md-6">
            <label for="address_mail">Dirección de Correspondencia</label>
            <textarea class="form-control" rows="3" id="address_mail" name="address_mail" required title="Ingrese la dirección de correspondencia">{{ $people->address_mail }}</textarea>
          </div>
        </fieldset>
      </div>
    </div>
  </form>
</div>
<div class="row">
  <div class="col-xl-12 {{ $people_persons == null ? 'hidden' : '' }}" id="persons-container">
    @if($people_persons)
      @foreach($people_persons as $people_related)
    <div class="col-sm-2">
      <a data-id="{{ $people_related->id }}" class="btn btn-link person {{$people_related->id == $people->id ? 'active' : ''}}">{{ $people_related->name }} {{ $people_related->last_name }}</a>
    </div>
      @endforeach
    @endif
    <div class="col-sm-2">
      <a class="btn btn-link" id="add-new-person">+Agregar nuevo</a>
    </div>
  </div>
</div>
<!-- /.row -->