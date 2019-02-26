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

        $shareholders = DB::table('relation_client_shareholders')
                        ->join('people', 'relation_client_shareholders.client_relatedId', '=', 'people.id')
                        ->join('types_share', 'relation_client_shareholders.types_shareId', '=', 'types_share.id')
                        ->join('countries as countries_birth', 'people.country_birthId', '=', 'countries_birth.id')
                        ->join('countries as countries_nationality', 'people.country_birthId', '=', 'countries_nationality.id')
                        ->select(DB::raw('relation_client_shareholders.id as cert_id, relation_client_shareholders.certification_number as cert_number, people.id as people_id, people.name as people_name, people.last_name as people_last_name, types_share.id as type_id, types_share.name as type_name, people.ruc as people_ruc, people.country_birthId as people_country_birthId, countries_birth.name as people_country_birth_name, people.country_nationalityId as people_country_nationalityId, countries_nationality.name as people_country_nationality_name, people.phone_fixed as people_phone_fixed, people.phone_mobile as people_phone_mobile, people.email as people_email, relation_client_shareholders.percentage as share_percentage'))
                        ->where('relation_client_shareholders.clientId', '=', $people->id)
                        ->get();

        $file_types = \App\Type_File::all();

        $files = DB::table('relation_client_files')
                        ->join('types_file', 'relation_client_files.file_typeId', '=', 'types_file.id')
                        ->select(DB::raw('relation_client_files.id as file_id, relation_client_files.file_name as client_file_name, relation_client_files.file_typeId as client_file_typeId, types_file.name as file_type_name'))
                        ->where('relation_client_files.clientId', '=', $people->id)
                        ->get();

        return view('people/form',compact('people','id', 'action_type', 'action_type_text', 'country_residence', 'country_birth',
            'final_recipient', 'country_nationality', 'country_activity_financial', 'product', 'legal_relation','board', 'shareholders',
            'share_types', 'file_types', 'files'));
    }

    public function add_file(Request $request){
        $file = new \App\Relation_People_File;
        $file->clientId = $request->client_id;
        $file->file_typeId = $request->file_item_type;
        $file->file_name = $request->file_name;
        $file->file_description = $request->file_description;

        $file->save();

        $files = DB::table('relation_client_files')
                        ->join('types_file', 'relation_client_files.file_typeId', '=', 'types_file.id')
                        ->select(DB::raw('relation_client_files.id as file_id, relation_client_files.file_name as client_file_name, relation_client_files.file_typeId as client_file_typeId, types_file.name as file_type_name'))
                        ->where('relation_client_files.clientId', '=', $request->client_id)
                        ->get();
        //\App\Relation_People_File::where('clientId', '=', $request->client_id)->get();

        $output = '';
        foreach ($files as $row) {
            $output .= '<tr><td>'.$row->client_file_name.'</td><td>'.$row->file_type_name.'</td><td><button type="button" class="btn btn-danger" data-id="'. $row->file_id . '">Borrar</button></td></tr>';
        }
        echo $output;
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