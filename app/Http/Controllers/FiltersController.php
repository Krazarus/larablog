<?php

namespace App\Http\Controllers;

use App\Filter;
use Illuminate\Http\Request;

class FiltersController extends Controller
{
    public function index()
    {
        $filters = Filter::all();
        return view('filters.index', compact('filters'));
    }

    public function store(Filter $filter)
    {
            Filter::create([
                'name' => request('name'),
            ]);
            return back();
    }

    public function destroy(Filter $filter)
    {
        $filter->delete();
        return back()
            ->with(['flash' => 'Filter successfully deleted', 'class' => 'success']);
    }
}
