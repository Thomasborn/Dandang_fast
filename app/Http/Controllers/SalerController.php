<?php

namespace App\Http\Controllers;

use App\Models\Saler;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalerController extends Controller
{
    public function index()
    {
        $salers = Sales::all();
        return view('saler.index', compact('salers'));
    }

    public function create()
    {
        return view('saler.create');
    }

    public function store(Request $request)
    {
        // Validation logic goes here

        Sales::create([
            'Kode' => $request->input('kode'),
            'Nama' => $request->input('nama'),
            // Add other fields as needed
        ]);

        return redirect()->route('saler.index')->with('success', 'Saler created successfully.');
    }

    public function show($kode)
    {
        $saler = Sales::where('Kode', $kode)->firstOrFail();
        return view('saler.show', compact('saler'));
    }

    public function edit($kode)
    {
        $saler = Sales::where('Kode', $kode)->firstOrFail();
        return view('saler.edit', compact('saler'));
    }

    public function update(Request $request, $kode)
    {
        // Validation logic goes here

        $saler = Sales::where('Kode', $kode)->firstOrFail();
        $saler->update([
            'Kode' => $request->input('kode'),
            'Nama' => $request->input('nama'),
            // Update other fields as needed
        ]);

        return redirect()->route('saler.index')->with('success', 'Saler updated successfully.');
    }

    public function destroy($kode)
    {
        $saler = Sales::where('Kode', $kode)->firstOrFail();
        $saler->delete();
        toast('Saler Dihapus!', 'warning');
        return redirect()->route('saler.index')->with('success', 'Saler deleted successfully');

       
    }}