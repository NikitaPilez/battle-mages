<?php

namespace App\Http\Requests\V1\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeStatusRequest extends FormRequest
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
            'status' => [Rule::in(SpellCardDeck::AVAILABLE_STATUSES), 'required'],
            'spellCardDeckId' => 'integer|required'
        ];
    }
}
