<div class="row">
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Persona Jurídica</h3>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="relation_legal_name">Nombre (Escoja uno si ya existe)</label>
        <input type="hidden" value="{{ $legal_relation != null ? $legal_relation->id : 0 }}" name="legal_relationId">
        <input type="text" class="form-control" id="relation_legal_name" name="relation_legal_name" value="{{ $legal_relation != null ? $legal_relation->name . ' ' . $legal_relation->last_name : '' }}" ac-method="clients">
        <div class="ac-container"></div>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="name">Ruc</label>
        <input type="text" class="form-control" name="relation_objectives" value="{{ $legal_relation != null ? $legal_relation->ruc : '' }}">
      </fieldset>
      <fieldset class="form-group col-md-6">
        <div class="col-md-6">
          <label for="is_agent_resident">Es agente residente?</label>
        </div>
        <div class="col-md-6">
          <label class="radio-inline">
              <input type="radio" name="is_agent_resident" id="is_agent_residentYes" value="1" {{ $legal_relation == null || ($legal_relation != null && strlen($legal_relation->agent_resident) == 0) ? 'checked' : '' }}>Si
          </label>
          <label class="radio-inline">
              <input type="radio" name="is_agent_resident" id="is_agent_residentNo" value="0" {{ $legal_relation != null && strlen($legal_relation->agent_resident) > 0 ? 'checked' : '' }}>No
          </label>
          <div class="{{ $legal_relation != null && strlen($legal_relation->agent_resident) > 0 ? '' : 'hidden' }}" id="final_recipient_container">
            <label for="final_recipient_text">Ingrese el nombre del agente residente</label>
            <input type="text" class="form-control" name="agent_resident" id="agent_resident" value="{{ $legal_relation != null && strlen($legal_relation->agent_resident) > 0 ? $legal_relation->agent_resident : '' }}">
          </div>
        </div>
      </fieldset>
    </div>
  </div>
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Directores y Dignatarios</h3>
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
    </div>
  </div>
</div>