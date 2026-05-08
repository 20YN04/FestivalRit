<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Ride;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function index()
    {
        $rides = Ride::with('festival')->latest('departure_time')->get();

        return view('rides.index', compact('rides'));
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

        $ride = Ride::create($data);

        return redirect()
            ->route('rides.show', $ride)
            ->with('status', 'Rit aangemaakt.');
    }

    public function show(Ride $ride)
    {
        $ride->load('festival');

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
            'available_seats' => ['required', 'integer', 'min:1', 'max:50'],
            'departure_time' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
