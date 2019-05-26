<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserDrink extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'drink_name' => 'required|max:255',
            'drink_type' => 'required|max:255',
            'volume_value' => 'required|max:255',
            'volume_unit' => 'required|max:255',
            'alcohol_percent' => 'required|max:255',
            'price' => 'required|max:255',
            'place_name' => 'required|max:255',
            'place_latitude' => 'required|max:255',
            'place_longitude' => 'required|max:255',
        ];
    }
}
