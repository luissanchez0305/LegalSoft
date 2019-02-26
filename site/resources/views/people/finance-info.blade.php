<div class="row">
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Información Financiera</h3>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="name">A que actividad se dedica</label>
        <input type="text" class="form-control" name="activity_financial" value="{{ $people->activity_financial }}">

        <label for="last_name">Monto aproximado de su renta anual</label>
        <select class="form-control">
          <option></option>
          <option {{ $people->annual_income_lower_limit != null && $people->annual_income_lower_limit == 0 ? 'selected="selected"' : '' }}>0 - 50k</option>
          <option {{ $people->annual_income_lower_limit == 51 ? 'selected="selected"' : '' }}>51k - 100k</option>
          <option {{ $people->annual_income_lower_limit == 101 ? 'selected="selected"' : '' }}>101k - 150k</option>
          <option {{ $people->annual_income_lower_limit == 151 ? 'selected="selected"' : '' }}>151k+</option>
        </select>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="name">País donde realiza su actividad económica</label>
        <input type="hidden" value="{{ $people->country_activity_financialId }}" name="country_activity_financialId">
        <input type="text" class="form-control ac-control" id="country_activity_financial" name="country_activity_financial" value="{{ $country_activity_financial }}" ac-method="countries">
        <div class="ac-container"></div>


        <label for="last_name">Monto aproximado de su patrimonio</label>
        <select class="form-control">
          <option></option>
          <option {{ $people->legacy_lower_limit != null && $people->legacy_lower_limit == 0 ? 'selected="selected"' : '' }}>0 - 100k</option>
          <option {{ $people->legacy_lower_limit == 101 ? 'selected="selected"' : '' }}>101k - 200k</option>
          <option {{ $people->legacy_lower_limit == 201 ? 'selected="selected"' : '' }}>201k - 300k</option>
          <option {{ $people->legacy_lower_limit == 301 ? 'selected="selected"' : '' }}>301k+</option>
        </select>
      </fieldset>
    </div>
  </div>
  <div class="col-xl-6">
    <div class="card card-default">
      <fieldset class="col-md-12">
          <h3>Servicios o Productos Solicitados</h3>
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="product">Productos o servicios solicitados</label>
        <input type="hidden" value="{{ $people->productId }}" name="productId">
        <input type="text" class="form-control" id="product" name="product" value="{{ $product }}" ac-method="products">
        <div class="ac-container"></div>
        <label for="name">Propósito de la relación</label>
        <input type="text" class="form-control" name="relation_objectives" value="{{ $people->relation_objectives }}">
      </fieldset>
      <fieldset class="form-group col-md-6">
        <label for="last_name">Estructura jurídica, solicitada</label>
        <select class="form-control">
          <option></option>
          <option {{ $people->legal_structureId == 1 ? 'selected="selected"' : '' }}>SA</option>
          <option {{ $people->legal_structureId == 2 ? 'selected="selected"' : '' }}>SA extranjera registrada en Panamá</option>
          <option {{ $people->legal_structureId == 3 ? 'selected="selected"' : '' }}>Fundación</option>
          <option {{ $people->legal_structureId == 4 ? 'selected="selected"' : '' }}>SRL</option>
          <option {{ $people->legal_structureId == 5 ? 'selected="selected"' : '' }}>Fideicomiso</option>
          <option {{ $people->legal_structureId == 6 ? 'selected="selected"' : '' }}>Sin fines de lucro</option>
          <option {{ $people->legal_structureId == 7 ? 'selected="selected"' : '' }}>Otras estructuras</option>
        </select>
      </fieldset>
    </div>
  </div>
</div>