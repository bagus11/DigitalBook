<?php

namespace App\Http\Controllers;

use App\Models\MasterDivision;
use App\Models\MasterTitle;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function index(){
        return view('client.client-index');
    }
    function getDitialBookClient(Request $request) {
        $data =MasterDivision::with([
            'digitalRelation',
            'departementRelation',
            'departementRelation.digitalRelation',
            'digitalRelation.detailRelation',
            'departementRelation.digitalRelation.detailRelation'
        ])->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
}
