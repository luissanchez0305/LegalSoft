
<div class="row col-sm-12 hidden legal_relation_container">
  <div class="card card-inverse" id="relation-legal-first-step">
    <div class="row col-sm-12 legal_relation_step_container">
      <form id="relation-legal-first-step-form">
        <div class="card-header card-primary">
            <h5>1er Paso - Informacion General y Junta Directiva</h5>
        </div>
        <div class="card-block legal-first-step-container">
          <input type="hidden" value="0" id="relation_legalId">
          <div class="col-sm-4">
            <fieldset class="col-md-12">
                <h3>Información</h3>
            </fieldset>
            <fieldset class="form-group col-md-8">
              <label for="relation_legal_name">Nombre</label>
              <input type="text" class="form-control" id="legal_person_name" name="legal_person_name" value="" required title="Inserte el nombre">
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
                  <input type="hidden" name="resident_agent_id" id="resident_agent_id" value="0">
                  <input type="text" class="form-control ac-control" name="resident_agent" id="resident_agent" ac-method="clients" value="" required title="Inserte el agente residente">
                  <div class="ac-container"></div>
                </div>
              </div>
            </fieldset>
            <fieldset class="form-group col-md-4">
              <label for="name">Ruc</label>
              <input type="text" class="form-control" name="relation_objectives" id="relation_objectives" value="" required title="Inserte el RUC">
            </fieldset>
          </div>
          <div class="col-sm-8">
            <fieldset class="col-md-12">
                <h3>Directores y Dignatarios</h3>
            </fieldset>
            <fieldset class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>#ID Único o RUC</th>
                        <th style="width: 150px;">Rol</th>
                        <th>&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody id="relation_board">
                  </tbody>
                </table>
                <button type="button" class="btn btn-success legal_relation_create_item" data-type="1"><i class="fa fa-fw fa-plus-square"></i> Persona Natural</button>
                <button type="button" class="btn btn-success legal_relation_create_item" data-type="2"><i class="fa fa-fw fa-plus-square"></i> Persona Jurídica</button>
              </div>
            </fieldset>
          </div>
          <div class="col-xl-12">
            <button type="button" class="btn btn-warning" id="legal_relation_add">Guardar</button><a href="#" class="hidden" id="legal_relation_next">Siguiente</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="row col-sm-12 hidden legal_relation_container">
  <div class="card card-inverse" id="relation-legal-second-step">
    <div class="row col-sm-12 legal_relation_step_container">
      <div class="card-header card-default">
          <h5>2do paso - Accionistas</h5>
      </div>
      <div class="card-block hidden">
        <fieldset class="col-md-12">
          <div class="table-responsive">
            <form id="new-shareholder-container">
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
                    <tr>
                      <td>
                        @csrf
                        <input type="text" class="form-control" id="shareholder_client_people_certification_number" name="shareholder_client_people_certification_number" value="" required title="Inserte el numero de certificado"/>
                      </td>
                      <td>
                        <select class="form-control" id="shareholder_client_people_action_typeId" name="shareholder_client_people_action_typeId" required title="Inserte el tipo de acción">
                          <option></option>
                          @foreach($share_types as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <input type="hidden" value="0" name="shareholder_client_peopleId" id="shareholder_client_peopleId"/>
                        <input type="text" class="form-control ac-control" id="shareholder_client_people_name" name="shareholder_client_people_name" value="" ac-method="clients" required title="Inserte el nombre"/>
                        <div class="ac-container"></div>
                      </td>
                      <td>
                        <input type="text" class="form-control" id="shareholder_client_people_id" name="shareholder_client_people_id" value="" required title="Inserte el RUC" ac-master-data="data-unique-id" ac-master-field="shareholder_client_peopleId"/>
                      </td>
                      <td>
                        <input type="hidden" value="0" id="shareholder_client_people_country_birthId"/>
                        <input type="text" class="form-control ac-control" id="shareholder_people_country_birth_name" name="shareholder_people_country_birth_name" value="" ac-method="countries" required title="Inserte el país de nacimiento"/>
                        <div class="ac-container"></div>
                      </td>
                      <td>
                        <input type="hidden" value="0" id="shareholder_client_people_country_nationalityId"/>
                        <input type="text" class="form-control ac-control" id="shareholder_people_country_nationality_name" name="shareholder_people_country_nationality_name" value="" ac-method="countries" required title="Inserte la nacionalidad"/>
                        <div class="ac-container"></div>
                      </td>
                      <td>
                        <input type="text" class="form-control" id="shareholder_client_people_phone_number" name="shareholder_client_people_phone_number" value="" required title="Inserte un numero de telefono"/>
                      </td>
                      <td>
                        <input type="text" class="form-control" id="shareholder_client_people_email" name="shareholder_client_people_email" value="" required title="Inserte un email válido"/>
                      </td>
                      <td>
                        <input type="text" class="form-control" id="shareholder_client_people_percentage" name="shareholder_client_people_percentage" value="" required title="Inserte un porcentaje válido"/>
                      </td>
                      <td>
                        <button type="button" class="btn btn-success" id="add-shareholder-btn">Agregar</button>
                      </td>
                    </tr>
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
            </form>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
</div>