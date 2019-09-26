@include('people.relations-info-forms')
<a href="#" class="hidden" id="legal_relation_cancel" style="text-align: right;">Regresar al listado</a>
<div class="row" id="legal_relations_people_container">
  <div class="col-xl-12">
    <fieldset class="col-md-12">
      <h3>Personas Jurídicas</h3>
      <a href="#" class="btn btn-warning" id="legal_relation_create_btn">Nuevo</a>
    </fieldset>
    <fieldset class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Ruc</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody id="legal_relations_container">
            @if($legal_relations != null && count($legal_relations) > 0)
            @foreach($legal_relations as $item)
            <tr class="legal_relation_edit hand" data-id="{{ $item->id }}">
              <td>
                {{ $item->legal_person_name }}
              </td>
              <td>
                {{ $item->ruc }}
              </td>
              <td>
                <a href="#" class="btn btn-danger legal_relation_delete" data-id="{{ $item->id }}">Borrar</a>
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
