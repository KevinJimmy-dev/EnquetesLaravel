<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePollRequest extends FormRequest{

    //protected $date;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){
        return [
            'title' => [
                'required',
                'string',
                'min:5',
                'max:200'
            ],
            'startDate' => [
                'required',
                'date_format:Y-m-d',
            ],
            'finishDate' => [
                'required',
                'date_format:Y-m-d',
                //'after:+1 day'
            ]
        ];
    }
}
