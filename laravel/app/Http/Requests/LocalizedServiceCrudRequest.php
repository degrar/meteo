<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocalizedServiceCrudRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:255',
            'content' => 'required',
            // Validation uniqueness on 2 fields (in this case service_id and language_id
            //'service_id' => 'unique:localized_services,service_id,NULL,id,language_id,'.$this->get('language_id'),
        ];
    }

}