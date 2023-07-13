<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\StoreMasterIsoRequest;
use App\Http\Requests\UpdateMasterIsoRequest;
use App\Models\MasterISO;
use Illuminate\Http\Request;

class MasterISOController extends Controller
{
    function index() {
        return view('masterIso.masterIso-index');
    }
    function getMasterIso() {
        $data = MasterISO::all();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function addIso(Request $request, StoreMasterIsoRequest $storeMasterIsoRequest) {
        try {
            $storeMasterIsoRequest->validated();
            MasterISO::create([
                'name'          =>$request->isoName,
                'description'   =>$request->isoDescription,
                'flg_active'   =>1,
            ]);
            return ResponseFormatter::success(                                
                $storeMasterIsoRequest,
                'ISO successfully added'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'ISO failed to add',
                500
            );
        }
    }
    function detailMasterIso(Request $request) {
        $detail = MasterISO::find($request->id);
        return response()->json([
            'detail'=>$detail,
        ]);  
    }
    function updateIso(Request $request, UpdateMasterIsoRequest $updateMasterIsoRequest){
        try {
            $updateMasterIsoRequest->validated();
            MasterISO::find($request->id)->update([
                'name'          =>$request->isoNameEdit,
                'description'   =>$request->isoDescriptionEdit,
            ]);
            return ResponseFormatter::success(                                
                $updateMasterIsoRequest,
                'ISO successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'ISO failed to update',
                500
            );
        }
    }
    function updateStatusIso(Request $request) {
        $status =500;
        $message ="Data failed to update";
        $id = MasterISO::find($request->id);
        $update = MasterISO::find($request->id)->update([
            'flg_active'=>$id->flg_active == 1? 0:1
        ]);
        if($update){
            $status = 200;
            $message ="Data successfully updated";
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);   
    }
}
