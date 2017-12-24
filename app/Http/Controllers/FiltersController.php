<?php

namespace App\Http\Controllers;

use App\Filter;
use App\Http\Requests\StoreFilter;
use Illuminate\Http\Request;

class FiltersController extends Controller
{
    public function index()
    {
        $filters = Filter::all();
        return view('filters.index', compact('filters'));
    }

    public function create()
    {
        return view('filters.create');
    }

    public function store(StoreFilter $request)
    {
            Filter::create([
                'name' => request('name'),
            ]);
            return redirect('/filters')
                ->with([
                    'flash' => 'Filters was been created',
                    'class' => 'success'
                ]);
    }

    public function edit(Filter $filter)
    {
        return view('filters.edit', compact('filter'));
    }

    public function destroy(Filter $filter)
    {
        $filter->delete();
        return back()
            ->with(['flash' => 'Filter successfully deleted', 'class' => 'success']);
    }

    public function update(StoreFilter $request, Filter $filter)
    {
//        dd($filter);
        $filter->update([
            'name' => request('name')
        ]);
        return redirect('/filters')
            ->with([
                'flash' => 'Filter was been updated',
                'class' => 'success'
            ]);
    }
}
