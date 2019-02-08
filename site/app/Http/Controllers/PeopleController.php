<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $people=\App\people::all();

        return view('people/index',compact('people'));
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
        //
        $people = \App\people::find($id);
        $name = $people->name;
        $last_name = $people->last_name;
        $action_type = 'edit';
        $action_type_text = "Editar";
        return view('people/form',compact('people','id', 'name', 'last_name', 'action_type', 'action_type_text'));
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
        $people = \App\people::find($id);

        $people->name = $request->name;

        $people->save();
        return redirect('people');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $action_type = 'edit';
        $action_type_text = "Agreagar";
        $name = '';
        $last_name = '';
        $id = 0;
        $people = new People;
        return view('people/form',compact('people', 'action_type', 'name', 'last_name', 'action_type_text', 'id'));
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
        $people = \App\people::find($id);
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