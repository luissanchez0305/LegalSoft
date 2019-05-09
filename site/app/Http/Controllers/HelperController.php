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
            $data = \App\Country::where('name', 'LIKE', '%'.$query.'%')->where('isDummy', '=', '1')->orderBy('name', 'asc')->take(5)->get();
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
                                ->orWhere('unique_id_number', 'LIKE', '%'.$query.'%')
                                ->orWhere('ruc', 'LIKE', '%'.$query.'%')
                                ->take(5)
                                ->get();
            $output = '<li><a class="ac-item new">Nuevo Cliente</a></li>';
            foreach ($data as $row) {
                $output .= '<li><a class="ac-item" data-val="'.$row->id.'" data-unique-id="'.$row->unique_id_number.'" data-ruc="'.$row->ruc.'" data-item1="'.$row->name.'" data-item2="'.$row->last_name.'">' . ($row->name != $row->last_name ? $row->name . ' ' . $row->last_name : $row->name) . '</a></li>';
            }
            echo $output;
        }
    }
    public function autocomplete_products(Request $request){
        if($request->get('q')){
            $query = $request->get('q');
            $data = \App\Product::where('name', 'LIKE', '%'.$query.'%')->take(5)->get();

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
            $data = \App\Type_Share::where('name', 'LIKE', '%'.$query.'%')->take(5)->get();

            $output = '';
            foreach ($data as $row) {
                $output .= '<li><a class="ac-item" data-val="'.$row->id.'">' . $row->name . $row->last_name . '</a></li>';
            }
            echo $output;
        }
    }

    public function autocomplete_oficial_jobs(Request $request){
        if($request->get('q')){
            $query = $request->get('q');
            $data = \App\People::where('pep_oficial_job', 'LIKE', '%'.$query.'%')->take(5)->get();
            $output = '';
            foreach ($data as $row) {
                $output .= '<li><a class="ac-item" data-val="'.$row->pep_oficial_job.'">' . $row->pep_oficial_job . '</a></li>';
            }
            echo $output;
        }
    }
}