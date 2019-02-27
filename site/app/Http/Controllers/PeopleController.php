<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PeopleController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $people=\App\People::all();

        return view('people/index',compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $action_type = 'add';
        $action_type_text = "Agregar Nuevo";
        $id = 0;
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
        $legal_relation = null;
        $board = null;
        $shareholders = null;
        $people = new \App\People;
        return view('people/form',compact('people', 'action_type', 'action_type_text', 'id', 'country_residence', 'country_birth',
            'final_recipient', 'country_nationality', 'country_activity_financial', 'product', 'legal_relation','board', 'shareholders',
            'share_types', 'file_types', 'files'));
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
        //
        $people = \App\People::find($id);
        $action_type = 'edit';
        $action_type_text = "Guardar Cambios";
        /*- sacar nombre de pais de residencia*/
        $country_residence = \App\Country::find($people->country_residenceId)->name;
        /*- sacar nombre de pais de nacimiento*/
        $country_birth = \App\Country::find($people->country_birthId)->name;
        /*- sacar nombre de pais de nacionalidad*/
        $country_nationality = \App\Country::find($people->country_nationalityId)->name;

        $final_recipient = \App\People::find($people->final_recipientId);
        if($final_recipient)
            $final_recipient = $final_recipient->name . ' ' . $final_recipient->last_name;
        else
            $final_recipient = null;

        $country_activity_financial = \App\Country::find($people->country_activity_financialId)->name;

        $product = \App\Product::find($people->productId)->name;

        $legal_relation = DB::table('relation_client_legal')
                        ->join('people', 'relation_client_legal.client_relatedId', '=', 'people.id')
                        ->select('people.*')
                        ->where('relation_client_legal.clientId', '=', $people->id)
                        ->first();

        $board = DB::table('relation_client_board')
                        ->join('people', 'relation_client_board.client_relatedId', '=', 'people.id')
                        ->join('types_board', 'relation_client_board.types_boardId', '=', 'types_board.id')
                        ->select(DB::raw('people.id as people_id, people.name as people_name, people.last_name as people_last_name, types_board.name as type_name'))
                        ->where('relation_client_board.clientId', '=', $people->id)
                        ->orderBy('types_board.name', 'asc')
                        ->get();

        $share_types = \App\Type_Share::all();

        $shareholders = $this->get_shareholders_array($people->id);

        $file_types = \App\Type_File::all();

        $files = $this->get_files_array($people->id);

        return view('people/form',compact('people','id', 'action_type', 'action_type_text', 'country_residence', 'country_birth',
            'final_recipient', 'country_nationality', 'country_activity_financial', 'product', 'legal_relation','board', 'shareholders',
            'share_types', 'file_types', 'files'));
    }

    public function add_shareholder(Request $request){
        $client = new \App\People;
        if($request->shareholder_client_peopleId == 0){
            // tipo de cliente "accionista" (3)
            $client->type_clientId = 3;
            $client->name = $request->shareholder_client_people_name;
            $client->last_name = $request->shareholder_client_people_name;
            $client->unique_id_number = $request->shareholder_client_people_ruc;
            $client->ruc = $request->shareholder_client_people_ruc;
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
        $relation_client_shareholder->clientId = $request->shareholder_clientId;
        $relation_client_shareholder->client_relatedId = $client->id;
        $relation_client_shareholder->types_shareId = $request->shareholder_client_people_action_typeId;
        $relation_client_shareholder->certification_number = $request->shareholder_client_people_certification_number;
        $relation_client_shareholder->percentage = $request->shareholder_client_people_percentage;
        $relation_client_shareholder->save();

        echo $this->get_shareholders_rows($request->shareholder_clientId);
    }

    public function delete_shareholder(Request $request){
        $shareholder = \App\Relation_People_Shareholder::find($request->id);
        $shareholder->status = 0;
        $shareholder->save();
        echo $this->get_shareholders_rows($request->client_id);
    }

    public function get_shareholders_array($id){
        $shareholders = DB::table('relation_client_shareholders')
                        ->join('people', 'relation_client_shareholders.client_relatedId', '=', 'people.id')
                        ->join('types_share', 'relation_client_shareholders.types_shareId', '=', 'types_share.id')
                        ->join('countries as countries_birth', 'people.country_birthId', '=', 'countries_birth.id')
                        ->join('countries as countries_nationality', 'people.country_birthId', '=', 'countries_nationality.id')
                        ->select(DB::raw('relation_client_shareholders.id as cert_id, relation_client_shareholders.certification_number as cert_number, people.id as people_id, people.name as people_name, people.last_name as people_last_name, types_share.id as type_id, types_share.name as type_name, people.ruc as people_ruc, people.country_birthId as people_country_birthId, countries_birth.name as people_country_birth_name, people.country_nationalityId as people_country_nationalityId, countries_nationality.name as people_country_nationality_name, people.phone_mobile as people_phone_mobile, people.email as people_email, relation_client_shareholders.percentage as share_percentage'))
                        ->where('relation_client_shareholders.clientId', '=', $id)
                        ->where('relation_client_shareholders.status', '=', '1')
                        ->get();
        return $shareholders;
    }

    public function get_shareholders_rows($id){
        $shareholders = $this->get_shareholders_array($id);
        $output = '';
        foreach ($shareholders as $item) {
            $output .= '<tr class="shareholder_row_container"><td>'. $item->cert_number . '</td><td>' . $item->type_name . '</td><td>' . $item->people_name . ' ' . $item->people_last_name . '</td><td>' . $item->people_ruc . '</td><td>' . $item->people_country_birth_name . '</td><td>' . $item->people_country_nationality_name . '</td><td>' . $item->people_phone_mobile . '</td><td>' . $item->people_email . '</td><td>' . $item->share_percentage . '</td><td><button type="button" class="btn btn-danger shareholder-delete" data-id="' . $item->cert_id . '">Borrar</button></td></tr>';
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
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {            //
        $people = \App\People::find($id);

        $people->name = $request->name;

        $people->save();
        return redirect('people');
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
        return redirect('people');
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
        $people = People::find($id);
        return view('people.show', array('people' => $people));
    }
}