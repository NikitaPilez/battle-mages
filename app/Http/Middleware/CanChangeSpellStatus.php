<?php

namespace App\Http\Middleware;

use App\Models\V1\Deck\SpellCardDeck;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanChangeSpellStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $spellCardDeck = SpellCardDeck::findOrFail($request->input('spellCardDeckId'));
        if ($spellCardDeck->user->id !== Auth::user()->id) {
            return response()->json(['error' => 'Do not can']);
        }
        return $next($request);
    }
}
