<div class="row">
  <form id="finance-info">
    <div class="col-xl-6">
      <div class="card card-default">
        <fieldset class="col-md-12">
            <h3>Información Financiera</h3>
        </fieldset>
        <fieldset class="form-group col-md-6">
          <label for="name">A que actividad se dedica</label>
          <input type="text" class="form-control" name="activity_financial" id="activity_financial" value="{{ $people->activity_financial }}">

          <label for="last_name">Monto aproximado de su renta anual</label>
          <select class="form-control" id="annual_income_limits" name="annual_income_limits">
            <option></option>
            <option value="1-50" {{ $people->annual_income_lower_limit != null && $people->annual_income_lower_limit == 1 ? 'selected="selected"' : '' }}>0 - 50k</option>
            <option value="51-100" {{ $people->annual_income_lower_limit == 51 ? 'selected="selected"' : '' }}>51k - 100k</option>
            <option value="101-150" {{ $people->annual_income_lower_limit == 101 ? 'selected="selected"' : '' }}>101k - 150k</option>
            <option value="151-" {{ $people->annual_income_lower_limit == 151 ? 'selected="selected"' : '' }}>151k+</option>
          </select>
        </fieldset>
        <fieldset class="form-group col-md-6">
          <label for="name">País donde realiza su actividad económica</label>
          <input type="hidden" value="{{ $people->country_activity_financialId }}" id="country_activity_financialId" name="country_activity_financialId">
          <input type="text" class="form-control ac-control" id="country_activity_financial" name="country_activity_financial" value="{{ $country_activity_financial }}" ac-method="countries" required title="Introduzca el pais de actividad económica">
          <div class="ac-container"></div>


          <label for="last_name">Monto aproximado de su patrimonio {{$people->legacy_lower_limit}}</label>
          <select class="form-control" id="legacy_limits" name="legacy_limits">
            <option></option>
            <option value="1-100" {{ $people->legacy_lower_limit != null && $people->legacy_lower_limit == 1 ? 'selected="selected"' : '' }}>0 - 100k</option>
            <option value="101-200" {{ $people->legacy_lower_limit == 101 ? 'selected="selected"' : '' }}>101k - 200k</option>
            <option value="201-300" {{ $people->legacy_lower_limit == 201 ? 'selected="selected"' : '' }}>201k - 300k</option>
            <option value="301-" {{ $people->legacy_lower_limit == 301 ? 'selected="selected"' : '' }}>301k+</option>
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
          <select class="form-control" name="product" id="product" required title="Escoja el canal">
            <option></option>
            @foreach($products_services as $item)
            <option value="{{ $item->id }}" {{ $people->productId == $item->id ? 'selected="selected"' : '' }}>{{$item->name}}</option>
            @endforeach
          </select>
          <label for="name">Propósito de la relación</label>
          <input type="text" class="form-control" id="relation_objectives_txt" name="relation_objectives_txt" value="{{ $people->relation_objectives }}">
        </fieldset>
        <fieldset class="form-group col-md-6">
          <label for="last_name">Estructura jurídica, solicitada</label>
          <select class="form-control" id="legal_structure" name="legal_structure">
            <option></option>
            @foreach($legal_structures as $item)
            <option value="{{ $item->id }}" {{ $people->legal_structureId == $item->id ? 'selected="selected"' : '' }}>{{ $item->name }}</option>
            @endforeach
          </select>
        </fieldset>
      </div>
    </div>
  </form>
</div>