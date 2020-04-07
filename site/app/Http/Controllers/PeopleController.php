<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class PeopleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $people = \App\People::where('status_id', '=', '1')->where('type_clientId','=',$id == 'natural' ? 1 : 2)->get();
        return view('people/index',compact('people'));
    }

    public function choose_title($type){
        return $type == 'natural' || $type == 1 ? " Persona Natural" : " Persona Jurídica";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($type_text)
    {
        //
        $action_type = 'add';
        $action_type_text = "Nueva " . $this->choose_title($type_text);
        $legal_relation_client = $type_text == 'natural' ? false : true;
        $id = 0;
        $people_relatedId = 0;
        $final_recipient = null;
        $country_activity_financial = null;
        /*- sacar nombre de pais de residencia*/
        $country_residence = null;
        /*- sacar nombre de pais de nacimiento*/
        $country_birth = null;
        /*- sacar nombre de pais de nacionalidad*/
        $country_nationality = null;
        // sacar nombre de producto
        $product = null;
        $legal_relations = null;
        $board = null;
        $shareholders = null;
        $people = new \App\People;
        $legal_structures = \App\Legal_Structure::all();
        $products_services = \App\Product::all();
        $share_types = \App\Type_Share::all();
        $file_types = \App\Type_File::all();
        $files = $this->get_files_array(0);
        $new_client = true;
        $final_recipient_name = null;
        $final_recipient_last_name = null;
        $pep_family_name = null;
        $pep_family_last_name = null;
        $people_persons = null;
        return view('people/form',compact('people', 'action_type', 'legal_relation_client', 'action_type_text', 'id', 'people_relatedId', 'country_residence', 'country_birth', 'final_recipient', 'country_nationality', 'country_activity_financial', 'product', 'legal_relations','board', 'shareholders', 'share_types', 'file_types', 'files', 'legal_structures', 'products_services', 
            'new_client', 'pep_family_name', 'pep_family_last_name', 'final_recipient_name','final_recipient_last_name', 'people_persons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Responses
     */
    public function edit($id)
    {
        //
        $people = \App\People::find($id);
        $legal_relation_client = false;
        if($people->type_clientId == 2)
            $legal_relation_client = true;
        $action_type = 'edit';
        $action_type_text = "Guardar Cambios - " . $this->choose_title($people->type_clientId);
        /*- sacar nombre de pais de residencia*/
        $country_residence = \App\Country::find($people->country_residenceId)->name;
        /*- sacar nombre de pais de nacimiento*/
        $country_birth = \App\Country::find($people->country_birthId)->name;
        /*- sacar nombre de pais de nacionalidad*/
        $country_nationality = \App\Country::find($people->country_nationalityId)->name;

        $final_recipient_name = null;
        $final_recipient_last_name = null;
        if($people->final_recipientId > 0){
            $final_recipient = \App\People::find($people->final_recipientId);
            $final_recipient_name = $final_recipient->name;
            $final_recipient_last_name = $final_recipient->last_name;
        }

        $pep_family = null;
        $pep_family_name = null;
        $pep_family_last_name = null;
        if($people->pep_family > 0){
            $pep_family = \App\People::find($people->pep_family);
            $pep_family_name = $pep_family->name;
            $pep_family_last_name = $pep_family->last_name;
        }

        $country_activity_financial = '';
        if($people->country_activity_financialId > 0)
            $country_activity_financial = \App\Country::find($people->country_activity_financialId)->name;

        $product = '';
        if($people->productId > 0)
            $product = \App\Product::find($people->productId)->name;

        $legal_structures = \App\Legal_Structure::all();

        $products_services = \App\Product::all();

        $legal_relations = $this->get_legal_relations_array($people->id);

        $share_types = \App\Type_Share::all();

        $shareholders = $this->get_shareholders_array($people->id);

        $file_types = \App\Type_File::all();

        $files = $this->get_files_array($people->id);

        $new_client = false;

        $people_persons = $legal_relation_client ? null : $this->get_persons($people->id);

    return view('people/form',compact('people','id', 'action_type', 'legal_relation_client', 'action_type_text', 'country_residence', 'country_birth', 'final_recipient_name','final_recipient_last_name', 'country_nationality', 'country_activity_financial', 'product', 'legal_structures', 'products_services', 'legal_relations', 'shareholders', 'share_types', 'file_types', 'files', 'new_client', 'pep_family_name', 'pep_family_last_name', 'people_persons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function update(Request $request)
    {   //
        $people = new \App\People;
        if($request->client_id > 0)
            $people = \App\People::find($request->client_id);
        if($request->client_relatedId != $request->client_id)
            $people->people_relatedId = $request->client_relatedId;
        $people->type_clientId = $request->client_typeId;
        if($request->action_type == 'general-info'){
             /* GENERAL */
            $people->name = $request->name;
            $people->last_name = $request->last_name;
            $people->unique_id_number = $request->unique_id;
            $people->phone_fixed = $request->phone_fixed;
            $people->passport_number = $request->passport_number;
            $people->phone_mobile = $request->phone_mobile;
            $people->email = $request->email;
            $people->genderId = $request->gender;
            $people->occupationId = $request->ocuppation;
            $people->channelId = $request->channel;
            if($request->final_recipient == '0' && $request->final_recipientId != '0'){
                $people->final_recipientId = $request->final_recipientId;
            }
            else if($request->final_recipient == '0'){
                $final_recipient = new \App\People;
                $final_recipient->name = $request->final_recipient_name;
                $final_recipient->last_name = $request->final_recipient_last_name;
                // TODO llenar campos not null de final_recipient

                $final_recipient->save();
                $people->final_recipientId = $final_recipient->id;
            }
            else if($request->final_recipient == '1'){
                $people->final_recipientId = null;
            }

            if($request->is_pep_oficial_job == '1'){
                $people->pep_oficial_job = $request->pep_oficial_job;
            }
            else{
                $people->pep_oficial_job = null;
            }
            $people->pep_family = $request->pep_family;
            if($request->is_pep_family == '1' && $request->pep_familyId != '0'){
                $people->pep_family = $request->pep_familyId;
            }
            else if($request->is_pep_family == '1'){
                $pep_family = new \App\People;
                $pep_family->name = $request->pep_family_name;
                $pep_family->last_name = $request->pep_family_last_name;
                // TODO llenar campos not null de pep_family

                $pep_family->save();
                $people->pep_family = $pep_family->id;
            }
            else if($request->is_pep_family == '0'){
                $people->pep_family = null;
            }
            $people->country_nationalityId = $request->country_nationalityId;
            if($request->client_typeId == 2){
                $people->country_birthId = 3;
                $people->country_residenceId = 3;
            }else{
                $people->country_birthId = $request->country_birthId;
                $people->country_residenceId = $request->country_residenceId;
            }
            $people->address_physical = $request->address_physical;
            $people->address_mail = $request->address_mail;
        }
        else if($request->action_type == 'finance-info'){
            /* FINANZAS */
            $people->activity_financial = $request->activity_financial;
            $people->annual_income_lower_limit = explode('-',$request->annual_income_limits)[0];
            $people->annual_income_upper_limit = explode('-',$request->annual_income_limits)[1];
            $people->country_activity_financialId = $request->country_activity_financialId;
            $people->legacy_lower_limit = explode('-', $request->legacy_limits)[0];
            $people->legacy_upper_limit = explode('-', $request->legacy_limits)[1];
            $people->productId = $request->productId;
            $people->relation_objectives = $request->relation_objectives_txt;
            $people->legal_structureId = $request->legal_structure;

        }

        $people->save();
        echo json_encode(array('status'=>'success', 'people_id'=>$people->id));
    }

    public function get_persons($id){

        $persons =  \App\People::where('people_relatedId', '=', $id)->orWhere('id', '=', $id)->get();
        return $persons;
    }

    public function get_general_info(Request $request){
        $people = \App\People::find($request->id);

        /*- sacar nombre de pais de residencia*/
        $country_residence = \App\Country::find($people->country_residenceId)->name;
        /*- sacar nombre de pais de nacimiento*/
        $country_birth = \App\Country::find($people->country_birthId)->name;
        /*- sacar nombre de pais de nacionalidad*/
        $country_nationality = \App\Country::find($people->country_nationalityId)->name;

        $final_recipient_name = null;
        $final_recipient_last_name = null;
        if($people->final_recipientId > 0){
            $final_recipient = \App\People::find($people->final_recipientId);
            $final_recipient_name = $final_recipient->name;
            $final_recipient_last_name = $final_recipient->last_name;
        }

        $pep_family_name = null;
        $pep_family_last_name = null;
        if($people->pep_family > 0){
            $pep_family = \App\People::find($people->pep_family);
            $pep_family_name = $pep_family->name;
            $pep_family_last_name = $pep_family->last_name;
        }

        echo json_encode(array('people'=>$people, 'country_residence'=>$country_residence, 'country_birth'=>$country_birth, 'country_nationality'=>$country_nationality, 'final_recipient_name' => $final_recipient_name, 'final_recipient_last_name' => $final_recipient_last_name, 'pep_family_name' => $pep_family_name, 'pep_family_last_name' => $pep_family_last_name));
    }

    public function add_shareholder(Request $request){
        $client = new \App\People;
        if($request->shareholder_client_peopleId == 0){
            // tipo de cliente "accionista" (3)
            $client->type_clientId = 3;
            $client->name = $request->shareholder_client_people_name;
            $client->last_name = $request->shareholder_client_people_name;
            $client->unique_id_number = $request->shareholder_client_people_id;
            $client->country_birthId = $request->shareholder_client_people_country_birthId;
            $client->country_nationalityId = $request->shareholder_client_people_country_nationalityId;
            $client->phone_mobile = $request->shareholder_client_people_phone_number;
            $client->email = $request->shareholder_client_people_email;
            // status "activo" (1)
            $client->status_id = 1;
            $client->save();
        }
        else{
            $client = \App\People::find($request->shareholder_client_peopleId);
        }

        $relation_client_shareholder = new \App\Relation_People_Shareholder;
        $relation_client_shareholder->client_legalId = $request->relation_legalId;
        $relation_client_shareholder->client_relatedId = $client->id;
        $relation_client_shareholder->types_shareId = $request->shareholder_client_people_action_typeId;
        $relation_client_shareholder->certification_number = $request->shareholder_client_people_certification_number;
        $relation_client_shareholder->percentage = $request->shareholder_client_people_percentage;
        $relation_client_shareholder->save();

        echo $this->get_shareholders_rows($request->relation_legalId)[0];
    }

    public function delete_shareholder(Request $request){
        $shareholder = \App\Relation_People_Shareholder::find($request->id);
        $shareholder->status = 0;
        $shareholder->save();
        echo $this->get_shareholders_rows($request->relation_legalId)[0];
    }

    public function get_shareholders_array($id){
        $shareholders = DB::table('relation_client_shareholders')
                        ->join('people', 'relation_client_shareholders.client_relatedId', '=', 'people.id')
                        ->join('types_share', 'relation_client_shareholders.types_shareId', '=', 'types_share.id')
                        ->join('countries as countries_birth', 'people.country_birthId', '=', 'countries_birth.id')
                        ->join('countries as countries_nationality', 'people.country_birthId', '=', 'countries_nationality.id')
                        ->select(DB::raw('relation_client_shareholders.id as cert_id, relation_client_shareholders.certification_number as cert_number, people.id as people_id, people.name as people_name, people.last_name as people_last_name, types_share.id as type_id, types_share.name as type_name, people.unique_id_number as people_id, people.country_birthId as people_country_birthId, countries_birth.name as people_country_birth_name, people.country_nationalityId as people_country_nationalityId, countries_nationality.name as people_country_nationality_name, people.phone_mobile as people_phone_mobile, people.email as people_email, relation_client_shareholders.percentage as share_percentage'))
                        ->where('relation_client_shareholders.client_legalId', '=', $id)
                        ->where('relation_client_shareholders.status', '=', '1')
                        ->get();
        return $shareholders;
    }

    public function get_shareholders_rows($id){
        $shareholders = $this->get_shareholders_array($id);
        $output = '';
        $total = 0;
        $result = array();
        foreach ($shareholders as $item) {
            $output .= '<tr class="shareholder_row_container"><td>'. $item->cert_number . '</td><td>' . $item->type_name . '</td><td>' . $item->people_name . ' ' . $item->people_last_name . '</td><td>' . $item->people_id . '</td><td>' . $item->people_country_birth_name . '</td><td>' . $item->people_country_nationality_name . '</td><td>' . $item->people_phone_mobile . '</td><td>' . $item->people_email . '</td><td class="share_percentage">' . $item->share_percentage . '</td><td><button type="button" class="btn btn-danger shareholder-delete" data-id="' . $item->cert_id . '">Borrar</button></td></tr>';
            $total += $item->share_percentage;
        }
        $result[] = $output;
        $result[] = $total;
        return $result;
    }

    public function get_legal_relations_array($id){
        $legal_relations =  DB::table('relation_client_legal')
                        ->leftJoin("people", 'relation_client_legal.resident_agent_id', '=', 'people.id')
                        ->select(DB::raw('relation_client_legal.id as id, relation_client_legal.legal_person_name as legal_person_name, relation_client_legal.ruc as ruc, relation_client_legal.resident_agent_id as resident_agent_id, people.name as people_name, people.last_name as people_last_name'))
                        ->where('relation_client_legal.clientId', '=', $id)->where('relation_client_legal.status', '=', '1')
                        ->get();
        return $legal_relations;
    }

    public function get_legal_relations_rows($id){
        $legal_relations = $this->get_legal_relations_array($id);
        $output = '';
        foreach ($legal_relations as $item) {
            $output .= '<tr><td>' . $item->legal_person_name . '</td><td>' . $item->ruc . '</td><td>' .
                        '<a href="#" class="btn btn-warning legal_relation_edit" data-id="' . $item->id . '">Editar</a>' .
                        '</td><td><a href="#" class="btn btn-danger legal_relation_delete" data-id="' . $item->id . '">Borrar</a>' .
                        '</td></tr>';
        }
        return $output;
    }

    public function add_legal_relation(Request $request){
        $legal_relation = new \App\Relation_People_Legal;
        if($request->legal_relation_id != '0'){
            $legal_relation = \App\Relation_People_Legal::find($request->legal_relation_id);
        }
        $legal_relation->status = 1;
        $legal_relation->clientID = $request->client_id;
        $legal_relation->legal_person_name = $request->name;
        $legal_relation->ruc = $request->ruc;
        if($request->is_agent_resident == '0'){
            if($request->agent_resident_id != '0'){
                $legal_relation->resident_agent_id = $request->agent_resident_id;
            }
            else{
                $legal_resident_agent = new \App\People;
                $legal_resident_agent->name = $request->agent_resident_name;
                $legal_resident_agent->last_name = $request->agent_resident_name;
                $legal_resident_agent->type_clientId = 4;
                $legal_resident_agent->save();
                $legal_relation->resident_agent_id = $legal_resident_agent->id;
            }
        }
        // si es una actualizacion y ya tiene asignado un agente residente, actualizarlo
        else if($request->legal_relation_id != '0'){
            $legal_relation->resident_agent_id = null;
        }
        $legal_relation->types_relationId = 1;
        $legal_relation->save();

        $board_index = 0;
        $result = '';
        $board_relations_ids = [];
        $actions = '';
        foreach ($request->board_people_ids as $key => $value) {
            $board_member = \App\Relation_People_Board::where('id','=',$request->board_relations_ids['board_relations_ids'.$board_index])->first();
            $result .= $legal_relation->id . '-' . $request->board_types['board_types'.$board_index] . '-' . $value . ',';
            if($request->board_people_status['board_people_status'.$board_index] != 'delete'){
                if($board_member == null){
                    $board_member = new \App\Relation_People_Board;
                    $actions .= 'new ';
                }
                else{
                    $actions .= 'edit ';                    
                }
                $board_member->client_typeId = $request->board_people_types['board_people_type'.$board_index];
                $board_member->client_legalId = $legal_relation->id;
                $board_member->types_boardId = $request->board_types['board_types'.$board_index];

                $board_people = new \App\People;
                if($value != '0'){
                    $board_member->client_relatedId = $value;
                    $board_people = \App\People::find($value);
                }
                $board_people->name = $request->board_names['board_names'.$board_index];
                if($board_member->client_typeId == 1){
                    $board_people->last_name = $request->board_last_names['board_last_names'.$board_index];
                }
                $board_people->unique_id_number = $request->board_ids['board_ids'.$board_index];
                $board_people->type_clientId = 5;
                $board_people->save();
                $board_member->client_relatedId = $board_people->id;
                $board_member->save();                
                array_push($board_relations_ids, $board_member->id);
            }
            else if($board_member != null){
                if($value != '0'){
                    $actions .= 'delete ';
                    array_push($board_relations_ids, $board_member->id);
                    \App\Relation_People_Board::destroy($board_member->id);
                }
            }
            $board_index++;
        }

        $legal_relations = $this->get_legal_relations_rows($request->client_id);
        echo json_encode(array('status'=>'success','legal_relation_id'=>$legal_relation->id,'result'=>$result, 'board_relations_ids'=>$board_relations_ids, 'actions' => $actions));
    }

    public function edit_legal_relation(Request $request){
        $legal_relation = DB::table('relation_client_legal')
                        ->leftJoin("people", 'relation_client_legal.resident_agent_id', '=', 'people.id')
                        ->select(DB::raw('relation_client_legal.id as id, relation_client_legal.legal_person_name as legal_person_name, relation_client_legal.ruc as ruc, relation_client_legal.resident_agent_id as resident_agent_id, people.name as resident_agent_name, people.last_name as resident_agent_last_name'))
                        ->where('relation_client_legal.id', '=', $request->id)
                        ->first();
        $boards = $this->get_boards_rows($legal_relation->id);
        $shareholders = $this->get_shareholders_rows($legal_relation->id);
        return json_encode(array('legal_relation' => $legal_relation, 'boards' => $boards, 'shareholders' => $shareholders[0], 'total_shareholders_percetage' => $shareholders[1]));
    }

    public function delete_legal_relation(Request $request){
        $legal_relation = \App\Relation_People_Legal::find($request->id);
        $legal_relation->status = 2;
        $legal_relation->save();

        return $this->get_legal_relations_rows($request->client_id);
    }

    public function get_boards_array($id){
        $boards = DB::table('relation_client_board')
                        ->join('people', 'relation_client_board.client_relatedId', '=', 'people.id')
                        ->join('types_board', 'relation_client_board.types_boardId', '=', 'types_board.id')
                        ->select(DB::raw('people.id as people_id, people.name as people_name, people.last_name as people_last_name, people.unique_id_number as people_unique_id, types_board.name as type_name, people.type_clientId as people_type_id, types_board.id as type_id, relation_client_board.client_typeId as relation_client_type_id, relation_client_board.id as relation_board_id'))
                        ->where('relation_client_board.client_legalId', '=', $id)
                        ->orderBy('types_board.name', 'asc')
                        ->get();
        return $boards;
    }

    public function get_boards_rows($id){
        $boards_array = $this->get_boards_array($id);

        $output = '';
        $boardIndex = 0;
        foreach ($boards_array as $item) {
            $output .= '
                  <tr>
                    <td>
                        <select data-index="' . $boardIndex . '" class="form-control" id="board_people_type_' . $boardIndex . '" name="board_people_types" required title="Escoja un tipo" onchange="board_people_type_change(this)">
                            <option value="1" ' . ($item->relation_client_type_id == 1 ? 'selected="selected"' : '') . '>Per. Natural</option>
                            <option value="2" ' . ($item->relation_client_type_id == 2 ? 'selected="selected"' : '') . '>Per. Jurídica</option>
                        </select>
                    </td>
                    <td>
                      <input type="hidden" value="edit" id="board_people_status_' . $boardIndex . '" name="board_people_status">
                      <input type="hidden" value="' . $item->relation_board_id . '" id="board_relation_' . $boardIndex . '" name="board_relations_ids">
                      <input type="hidden" value="' . $item->people_id . '" id="board_people_' . $boardIndex . '" name="board_people_ids">
                      <input type="text" class="form-control ac-control" name="board_name" id="board_name_' . $boardIndex . '" value="' . $item->people_name . '" ac-method="clients" required title="Inserte el nombre" onkeyup="ac_control(this)">
                      <div class="ac-container"></div>
                    </td>
                    <td>' .
                    ($item->relation_client_type_id == '1' ?
                        '<input type="text" class="form-control ac-control" name="board_last_names" value="' . $item->people_last_name . '" ac-method="clients" ac-master-field="board_people_' . $boardIndex . '" ac-master-data="data-item2" required title="Inserte el apellido" onkeyup="ac_control(this)">
                        <div class="ac-container"></div>' :
                        '&nbsp;') .
                    '</td>
                    <td>
                      <input type="text" ac-master-field="board_people_' . $boardIndex . '" ac-master-data="data-unique-id" class="form-control ac-control" name="board_ids" ac-method="clients" value="' . $item->people_unique_id . '" required title="Inserte el ID del director" onkeyup="ac_control(this)">
                      <div class="ac-container"></div>
                    </td>
                    <td style="text-align: right;">
                      <select class="form-control" name="board_types">
                        <option value="1" ' . ($item->type_id == 1 ? 'selected="selected"' : '') . '>Director</option>
                        <option value="2" ' . ($item->type_id == 2 ? 'selected="selected"' : '') . '>Secretario</option>
                        <option value="3" ' . ($item->type_id == 3 ? 'selected="selected"' : '') . '>Tesorero</option>
                        <option value="4" ' . ($item->type_id == 4 ? 'selected="selected"' : '') . '>Presidente</option>
                        <option value="5" ' . ($item->type_id == 5 ? 'selected="selected"' : '') . '>Vicepresidente</option>
                        <option value="6" ' . ($item->type_id == 6 ? 'selected="selected"' : '') . '>Vocal</option>
                        <option value="7" ' . ($item->type_id == 7 ? 'selected="selected"' : '') . '>Otro</option>
                      </select>
                    </td>
                    <td>
                      <button type="button" id="legal_relation_delete" class="btn btn-sm btn-link"><i class="fa fa-times"></i></button>
                    </td>
                  </tr>';
            $boardIndex++;
        }
        return $output;
    }

    public function add_file(Request $request){
        $file = new \App\Relation_People_File;
        $file->clientId = $request->client_id;
        $file->file_typeId = $request->file_item_type;
        $file->file_name = $request->file_name;
        $file->file_description = $request->file_description;
        $file->status = 1;

        $file->save();
        echo $this->get_files_rows($request->client_id);
    }

    public function delete_file(Request $request){
        $file = \App\Relation_People_File::find($request->id);
        $file->status = 0;
        $file->save();

        echo $this->get_files_rows($request->client_id);
    }

    public function get_files_array($id){
        $files = DB::table('relation_client_files')
                        ->join('types_file', 'relation_client_files.file_typeId', '=', 'types_file.id')
                        ->select(DB::raw('relation_client_files.id as file_id, relation_client_files.file_name as client_file_name, relation_client_files.file_typeId as client_file_typeId, types_file.name as file_type_name'))
                        ->where('relation_client_files.clientId', '=', $id)
                        ->where('relation_client_files.status', '=', '1')
                        ->get();
        return $files;
    }

    public function get_files_rows($id){
        $files = $this->get_files_array($id);
        $output = '';
        foreach ($files as $row) {
            $output .= '<tr><td>'.$row->client_file_name.'</td><td>'.$row->file_type_name.'</td><td><button type="button" class="btn btn-danger" data-id="'. $row->file_id . '">Borrar</button></td></tr>';
        }
        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $people = \App\People::find($id);
        $people->status_id = 2;
        $people->save();
        return json_encode(array('status'=>'success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the request...

        $people = new People;

        $people->name = $request->name;

        $people->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        /*$people = \App\People::find($id);
        return view('people.show', array('people' => $people));*/
        if($id == 'all')
            $people = \App\People::where('status_id', '=', '1')->where(function($query){
                $query->where('type_clientId','=', 1)->orWhere('type_clientId','=', 2);
            })->get();
        else
            $people = \App\People::where('status_id', '=', '1')->where('type_clientId','=',$id == 'natural' ? 1 : 2)->get();

        $clients = $this->get_people_rows($people);

        return view('people/index',compact('people','id', 'clients'));
    }

    public function get_people_rows($people){
        $clients = '';
        foreach ($people as $item) {
            $clients .= $this->get_people_table_row($item);
        }
        return $clients;
    }

    public function get_people_table_row($item){
        return '<tr class="client-item hand" edit-url="/people/'.$item->id.'/edit">
                <td>'.$item->name.' '.$item->last_name.'</td>
                <td>'.$item->email.'</td>
                <td>'.($item->type_clientId == 1 ? 'Persona Natural' : 'Persona Juridica').'</td>
                <td>
                  <div class="row">
                      <div class="col-xl-6 text-xs-center">
                        <a class="btn btn-danger delete-client" data-id="'.$item->id.'"><i class="fa fa-times"></i></a>
                      </div>
                  </div>
                  <!-- /.row -->
                </td>
            </tr>';
    }

    public function search(Request $request){
        $people = \App\People::where('status_id', '=', '1')->where(function($query) use ($request){
                if($request->list_type == 'all')
                    $query->where('type_clientId','=', 1)->orWhere('type_clientId','=', 2);
                else if($request->list_type == 'natural')
                    $query->where('type_clientId','=', 1);
                else
                    $query->where('type_clientId','=', 2);
            })->where(function($query) use ($request){
                $query->where('name', 'LIKE', '%'.$request->q.'%')->orWhere('last_name', 'LIKE', '%'.$request->q.'%')->orWhere('email', 'LIKE', '%'.$request->q.'%');
            })->get();
        if($request->is_autocomplete == 'true'){
            return response()->json($people);
        }
        return json_encode(array('people'=>$this->get_people_rows($people),'count'=>count($people)));
    }

    public function search_one(Request $request){
        $people = \App\People::find($request->id);
        return json_encode(array('people'=>$this->get_people_table_row($people), 'count'=> 1));
    }

    public function pdf_format($id){
        $people = \App\People::find($id);
        $country = \App\Country::find($people->country_nationalityId);

        $data = [
            'name' => $people->name . ' ' . $people->last_name, 
            'type' => $this->choose_title($people->type_clientId),
            'phisicalAddress' => $people->address_physical,
            'nationallity' => $country->name,
            'email' => $people->email,
            'phone' => $people->phone_mobile,
            'legal_relations' => 'legal relations',
            'lawFirmContacts' => 'Contactos de LawFirm'
        ];
        $pdf = PDF::loadView('people/pdf_people', $data);
  
        return $pdf->download('file.pdf');
        //return view('people/pdf_people', $data);
    }
}