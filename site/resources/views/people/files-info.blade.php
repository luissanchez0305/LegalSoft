<div class="row">
  <div class="col-xl-6">
    <!-- New-Log-Section -->
        <form id="add-new-file-form">
            @csrf
            <fieldset class="form-group col-md-6">
                <label>Imagen</label>
                <input type="file" name="file-name" id="file-name" required title="Por favor inserte un archivo"/>
                <br/>
                <label>Tipo</label>
                <select class="form-control" id="file-item-type" name="file-item-type" required title="Por favor inserte un tipo de archivo">
                    <option></option>
                    @foreach($file_types as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="form-group col-md-6">
                <label>Descripcion</label>
                <textarea class="form-control" id="file-item-description" name="file-item-description" rows="3" required title="Por favor inserte una descripción"></textarea>
                <button type="button" id="add-new-file-button" class="btn btn-secondary">Guardar</button>
            </fieldset>
            <div class="col-md-12">
                <label id="file-upload-result"></label>
            </div>
        </form>
  </div>
  <div class="col-xl-12">
    <div class="col-md-6">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Tipo</th>
                  <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody id="files_container">
            @foreach($files as $item)
                <tr>
                    <td>
                        {{ $item->client_file_name }}
                    </td>
                    <td>
                        {{ $item->file_type_name }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger document_delete" data-id="{{ $item->file_id }}">Borrar</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>