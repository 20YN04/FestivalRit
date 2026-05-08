<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FestivalController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:update,festival', only: ['edit', 'update']),
            new Middleware('can:delete,festival', only: ['destroy']),
        ];
    }

    public function index()
    {
        $festivals = Festival::withCount('rides')->latest()->paginate(12);

        return view('festivals.index', compact('festivals'));
    }

    public function create()
    {
        return view('festivals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $festival = $request->user()->festivals()->create($data);

        return redirect()
            ->route('festivals.show', $festival)
            ->with('status', 'Festival aangemaakt.');
    }

    public function show(Festival $festival)
    {
        $festival->load('rides');

        return view('festivals.show', compact('festival'));
    }

    public function edit(Festival $festival)
    {
        return view('festivals.edit', compact('festival'));
    }

    public function update(Request $request, Festival $festival)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $festival->update($data);

        return redirect()
            ->route('festivals.show', $festival)
            ->with('status', 'Festival bijgewerkt.');
    }

    public function destroy(Festival $festival)
    {
        $festival->delete();

        return redirect()
            ->route('festivals.index')
            ->with('status', 'Festival verwijderd.');
    }
}
