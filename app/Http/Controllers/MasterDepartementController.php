<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\StoreMasterDepartmentRequest;
use App\Http\Requests\UpdateMasterDepartementRequest;
use App\Models\MasterDepartement;
use App\Models\MasterDivision;
use Illuminate\Http\Request;

class MasterDepartementController extends Controller
{
    function index(){
        return view('masterDepartement.masterDepartement-index');
    }
    function getMasterDepartement() {
        $data = MasterDepartement::with('divisionRelation')->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function detailMasterDepartement(Request $request) {
        $detail = MasterDepartement::with('divisionRelation')->find($request->id);
        return response()->json([
            'detail'=>$detail,
        ]);  
    }
    function DepartementByDiv(Request $request) {
        $data = MasterDepartement::where('division_id',$request->id)->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function addMasterDepartement(Request $request, StoreMasterDepartmentRequest $storeMasterDepartmentRequest){
        try {
            $storeMasterDepartmentRequest->validated();
            MasterDepartement::create([
                'name'          =>$request->departementName,
                'initial'          =>$request->departementInitial,
                'division_id'   =>$request->divisionId,
                'flg_aktif'     =>1
            ]);
            return ResponseFormatter::success(                                
                $storeMasterDepartmentRequest,
                'Departement successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Departement failed to update',
                500
            );
        }
    }
    function updateMasterDepartement(Request $request, UpdateMasterDepartementRequest $updateMasterDepartementRequest){
        try {
            $updateMasterDepartementRequest->validated();
            MasterDepartement::find($request->id)->update([
                'name'=>$request->departementNameEdit,
                'initial'=>$request->departementInitialEdit,
                'division_id'=>$request->divisionEditId,
            ]);
            return ResponseFormatter::success(                                
                $updateMasterDepartementRequest,
                'Departement successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Departement failed to update',
                500
            );
        }
    }
    function updateStatusMasterDepartement(Request $request) {
        $status =500;
        $message ="Data failed to update";
        $id = MasterDepartement::find($request->id);
        $update = MasterDepartement::find($request->id)->update([
            'flg_aktif'=>$id->flg_aktif == 1? 0:1
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
