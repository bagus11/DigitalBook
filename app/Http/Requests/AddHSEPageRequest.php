<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class AddHSEPageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $optionHSE = $request->optionHSE;
        $descriptionHSE = $request->descriptionHSE;
        if($descriptionHSE == '<p><br></p>' || $descriptionHSE ==''){
            $request->descriptionHSE = '';
        }
        if($optionHSE == 1){
            $rule=[
                'titleHSE'      =>'required',
                'clientMenusId' =>'required',
                'descriptionHSE'=>'required',
                'idParentMenus' =>'required','unique:master_hse_pages,pageId',
                'attachmentHSE' =>'required'
            ];
        }else{
            $rule=[
                'titleHSE'      =>'required',
                'clientMenusId' =>'required',
                'descriptionHSE'=>'required'
            ];
        }
       
        return$rule;
    }
}
