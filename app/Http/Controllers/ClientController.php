<?php

namespace App\Http\Controllers;

use App\Models\MasterDivision;
use App\Models\MasterTitle;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function index(){
        $data =MasterDivision::with([
            'digitalRelation',
            'departementRelation',
            'departementRelation.digitalRelation',
            'digitalRelation.detailRelation',
            'departementRelation.digitalRelation.detailRelation'
        ])->get();
        $getData=[
            'data'=>$data  
        ];
        return view('client.client-index', $getData);
    }  
}
