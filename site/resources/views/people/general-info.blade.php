<div class="row">
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="form-group col-md-4">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" name="name" value="{{ $people->name }}">

        <label for="name">Cédula</label>
        <input type="text" class="form-control" name="unique_id" value="{{ $people->unique_id_number }}">

        <label for="name">Teléfono Principal</label>
        <input type="text" class="form-control" name="phone_fixed" value="{{ $people->phone_fixed }}">
      </fieldset>
      <fieldset class="form-group col-md-4">
        <label for="last_name">Apellido</label>
        <input type="text" class="form-control" name="last_name" value="{{ $people->last_name }}">

        <label for="name">Pasaporte</label>
        <input type="text" class="form-control" name="passport_number" value="{{ $people->passport_number }}">

        <label for="name">Teléfono Móvil</label>
        <input type="text" class="form-control" name="phone_mobile" value="{{ $people->phone_mobile }}">
      </fieldset>
      <fieldset class="form-group col-md-4">
        <label for="name">email</label>
        <input type="text" class="form-control" name="email" value="{{ $people->email }}">

        <label for="last_name">Sexo</label>
        <select class="form-control">
          <option></option>
          <option {{ $people->genderId == 2 ? 'selected="selected"' : '' }}>Hombre</option>
          <option {{ $people->genderId == 1 ? 'selected="selected"' : '' }}>Mujer</option>
        </select>

        <label for="name">Actividad Profesional</label>
        <input type="text" class="form-control" name="ocuppation" value="{{ $people->ocuppation }}">
      </fieldset>
      <fieldset class="form-group col-md-12">
        <div class="col-md-12">
          <div class="col-md-6">
            <label for="final_recipient">Es usted el beneficiario final de la relación?</label>
          </div>
          <div class="col-md-6">
            <label class="radio-inline">
                <input type="radio" name="final_recipient" id="final_recipientYes" value="1" {{ $final_recipient == null ? 'checked' : '' }}>Si
            </label>
            <label class="radio-inline">
                <input type="radio" name="final_recipient" id="final_recipientNo" value="0" {{ $final_recipient != null ? 'checked' : '' }}>No
            </label>
            <div class="{{ $final_recipient != null ? '' : 'hidden' }}" id="final_recipient_container">
              <label for="final_recipient_text">Ingrese el nombre del beneficiario</label>
              <input type="hidden" value="{{ $people->final_recipientId }}" name="final_recipientId">
              <input type="text" class="form-control" name="final_recipient_text" id="final_recipient_text" value="{{$people->final_recipient}}" ac-method="clients">
              <div class="ac-container"></div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="col-md-6">
            <label for="is_pep">Ocupa o ha ocupado algún cargo público en los dos últimos años?</label>
          </div>
          <div class="col-md-6">
            <label class="radio-inline">
                <input type="radio" name="is_pep" id="is_pepYes" value="1" {{ $people->is_pep == 1 ? 'checked' : '' }}>Si
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_pep" id="is_pepNo" value="0" {{ $people->is_pep == 1 ? '' : 'checked' }}>No
            </label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="col-md-6">
            <label for="is_pep_family">Tiene algún familiar dentro del primer o segundo grado de consanguinidad de afinidad que haya ocupado un cargo público en los dos últimos años?</label>
          </div>
          <div class="col-md-6">
            <label class="radio-inline">
                <input type="radio" name="is_pep_family" id="is_pep_familyYes" value="1"  {{ $people->is_pep_family == 1 ? 'checked' : '' }}>Si
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_pep_family" id="is_pep_familyNo" value="0" {{ $people->is_pep_family == 1 ? '' : 'checked' }}>No
            </label>
          </div>
        </div>
      </fieldset>
    </div>
  </div>
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="form-group col-md-4">
        <label for="name">Nacionalidad</label>
        <input type="hidden" value="{{ $people->country_nationalityId }}" name="country_nationalityId">
        <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $country_nationality }}" ac-method="countries">
        <div class="ac-container"></div>
      </fieldset>
      <fieldset class="form-group col-md-4">
        <label for="name">Lugar de Nacimiento</label>
        <input type="hidden" value="{{ $people->country_birthId }}" name="country_birthId">
        <input type="text" class="form-control" id="birth" name="birth" value="{{ $country_birth }}" ac-method="countries">
        <div class="ac-container"></div>
      </fieldset>
      <fieldset class="form-group col-md-4">
        <label for="name">Lugar de Residencia</label>
        <input type="hidden" value="{{ $people->country_residenceId }}" name="country_residenceId">
        <input type="text" class="form-control" id="residence" name="residence" value="{{ $country_residence }}" ac-method="countries">
        <div class="ac-container"></div>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label>Dirección Física</label>
        <textarea class="form-control" rows="3" name="address_physical">{{ $people->address_physical }}</textarea>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label>Dirección de Correspondencia</label>
        <textarea class="form-control" rows="3" name="address_mail">{{ $people->address_mail }}</textarea>
      </fieldset>
    </div>
  </div>
</div>
<!-- /.row -->