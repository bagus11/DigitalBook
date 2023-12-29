<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterSignatureController extends Controller
{
    function index() {
        return view('approval.signature.master_signature-index');
    }
}
