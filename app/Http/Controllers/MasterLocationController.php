<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\MasterDistrict;
use App\Models\MasterLocation;
use App\Models\MasterProvince;
use App\Models\MasterRegion;
use App\Models\MasterVillage;
use Illuminate\Http\Request;

class MasterLocationController extends Controller
{
    function index(){
        return view('masterLocation.masterLocation-index');
    }
    function getMasterLocation() {
        $data = MasterLocation::with([
                                        'provinceRelation',
                                        'regionRelation',
                                        'districtRelation',
                                        'villageRelation',
                                    ])->select('*')
                                    ->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function detailMasterLocation(Request $request){
        $detail = MasterLocation::with([
                                        'provinceRelation',
                                        'regionRelation',
                                        'districtRelation',
                                        'villageRelation',
                                        ])->find($request->id);
        return response()->json([
            'detail'=>$detail,
        ]);  
    }
    function getProvince(){
        $data = MasterProvince::all();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function getRegion(Request $request){
        $data = MasterRegion::where('provinsi_id','like','%'.$request->id.'%')->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function getDistrict(Request $request){
        $data = MasterDistrict::where('kabkot_id','like','%'.$request->id.'%')->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function getVillage(Request $request){
        $data = MasterVillage::where('kecamatan_id','like','%'.$request->id.'%')->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function getPostalCode(Request $request){
        $detail = MasterVillage::find($request->id);
        return response()->json([
            'detail'=>$detail,
        ]);  
    }
    function updateMasterLocation(Request $request, UpdateLocationRequest $updateLocationRequest) {
        try {
            $updateLocationRequest->validated();
            $regionName        =MasterRegion::find($request->regionId);
            $post =[
                'name'         =>$request->locationName,
                'address'      =>$request->locationAddress,
                'id_prov'      =>$request->provinceId,
                'id_city'      =>$request->regionId,
                'id_district'  =>$request->districtId,
                'id_village'   =>$request->villageId,
                'postal_code'  =>$request->locationPostalCode,
                'office_type'  =>$request->locationTypeId,
                'city'         =>$regionName->name
            ];
            MasterLocation::find($request->id)->update($post);
            return ResponseFormatter::success(   
                  $post,                          
                'Location successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Location failed to add',
                500
            );
        }
    }
}
