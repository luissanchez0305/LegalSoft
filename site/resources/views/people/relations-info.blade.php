<div class="row">
  <div class="col-xl-12">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Personas Jurídicas <a href="#" class="btn btn-warning" id="legal_relation_create_btn">Nuevo</a></h3>

      </fieldset>
      <fieldset class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Ruc</th>
                  <th colspan="2">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @if($legal_relations != null && count($legal_relations) > 0)
                @foreach($legal_relations as $item)
                <tr>
                  <td>
                    {{ $item->legal_person_name }}
                  </td>
                  <td>
                    {{ $item->ruc }}
                  </td>
                  <td>
                    <a href="#" class="btn btn-warning legal_relation_edit" data-id="{{ $item->id }}">Editar</a>
                  </td>
                  <td>
                    <a href="#" class="btn btn-danger legal_relation_delete" data-id="{{ $item->id }}">Editar</a>
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
</div>
<div class="row hidden legal_relation_container">
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Información</h3>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="relation_legal_name">Nombre</label>
        <input type="text" class="form-control" id="legal_person_name" name="legal_person_name" value="">

        <div class="col-md-12">
          <label for="is_agent_resident">Es agente residente?</label>
          <label class="radio-inline">
              <input type="radio" name="is_agent_resident" id="is_agent_residentYes" value="1" checked="checked">Si
          </label>
          <label class="radio-inline">
              <input type="radio" name="is_agent_resident" id="is_agent_residentNo" value="0">No
          </label>
          <div class="hidden" id="agent_resident_container">
            <label for="final_recipient_text">Ingrese el nombre del agente residente<br/>(Escoja uno si ya existe)</label>
            <input type="hidden" name="resident_agent_id" value=""0">
            <input type="text" class="form-control ac-control" name="resident_agent" id="resident_agent" value="">
            <div class="ac-container"></div>
          </div>
        </div>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="name">Ruc</label>
        <input type="text" class="form-control" name="relation_objectives" value="">
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
                  <th>Nombre (Escoja uno si ya existe)</th>
                  <th>Rol</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
          </table>
        </div>
      </fieldset>
    </div>
  </div>
</div>
<div class="row hidden legal_relation_container">
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
            <tbody id="shareholder_container">
              <form id="new_shareholder_container">
                <tr>
                  <td>
                    @csrf
                    <input type="hidden" id="shareholder_clientId" value="{{ $people->id }}">
                    <input type="text" class="form-control" id="shareholder_client_people_certification_number" value="">
                  </td>
                  <td>
                    <select id="shareholder_client_people_action_typeId">
                      <option></option>
                      @foreach($share_types as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="hidden" value="0" name="shareholder_client_peopleId" id="shareholder_client_peopleId">
                    <input type="text" class="form-control ac-control" id="shareholder_client_people_name" name="shareholder_client_people_name" value="" ac-method="clients">
                    <div class="ac-container"></div>
                  </td>
                  <td>
                    <input type="text" class="form-control" id="shareholder_client_people_ruc" value="">
                  </td>
                  <td>
                    <input type="hidden" value="" id="shareholder_client_people_country_birthId">
                    <input type="text" class="form-control ac-control" id="shareholder_people_country_birth_name" name="shareholder_people_country_birth_name" value="" ac-method="countries">
                    <div class="ac-container"></div>
                  </td>
                  <td>
                    <input type="hidden" value="" id="shareholder_client_people_country_nationalityId">
                    <input type="text" class="form-control ac-control" id="shareholder_people_country_nationality_name" name="shareholder_people_country_nationality_name" value="" ac-method="countries">
                    <div class="ac-container"></div>
                  </td>
                  <td>
                    <input type="text" class="form-control" id="shareholder_client_people_phone_number" value="">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="shareholder_client_people_email" value="">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="shareholder_client_people_percentage" value="">
                  </td>
                  <td>
                    <button type="button" class="btn btn-success" id="add-shareholder-btn">Agregar</button>
                  </td>
                </tr>
              </form>
              @if($shareholders != null && count($shareholders) > 0)
              @foreach($shareholders as $item)
              <tr class="shareholder_row_container">
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
                  {{ $item->people_ruc }}
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
                  <button type="button" class="btn btn-danger shareholder-delete">Borrar</button>
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
  <div class="col-xl-6">
    <a href="#" class="btn btn-warning" id="legal_relation_add">Guardar Persona Jurídica</a>
    <a href="#" id="legal_relation_cancel">Cancel</a>
  </div>
</div>