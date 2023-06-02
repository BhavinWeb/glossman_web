<?php

namespace App\Http\Traits;

use App\Models\BrowsingHistory;


trait HasBrowseHistory
{

    protected function getBrowseHistory($request)
    {
        $query = BrowsingHistory::query();

        // name
        if ($request->has('title') && $request->title != null) {

            $query->whereHas('product', function ($q) use($request) {
                $q->where('title', 'LIKE', "%$request->title%");
            });
        }
        // date
        if ($request->has('date') && $request->date != null) {

            $query->whereDate('created_at', request('date'));
        }

        // all
        if ($request->has('items') && $request->items == 'all') {

            $query->get();
        }else{
            $query->paginate(10);
        }

        return $query;
    }
}
