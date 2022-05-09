<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchQuotesRequest;
use App\Http\Requests\UpdateOrCreateQuoteRequest;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class QuoteController extends Controller
{
    public function index(SearchQuotesRequest $request): LengthAwarePaginator
    {
        $search = $request->get('search');

        return Quote::with('tags')
            ->when($search, function (Builder $query) use ($search) {
                $query->where('author', 'ilike', '%'.$search.'%')
                    ->orWhere('text', 'ilike', '%'.$search.'%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function show(int $id)
    {
        return Quote::where('id', $id)
            ->with('tags')
            ->get();
    }

    public function searchQuotes(SearchQuotesRequest $request)
    {
        $query = $request->get('query');

        return Quote::with('tags')
            ->where('author', 'ilike', '%'.$query.'%')
            ->orWhere('text', 'ilike', '%'.$query.'%')
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
