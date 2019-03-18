<div class="row">
  <form id="general-info">
    <input type="hidden" id="client-typeId" name="client-typeId" value="{{ $legal_relation_display == 'hidden' ? 2 : 1 }}">
    <div class="col-xl-6">
      <div class="card card-default">
        <fieldset class="form-group col-md-12">
          <div class="col-md-4">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $people->name }}" required title="Inserte el nombre">
          </div>

          <div class="col-md-4">
            <label for="last_name" class="{{ $legal_relation_display }}">Apellido</label>
            <input type="text" class="form-control {{ $legal_relation_display }}" name="last_name" id="last_name" value="{{ $people->last_name }}" required title="Inserte el apellido">
          </div>

          <div class="col-md-4">
            <label for="email">email</label>
            <input type="text" class="form-control" name="email" id="email" value="{{ $people->email }}" required data-validation="email" title="Inserte el email">
          </div>
        </fieldset>
        <fieldset class="form-group col-md-12">
          <div class="col-md-4">
            <label for="unique_id" class="persona-natural">Cédula</label>
            <input type="text" class="form-control persona-natural" name="unique_id" id="unique_id" value="{{ $people->unique_id_number }}" required title="Inserte la cédula">
          </div>

          <div class="col-md-4">
            <label for="passport_number" class="persona-natural">Pasaporte</label>
            <input type="text" class="form-control persona-natural" name="passport_number" id="passport_number" value="{{ $people->passport_number }}" required title="Inserte el pasaporte">
          </div>

          <div class="col-md-4">
            <label for="gender">Sexo</label>
            <select class="form-control" name="gender" id="gender" required title="Escoja el sexo">
              <option></option>
              <option value="1" {{ $people->genderId == 1 ? 'selected="selected"' : '' }}>Mujer</option>
              <option value="2" {{ $people->genderId == 2 ? 'selected="selected"' : '' }}>Hombre</option>
            </select>
          </div>
        </fieldset>
        <fieldset class="form-group col-md-12">
          <div class="col-md-4">
            <label for="phone_fixed">Teléfono Principal</label>
            <input type="text" class="form-control" name="phone_fixed" id="phone_fixed" value="{{ $people->phone_fixed }}" required title="Inserte el teléfono principal">
          </div>

          <div class="col-md-4">
            <label for="phone_mobile">Teléfono Móvil</label>
            <input type="text" class="form-control" name="phone_mobile" id="phone_mobile" value="{{ $people->phone_mobile }}" required title="Inserte el teléfono móvil">
          </div>

          <div class="col-md-4">
            <label for="ocuppation">Actividad Profesional</label>
            <input type="text" class="form-control" name="ocuppation" id="ocuppation" value="{{ $people->ocuppation }}" required title="Inserte el actividad profesional">
          </div>
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
                <input type="hidden" value="{{ $people->final_recipientId }}" id="final_recipientId" name="final_recipientId">
                <input type="text" class="form-control ac-control" name="final_recipient_text" id="final_recipient_text" value="{{$people->final_recipient}}" ac-method="clients" required title="Inserte el beneficiario" data-validation-depends-on="final_recipient" data-validation-depends-on-value="0">
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
          <label for="nationality">Nacionalidad</label>
          <input type="hidden" value="{{ $people->country_nationalityId }}" id="country_nationalityId" name="country_nationalityId">
          <input type="text" class="form-control ac-control" id="nationality" name="nationality" value="{{ $country_nationality }}" ac-method="countries" required title="Inserte la nacionalidad">
          <div class="ac-container"></div>
        </fieldset>
        <fieldset class="form-group col-md-4">
          <label for="birth">Lugar de Nacimiento</label>
          <input type="hidden" value="{{ $people->country_birthId }}" id="country_birthId" name="country_birthId">
          <input type="text" class="form-control ac-control" id="birth" name="birth" value="{{ $country_birth }}" ac-method="countries" required title="Inserte el lugar de nacimiento">
          <div class="ac-container"></div>
        </fieldset>
        <fieldset class="form-group col-md-4">
          <label for="residence">Lugar de Residencia</label>
          <input type="hidden" value="{{ $people->country_residenceId }}" id="country_residenceId" name="country_residenceId">
          <input type="text" class="form-control ac-control" id="residence" name="residence" value="{{ $country_residence }}" ac-method="countries" required title="Inserte el lugar de residencia" >
          <div class="ac-container"></div>
        </fieldset>
        <fieldset class="form-group col-md-6">
          <label for="address_physical">Dirección Física</label>
          <textarea class="form-control" rows="3" id="address_physical" name="address_physical" required title="Inserte direccion física">{{ $people->address_physical }}</textarea>
        </fieldset>
        <fieldset class="form-group col-md-6">
          <label for="address_mail">Dirección de Correspondencia</label>
          <textarea class="form-control" rows="3" id="address_mail" name="address_mail" required title="Inserte la dirección de correspondencia">{{ $people->address_mail }}</textarea>
        </fieldset>
      </div>
    </div>
  </form>
</div>
<!-- /.row -->