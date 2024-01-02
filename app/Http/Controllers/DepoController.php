<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depo;

class DepoController extends Controller
{
    public function index()
    {
        $depos = Depo::all();
        return view('depo.index', compact('depos'));
    }

    public function create()
    {
        return view('depo.create');
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'kode' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            // Add other validation rules as needed
        ];
    
        // Validate the request data
        $request->validate($rules);
    
        // Check for duplicates
        $existingRecord = Depo::where('Kode', $request->input('kode'))
        ->orWhere('alamat', $request->input('alamat'))
                               ->first();
    
        // If a duplicate is found, redirect back with an error message
        // dd($existingRecord);
        if ($existingRecord) {
            return redirect()->back()->withErrors(['error' => 'Kode sudah ada atau Depo sudah ada']);
        }
    
        // If validation passes and no duplicate is found, create a new Depo
        Depo::create([
            'Kode' => $request->input('kode'),
            'alamat' => $request->input('alamat'),
            // Add other fields as needed
        ]);
    
        return redirect()->route('depo.index')->with('success', 'Depo created successfully');
    }

    public function show($kode)
    {
        $depo = Depo::where('Kode', $kode)->firstOrFail();
        return view('depo.show', compact('depo'));
    }

    public function edit($kode)
    {
        $depo = Depo::where('Kode', $kode)->firstOrFail();
        return view('depo.edit', compact('depo'));
    }

    public function update(Request $request, $kode)
    {
        // Validation might be needed here
        $depo = Depo::where('Kode', $kode)->firstOrFail();

        
        $depo->update([
            'alamat' => $request->input('alamat'),
            // Add other fields as needed
        ]);
        
  
    
        return redirect()->route('depo.index')->with('success', 'Depo updated successfully');
    }
    

    public function destroy($kode)
    {
        $depo = Depo::where('Kode', $kode)->firstOrFail();
        $depo->delete();
        toast('Depo Dihapus!', 'warning');
        return redirect()->route('depo.index')->with('success', 'Depo deleted successfully');
    }
}
