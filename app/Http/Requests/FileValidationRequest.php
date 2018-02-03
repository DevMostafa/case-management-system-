<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileValidationRequest extends FormRequest
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
        $rules = [
            'caseFile' => 'required',
            'description'=>'required'
        ];
        $photos = count($this->input('caseFile'));
        foreach(range(2, $photos) as $index) {
            $rules['caseFile.' . $index] = 'mimes:jpeg,bmp,png,pdf,doc,docx|max:2000';
        }
 //image|mimes:jpeg,bmp,png|max:2000';caseFile.0 must be image

        return $rules;
    }
}
