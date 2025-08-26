<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'address'     => 'nullable|string|max:255',
            'category'    => 'nullable|string|max:100',
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')
                         ->with('success', 'Local criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'address'     => 'nullable|string|max:255',
            'category'    => 'nullable|string|max:100',
        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')
                         ->with('success', 'Local atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')
                         ->with('success', 'Local removido com sucesso!');
    }
}
