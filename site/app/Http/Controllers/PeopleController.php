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
        $action_type_text = "Agregar";
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
        $people = new \App\People;
        return view('people/form',compact('people', 'action_type', 'action_type_text', 'id', 'country_residence', 'country_birth',
            'final_recipient', 'country_nationality', 'country_activity_financial', 'product', 'legal_relation'));
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
        $action_type_text = "Editar";
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
        return view('people/form',compact('people','id', 'action_type', 'action_type_text', 'country_residence', 'country_birth',
            'final_recipient', 'country_nationality', 'country_activity_financial', 'product', 'legal_relation'));
        //return view('people/edit', array('people' => $people));
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