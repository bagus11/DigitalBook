<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\StoreDigitalBookDetailRequest;
use App\Http\Requests\StoreDigitalBookHeaderRequest;
use App\Http\Requests\UpdateDigitalBookDetailRequest;
use App\Models\DigitalBookDetail;
use App\Models\DigitalBookDetailLog;
use App\Models\DigitalBookHeader;
use App\Models\DigitalBookPIC;
use App\Models\MasterDepartement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DigitalBookController extends Controller
{
    function index(){
        return view('digitalBook.digitalBook-index');
    }
    function getDigitalBook(){
        $data = DigitalBookHeader::with(['detailRelation','departementRelation','departementRelation.divisionRelation'])->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function updateStatusDigitalBookHeader(Request $request) {
        $status =500;
        $message ="Data failed to update";
        $id = DigitalBookHeader::find($request->id);
        $update = DigitalBookHeader::find($request->id)->update([
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
    function addDigitalBookHeader(Request $request, StoreDigitalBookHeaderRequest $storeDigitalBookHeaderRequest) {
        try {
            $storeDigitalBookHeaderRequest->validated(); 
            $requestCode ='';
            $incrementCode  = DigitalBookHeader::where('divId',$request->dbDivisionId)->orderBy('id','desc')->first();
            $initialCode    = MasterDepartement::find($request->dbDeptId);
            if($incrementCode){
                $incrementExplode = explode('/',$incrementCode->requestCode);
                $requestCode =  $request->dbDivisionId.'/'.$initialCode->initial.'/'.$incrementExplode[2] + 1;
               
            }else{
               $requestCode = $request->dbDivisionId.'/'.$initialCode->initial.'/'.'1';
            }
            DigitalBookHeader::create([
                'deptId'        =>$request->dbDeptId,
                'requestCode'   =>$requestCode,
                'divId'         =>$request->dbDivisionId,
                'pic'           =>'',
                'flg_active'    =>1
                
            ]);
            return ResponseFormatter::success(                                
                $storeDigitalBookHeaderRequest,
                'Header successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Header failed to update',
                500
            );
        }
    }
    function getDigitalBookDetail(Request $request) {
        $data = DigitalBookDetail::with(['locationRelation','isoRelation'])->where('requestCode',$request->requestCode)->where('locationId','like','%'.$request->locationId.'%')->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function getPICDigitalBook(Request $request) {
        $userId     =[];
        $active     = DigitalBookPIC::with(['userRelation','userRelation.titleRelation'])->where('detailCode',$request->detailCode)->get();
        foreach($active as $row){
            array_push($userId, $row->userId);
        }
        $inactive   = User::with('titleRelation')->whereNotIn('id',$userId)->get();
        return response()->json([
            'active'=>$active,
            'inactive'=>$inactive,
        ]);  
    }
    function updateDigitalBookPIC(Request $request) {
        $status         = 500;
        $message        = 'PIC failed to udpate';
        $postArray      =[];
        $requestCode    = DigitalBookDetail::where('detailCode',$request->detailCode)->first();
        if($request->type == 2){
            foreach($request->picId as $row){
                $post =[
                    'requestCode'   =>$requestCode->requestCode,
                    'detailCode'    =>$request->detailCode,
                    'userId'        =>$row ,
                    'created_at'    =>date('Y-m-d H:i:s')
                ];
                array_push($postArray, $post);
            }
            $insert = DigitalBookPIC::insert($postArray);
            if($insert){
                $status =200;
                $message ='PIC successfully updated';
            }
        }else{
            $delete = DigitalBookPIC::whereIn('userId',$request->picId)->delete();
            if($delete){
                $status =200;
                $message ='PIC successfully updated';  
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);  
    }
    function updateIndexDigitalBook(Request $request) {
        $status         = 500;
        $message        = 'Data failed to udpate';
        $update         = DigitalBookDetail::where('detailCode',$request->detailCode)->update(['index'=>$request->index]);
        if($update){
            $status     =200;
            $message    ="Data successfully updated";
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]); 
    }
    function addDigitalBookDetail(Request $request, StoreDigitalBookDetailRequest $storeDigitalBookDetailRequest){
        require_once('pdfwatermarker/pdfwatermarker.php');
        require_once('pdfwatermarker/pdfwatermark.php');
        try {
            $storeDigitalBookDetailRequest->validated(); 
            $fileName           = '';
            $detailCode         = '';
            $typeName           = '';
            if($request->dbTypeId == 1){
                $typeName='PS';
            }else if($request->dbTypeId == 2){
                $typeName='IK';
            }else{
                $typeName='PM';
            }
            $departementId      = DigitalBookHeader::with('departementRelation')->where('requestCode',$request->requestCode)->first();

            // Setup Detail Code
                if($request->dbLocationId == 3){
                    $lastRecord         = DigitalBookDetail::with('headerRelation','headerRelation.departementRelation')->whereHas('headerRelation', function($query) use($departementId){
                                                                    $query->where('deptId',$departementId->deptId);})
                                                                ->where('type',$request->dbTypeId)
                                                                ->where('locationId',$request->dbLocationId)    
                                                                ->orderBy('id','desc')
                                                                ->first();
                    if($lastRecord != null){
                        $explodeLastRecod1  = explode(' ',$lastRecord->detailCode);
                        $explodeLastRecord2 = explode('.', $explodeLastRecod1[1]);
                        $explodeLastRecord3 = explode('-', $explodeLastRecord2[1]);
                        $detailCode         = $typeName.' '.$lastRecord->headerRelation->departementRelation->initial.'.'.str_pad($explodeLastRecord3[0] + 1, 2, '0', STR_PAD_LEFT).'-K';
                    }else{
                        $detailCode         = $typeName.' '.$departementId->departementRelation->initial.'.'.'01'.'-K';
                    } 
                }else{
                    $lastRecord         = DigitalBookDetail::with('headerRelation','headerRelation.departementRelation')->whereHas('headerRelation', function($query) use($departementId){
                                                                $query->where('deptId',$departementId->deptId);})
                                                            ->where('type',$request->dbTypeId)
                                                            ->where('locationId','!=', 3)    
                                                            ->orderBy('id','desc')
                                                            ->first();
                    if($lastRecord != null){
                        $explodeLastRecod1  = explode(' ',$lastRecord->detailCode);
                        $explodeLastRecord2 = explode('.', $explodeLastRecod1[1]);
                        $detailCode         = $typeName.' '.$lastRecord->headerRelation->departementRelation->initial.'.'.str_pad($explodeLastRecord2[1] + 1, 2, '0', STR_PAD_LEFT);
                    }else{
                        $detailCode         = $typeName.' '.$departementId->departementRelation->initial.'.'.'01';
                    }
                }
            // Setup Detail Code
           
            // Setup name for attachment
                if($request->file('dbAttachment')){
                    $customName = $detailCode;
                    $originalName = $request->file('dbAttachment')->getClientOriginalExtension();
                    $fileName =$customName.'.'.$originalName;
                }  
                
            // Setup name for attachment
                DigitalBookDetail::create([
                    'title'         => $request->dbTitle,
                    'description'   => $request->dbDescription,
                    'locationId'    => $request->dbLocationId,
                    'attachment'    => 'storage/DigitalBook/'.$fileName,
                    'flg_active'    =>1,
                    'index'         =>0,
                    'type'          => $request->dbTypeId,
                    'detailCode'    => $detailCode,
                    'isoId'         => $request->dbIsoId,
                    'requestCode'   => $request->requestCode
                ]);

            if($request->hasFile('dbAttachment')){
                $request->file('dbAttachment')->storeAs('DigitalBook',$fileName);
                //Specify path to image. The image must have a 96 DPI resolution.
                $watermark = new PDFWatermark('COPY');
                //Set the position
                $watermark->setPosition('center');
                //Place watermark behind original PDF content. Default behavior places it over the content.
                $watermark->setAsBackground();
                //Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
                $watermarker = new PDFWatermarker('storage/DigitalBook/'.$fileName,$watermark); 
                //Set page range. Use 1-based index.
                $watermarker->setPageRange(1,5);
                //Save the new PDF to its specified location
                $watermarker->savePdf(); 
            }
            return ResponseFormatter::success(                                
                $storeDigitalBookDetailRequest,
                'Detail Book successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Detail Book failed to update',
                500
            );
        }
    }
    function detailDigitalBook(Request $request){
        $data   = DigitalBookDetail::with('isoRelation','locationRelation')->where('detailCode',$request->detailCode)->first();
        return response()->json([
            'data'=>$data,
        ]); 
    }
    
    function updateDigitalBookDetail(Request $request, UpdateDigitalBookDetailRequest $updateDigitalBookDetailRequest) {
        require_once('pdfwatermarker/pdfwatermarker.php');
        require_once('pdfwatermarker/pdfwatermark.php');
        try {
            $updateDigitalBookDetailRequest->validated(); 
            $fileName           = '';
            $fileNameDel        = '';
            $digitalBookDetail  = DigitalBookDetail::where('detailCode',$request->detailCode)->first();
            $attachmentExplode  = explode('/',$digitalBookDetail->attachment);
            $attachmentExplode2 = explode('.',$attachmentExplode[2]);
        
            DB::transaction(function() use($request,$digitalBookDetail,$fileName,$fileNameDel, $attachmentExplode,$attachmentExplode2) {
                if($request->hasFile('dbdAttachment')){
                    // Setup name for attachment
                       if($request->file('dbdAttachment')){
                           $fileName       = $attachmentExplode[2];
                           $fileNameDel    = $attachmentExplode2[0].'.'.$attachmentExplode2[1].'-'.date('YmdHis').'.'.$attachmentExplode2[2];
                       }  
                   // Setup name for attachmentx`

                   Storage::move($attachmentExplode[1].'/'.$attachmentExplode[2], 'DigitalBookHistory/'.'Del '.$fileNameDel);
                   $request->file('dbdAttachment')->storeAs('DigitalBook',$fileName);
                        //Specify path to image. The image must have a 96 DPI resolution.
                        $watermark = new PDFWatermark('COPY');
                        //Set the position
                        $watermark->setPosition('center');
                        //Place watermark behind original PDF content. Default behavior places it over the content.
                        $watermark->setAsBackground();
                        //Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
                        $watermarker = new PDFWatermarker('storage/DigitalBook/'.$fileName,$watermark); 
                        //Set page range. Use 1-based index.
                        $watermarker->setPageRange(1,5);
                        //Save the new PDF to its specified location
                        $watermarker->savePdf(); 
               }
                $update             = DigitalBookDetail::where('detailCode',$request->detailCode)
                                                        ->update([
                                                                'title'         => $request->dbdTitle,
                                                                'description'   => $request->dbdDescription,
                                                                'attachment'    => $fileName != null ? 'storage/DigitalBook/'.$fileName : $digitalBookDetail->attachment
                                                        ]);
                if($update){
                    $attachmentLabel = $fileName != null ? 'updated' : '';
                    DigitalBookDetailLog::create([
                        'detailCode'    => $request->detailCode,
                        'attachment'    =>  'storage/DigitalBookHistory/'.$attachmentLabel,
                        'userId'        => auth()->user()->id,
                        'message'       => "title : $request->dbdTitle \n description : $request->dbdDescription \n attachment : "
                    ]);
                    
                    
                }
            });
            return ResponseFormatter::success(                                
                $updateDigitalBookDetailRequest,
                'Detail Book successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Detail Book failed to update',
                500
            );
        }
    }
    function getDigitalBookLog(Request $request) {
        $data   = DigitalBookDetailLog::with('detailRelation','userRelation')->where('detailCode',$request->detailCode)->get();
        $detail   = DigitalBookDetail::with('isoRelation','locationRelation')->where('detailCode',$request->detailCode)->first();
        return response()->json([
            'data'=>$data,
            'detail'=>$detail,
        ]);  
    }
}
