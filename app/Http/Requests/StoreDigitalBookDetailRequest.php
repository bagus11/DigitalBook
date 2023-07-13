<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDigitalBookDetailRequest extends FormRequest
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
    public function rules()
    {
        return [
            'dbTitle'=>'required',
            'dbDescription'=>'required',
            'dbIsoId'=>'required',
            'dbLocationId'=>'required',
            'dbTypeId'=>'required',
            'dbAttachment'=>['required','mimes:pdf','max:21000'],
        ];
    }
}
