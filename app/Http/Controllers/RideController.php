<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RideController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:update,ride', only: ['edit', 'update']),
            new Middleware('can:delete,ride', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $festivals = Festival::orderBy('name')->get();

        $query = Ride::with('festival');

        if ($request->filled('festival_id')) {
            $query->where('festival_id', $request->integer('festival_id'));
        }

        $rides = $query->latest('departure_time')->paginate(10)->withQueryString();
        $selectedFestivalId = $request->integer('festival_id') ?: null;

        return view('rides.index', compact('rides', 'festivals', 'selectedFestivalId'));
    }

    public function create(Request $request)
    {
        $festivals = Festival::orderBy('name')->get();
        $selectedFestivalId = $request->integer('festival_id');

        return view('rides.create', compact('festivals', 'selectedFestivalId'));
    }

    public function store(Request $request)
    {
        $data = $this->validateRide($request);

        $ride = $request->user()->rides()->create($data);

        return redirect()
            ->route('rides.show', $ride)
            ->with('status', 'Rit aangemaakt.');
    }

    public function show(Ride $ride)
    {
        $ride->load(['festival', 'user']);

        return view('rides.show', compact('ride'));
    }

    public function edit(Ride $ride)
    {
        $festivals = Festival::orderBy('name')->get();

        return view('rides.edit', compact('ride', 'festivals'));
    }

    public function update(Request $request, Ride $ride)
    {
        $ride->update($this->validateRide($request));

        return redirect()
            ->route('rides.show', $ride)
            ->with('status', 'Rit bijgewerkt.');
    }

    public function destroy(Ride $ride)
    {
        $ride->delete();

        return redirect()
            ->route('rides.index')
            ->with('status', 'Rit verwijderd.');
    }

    private function validateRide(Request $request): array
    {
        return $request->validate([
            'festival_id' => ['required', 'exists:festivals,id'],
            'driver_name' => ['required', 'string', 'max:255'],
            'departure_city' => ['required', 'string', 'max:255'],
            'total_seats' => ['required', 'integer', 'min:1', 'max:50'],
            'booked_seats' => ['nullable', 'integer', 'min:0', 'lte:total_seats'],
            'departure_time' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
