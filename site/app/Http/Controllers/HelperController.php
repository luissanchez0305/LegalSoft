<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class HelperController extends Controller
{
    public function autocomplete_countries(Request $request)
    {
        if($request->get('q'))
        {
            $query = $request->get('q');
            $data = \App\Country::where('name', 'LIKE', '%'.$query.'%')->where('isDummy', '=', '1')->orderBy('name', 'asc')->get();
            $output = '';
            foreach ($data as $row) {$output .= '<li><a class="ac-item" data-val="'.$row->id.'">'.$row->name.'</a></li>';
            }
            echo $output;
        }
    }
    public function autocomplete_clients(Request $request)
    {
        if($request->get('q'))
        {
            $query = $request->get('q');
            $data = \App\People::where('name', 'LIKE', '%'.$query.'%')
                                ->orWhere('last_name', 'LIKE', '%'.$query.'%')
                                ->get();
            $output = '';
            foreach ($data as $row) {
                $output .= '<li><a class="ac-item" data-val="'.$row->id.'" data-ruc="'.$row->ruc.'" data-item1="'.$row->name.'" data-item2="'.$row->last_name.'">' . $row->name . ' ' . $row->last_name . '</a></li>';
            }
            echo $output;
        }
    }
    public function autocomplete_products(Request $request){
        if($request->get('q')){
            $query = $request->get('q');
            $data = \App\Product::where('name', 'LIKE', '%'.$query.'%')->get();

            $output = '';
            foreach ($data as $row) {
                $output .= '<li><a class="ac-item" data-val="'.$row->id.'">' . $row->name . $row->last_name . '</a></li>';
            }
            echo $output;
        }
    }

    public function autocomplete_types_share(Request $request){
        if($request->get('q')){
            $query = $request->get('q');
            $data = \App\Type_Share::where('name', 'LIKE', '%'.$query.'%')->get();

            $output = '';
            foreach ($data as $row) {
                $output .= '<li><a class="ac-item" data-val="'.$row->id.'">' . $row->name . $row->last_name . '</a></li>';
            }
            echo $output;
        }
    }
}