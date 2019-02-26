<div class="row">
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Persona Jurídica</h3>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="relation_legal_name">Nombre (Escoja uno si ya existe)</label>
        <input type="hidden" value="{{ $legal_relation != null ? $legal_relation->id : 0 }}" name="legal_relationId">
        <input type="text" class="form-control ac-control" id="relation_legal_name" name="relation_legal_name" value="{{ $legal_relation != null ? $legal_relation->name . ' ' . $legal_relation->last_name : '' }}" ac-method="clients">
        <div class="ac-container"></div>

        <div class="col-md-12">
          <label for="is_agent_resident">Es agente residente?</label>
          <label class="radio-inline">
              <input type="radio" name="is_agent_resident" id="is_agent_residentYes" value="1" {{ $legal_relation == null || ($legal_relation != null && strlen($legal_relation->agent_resident) == 0) ? 'checked' : '' }}>Si
          </label>
          <label class="radio-inline">
              <input type="radio" name="is_agent_resident" id="is_agent_residentNo" value="0" {{ $legal_relation != null && strlen($legal_relation->agent_resident) > 0 ? 'checked' : '' }}>No
          </label>
          <div class="{{ $legal_relation != null && strlen($legal_relation->agent_resident) > 0 ? '' : 'hidden' }}" id="agent_resident_container">
            <label for="final_recipient_text">Ingrese el nombre del agente residente</label>
            <input type="text" class="form-control" name="agent_resident" id="agent_resident" value="{{ $legal_relation != null && strlen($legal_relation->agent_resident) > 0 ? $legal_relation->agent_resident : '' }}">
          </div>
        </div>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="name">Ruc</label>
        <input type="text" class="form-control" name="relation_objectives" value="{{ $legal_relation != null ? $legal_relation->ruc : '' }}">
      </fieldset>
    </div>
  </div>
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Directores y Dignatarios</h3>
      </fieldset>
      <fieldset class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Rol</th>
                </tr>
            </thead>
            <tbody>
              @if($board != null && count($board) > 0)
              @foreach($board as $item)
              <tr>
                <td>
                  <input type="hidden" value="{{ $item->people_id }}" name="board_{{ strtolower($item->type_name) }}Id">
                  <input type="text" class="form-control ac-control" id="board_director_name" name="board_director_name" value="{{ $item->people_name . ' ' . $item->people_last_name }}" ac-method="clients">
                  <div class="ac-container"></div>
                </td>
                <td>
                  {{ $item->type_name}}
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>
                  <input type="hidden" value="0" name="board_directorId">
                  <input type="text" class="form-control ac-control" id="board_director_name" name="board_director_name" value="" ac-method="clients">
                  <div class="ac-container"></div>
                </td>
                <td>Director</td>
              </tr>
              <tr>
                <td>
                  <input type="hidden" value="0" name="legal_secretarioId">
                  <input type="text" class="form-control ac-control" id="board_secretario_name" name="board_secretario_name" value="" ac-method="clients">
                  <div class="ac-container"></div>
                </td>
                <td>Secretario</td>
              </tr>
              <tr>
                <td>
                  <input type="hidden" value="0" name="legal_tesoreroId">
                  <input type="text" class="form-control ac-control" id="board_tesorero_name" name="board_tesorero_name" value="" ac-method="clients">
                  <div class="ac-container"></div>
                </td>
                <td>Tesorero</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </fieldset>
    </div>
  </div>
</div>
<div>
  <div class="col-xl-12">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Accionistas</h3>
      </fieldset>
      <fieldset class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                  <th># de certificado</th>
                  <th>Tipo de acción</th>
                  <th>Nombre</th>
                  <th># ID personal</th>
                  <th>País de nacimiento</th>
                  <th>Nacionalidad</th>
                  <th>Teléfono</th>
                  <th>email</th>
                  <th>Porcentaje (%)</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="text" class="form-control ac-control" id="shareholder_certification_number" name="shareholder_certification_number" value="">
                </td>
                <td>
                  <input type="hidden" value="" name="shareholder_action_typeId">
                  <input type="text" class="form-control ac-control" id="shareholder_type_name" name="shareholder_type_name" value="" ac-metdod="types_share">
                  <div class="ac-container"></div>
                </td>
                <td>
                  <input type="hidden" value="" name="shareholder_peopleId">
                  <input type="text" class="form-control ac-control" id="shareholder_name" name="shareholder_name" value="" ac-metdod="clients">
                  <div class="ac-container"></div>
                </td>
                <td>
                  <input type="text" class="form-control" id="shareholder_people_ruc" name="shareholder_people_ruc" value="">
                </td>
                <td>
                  <input type="hidden" value="" name="shareholder_people_country_birthId">
                  <input type="text" class="form-control ac-control" id="shareholder_people_country_birth_name" name="shareholder_people_country_birth_name" value="" ac-metdod="countries">
                  <div class="ac-container"></div>
                </td>
                <td>
                  <input type="hidden" value="" name="shareholder_people_country_nationalityId">
                  <input type="text" class="form-control ac-control" id="shareholder_people_country_nationality_name" name="shareholder_people_country_nationality_name" value="" ac-metdod="countries">
                  <div class="ac-container"></div>
                </td>
                <td>
                  <input type="text" class="form-control" id="shareholder_people_phone_number" name="shareholder_people_phone_number" value="">
                </td>
                <td>
                  <input type="text" class="form-control ac-control" id="shareholder_people_email" name="shareholder_people_email" value="">
                </td>
                <td>
                  <input type="text" class="form-control ac-control" id="shareholder_percentage" name="shareholder_percentage" value="">
                </td>
                <td>
                  <button type="button" class="btn btn-success">Agregar</button>
                </td>
              </tr>
              @if($shareholders != null && count($shareholders) > 0)
              @foreach($shareholders as $item)
              <tr>
                <td>
                  {{ $item->cert_number }}
                </td>
                <td>
                  {{ $item->type_name }}
                </td>
                <td>
                  {{ $item->people_name . ' ' . $item->people_last_name }}
                </td>
                <td>
                  {{ $item->ruc }}
                </td>
                <td>
                  {{ $item->people_country_birth_name }}
                </td>
                <td>
                  {{ $item->people_country_nationality_name }}
                </td>
                <td>
                  {{ $item->people_phone_mobile }}
                </td>
                <td>
                  {{ $item->people_email }}
                </td>
                <td>
                  {{ $item->share_percentage }}
                </td>
                <td>
                  <button type="button" class="btn btn-danger">Borrar</button>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </fieldset>
    </div>
  </div>
</div>