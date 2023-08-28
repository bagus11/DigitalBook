<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\AddHSEPageRequest;
use App\Models\ClientMenus;
use App\Models\MasterHSEPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterHSEPageController extends Controller
{
    function index() {
        return view('masterHSE.masterHSE-index');
    }
    function getMasterHSE(){
        $data =ClientMenus::where('type', 3)->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function getClientSubmenus(Request $request){
        $idMenus = ClientMenus::where('name',$request->menus)->first();
        $data = ClientMenus::where('parentSubmenus',$idMenus->id)
                ->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function getClientMenus(Request $request){
        $data = MasterHSEPage::with(['pageRelation','submenusRelation'])->where('pageId',$request->id)->first();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function addHSEPage(Request $request, AddHSEPageRequest $addHSEPageRequest){
        // try {    
            $addHSEPageRequest->validated();
            $fileName ='';
            $clientMenusId = ClientMenus::with('menusRelation')->where('id',$request->idParentMenus)->first();
            if($request->file('attachmentHSE')){
                $customName = $request->idParentMenus.'-'.date('YmdHis');
                $originalName = $request->file('attachmentHSE')->getClientOriginalExtension();
                $fileName =$customName.'.'.$originalName;
            }  
            if($request->optionHSE == 1){
                $post =[
                    'pageId'=>$request->idParentMenus,
                    'parentSubmenus'=>$clientMenusId->menusRelation->id,
                    'title'=>$request->titleHSE,
                    'attachment'=>'',
                    'description'=>$request->descriptionHSE,
                    'attachment' =>  $fileName != ''? 'storage/attachmentHSE/'.$fileName  : '',
                ];
                
                MasterHSEPage::create($post);
                if($request->file('attachmentHSE')){
                    $request->file('attachmentHSE')->storeAs('/attachmentHSE',$fileName);
                }
            }else{
                if($request->file('attachmentHSE')){
                   
                    $post =[
                        'parentSubmenus'=>$clientMenusId->menusRelation->id,
                        'title'=>$request->titleHSE,
                        'attachment'=>'',
                        'description'=>$request->descriptionHSE,
                        'attachment' =>'storage/attachmentHSE/'.$fileName,
                    ];
                    $request->file('attachmentHSE')->storeAs('/attachmentHSE',$fileName);
                }else{
                    $dataOld = MasterHSEPage::where('pageId',$request->idParentMenus)->first();
                    $post =[
                        'parentSubmenus'=>$clientMenusId->menusRelation->id,
                        'title'=>$request->titleHSE,
                        'attachment'=>'',
                        'description'=>$request->descriptionHSE,
                        'attachment' =>$dataOld->Attachment
                    ];
                    // dd($post);
                }
                  MasterHSEPage::where('pageId',$request->idParentMenus)->update($post);
               
            }
            return ResponseFormatter::success(   
                $request,                              
                'HSE Page successfully updated'
            );            
        // } catch (\Throwable $th) {
        //     return ResponseFormatter::error(
        //         $th,
        //         'HSE Page failed to add',
        //         500
        //     );
    }

}
