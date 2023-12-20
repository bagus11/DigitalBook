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
            $fileNameAttachment ='';
            $fileCustomName ='';
            $clientMenusId = ClientMenus::with('menusRelation')->where('id',$request->idParentMenus)->first();
            if($request->file('attachmentHSE')){
                $customNameAttachment = $request->idParentMenus.'-'.date('YmdHis');
                $originalNameAttachment = $request->file('attachmentHSE')->getClientOriginalExtension();
                $fileNameAttachment =$customNameAttachment.'.'.$originalNameAttachment;
            }  
            if($request->file('coverAttachmentHSE')){
                $customCoverName = $request->idParentMenus.'-'.date('YmdHis');
                $orignalCustomName = $request->file('coverAttachmentHSE')->getClientOriginalExtension();
                $fileCustomName =$customCoverName.'.'.$orignalCustomName;
            }  
            if($request->optionHSE == 1){
                $post =[
                    'pageId'=>$request->idParentMenus,
                    'parentSubmenus'=>$clientMenusId->menusRelation->id,
                    'title'=>$request->titleHSE,
                    'description'=>$request->descriptionHSE,
                    'attachmentPDF' =>  $fileNameAttachment != ''? 'storage/attachmentHSE/'.$fileNameAttachment  : '',
                    'attachment' =>  $fileCustomName != ''? 'storage/attachmentCover/'.$fileCustomName  : '',
                ];
                MasterHSEPage::create($post);
                $dom = new \DomDocument();
                $img = $dom->getElementsByTagName('img');
                if($img){
                    $content = $request->descriptionHSE;
                    $dom = new \DomDocument();
                    $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);
                    $imageFile = $dom->getElementsByTagName('img');
              
                    foreach($imageFile as $item => $image){
                        $data = $image->getAttribute('src');
                        list($type, $data) = explode(';', $data);
                        list(, $data)      = explode(',', $data);
                        $imgeData = base64_decode($data);
                        $image_name= "/storage/AttachmentBody/" . time().$item.'.png';
                        $path = public_path() . $image_name;
                        file_put_contents($path, $imgeData);
                        
                        $image->removeAttribute('src');
                        $image->setAttribute('src', $image_name);
                     }
                }
                try {
                    if($request->file('attachmentHSE')){
                        $request->file('attachmentHSE')->storeAs('/attachmentHSE',$fileNameAttachment);
                    }
                    if($request->file('coverAttachmentHSE')){
                        $request->file('coverAttachmentHSE')->storeAs('/attachmentCover',$fileCustomName);
                    }
                } catch (\Exception $e) {
                    return ResponseFormatter::error(
                                $e,
                                'HSE Page failed to add',
                                500
                            );
                }
              
            }else{
                // dd($fileCustomName);
                $dataOld = MasterHSEPage::where('pageId',$request->idParentMenus)->first();
                if($fileNameAttachment ==''){
                    $uploadAttachment =$dataOld->attachmentPDF;
                }else{
                    $uploadAttachment =  'storage/attachmentHSE/'.$fileNameAttachment;
                }

                if($fileCustomName =='' )
                {
                   $uploadAttachmentPDF     =  $dataOld->Attachment;
                }else{
                    $uploadAttachmentPDF    = 'storage/attachmentCover/'.$fileCustomName;
                }
                $post =[
                    'parentSubmenus'=>$clientMenusId->menusRelation->id,
                    'title'=>$request->titleHSE,
                    'description'=>$request->descriptionHSE,
                    'attachmentPDF' =>  $uploadAttachment,
                    'Attachment' =>  $uploadAttachmentPDF,
                ];
                if($request->file('attachmentHSE')){
                    $request->file('attachmentHSE')->storeAs('/attachmentHSE',$fileNameAttachment);
                }
                if($request->file('coverAttachmentHSE')){
                    $request->file('coverAttachmentHSE')->storeAs('/attachmentCover',$fileCustomName);
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
