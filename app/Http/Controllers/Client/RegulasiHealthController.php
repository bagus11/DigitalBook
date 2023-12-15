<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientMenus;
use App\Models\MasterHSEPage;
use Illuminate\Http\Request;

class RegulasiHealthController extends Controller
{
    function index() {
        $currenturl = array_reverse(explode('/', url()->current()))[0];
        $menusId    = ClientMenus::where('link', $currenturl)->first();
        $getData       = MasterHSEPage::where('pageId',$menusId->id)->first();
        $data=['data'=>$getData];
        if($getData != null){
            return view('clientPage.health.regulasiHealth-index',$data);
        }else{
            return view('clientPage.unprogress.unprogress',$data);
        }
    }
}
