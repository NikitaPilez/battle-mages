<?php

namespace App\Http\Requests\V1\Infection;

use App\Models\V1\Infection\InfectionCardDeck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetPlayerCardsRequest extends FormRequest
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
            'userId' => 'required|integer',
            'roomId' => 'integer',
            'statuses' => [Rule::in(InfectionCardDeck::AVAILABLE_STATUSES)],
        ];
    }
}
