<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchQuotesRequest;
use App\Http\Requests\UpdateOrCreateQuoteRequest;
use App\Models\Quote;
use Illuminate\Pagination\LengthAwarePaginator;

class QuoteController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Quote::with('tags')
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function show(int $id)
    {
        return Quote::where('id', $id)
            ->with('tags')
            ->get();
    }

    public function createOrUpdateQuotes(UpdateOrCreateQuoteRequest $request): void
    {
        /** @var Quote $quote */
        $quote = Quote::updateOrCreate(
            [
                'id' => $request->get('id'),
            ],
            [
                'text' => $request->get('text'),
                'author' => $request->get('author'),
            ]
        );

        $quote
            ->tags()
            ->sync($request->get('tag_ids'));
    }
}
