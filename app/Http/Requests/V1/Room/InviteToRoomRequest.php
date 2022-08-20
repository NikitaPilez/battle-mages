<?php

namespace App\Http\Requests\V1\Room;

use Illuminate\Foundation\Http\FormRequest;

class InviteToRoomRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'roomId' => 'required|integer',
            'usersIds' => 'required|array'
        ];
    }
}
