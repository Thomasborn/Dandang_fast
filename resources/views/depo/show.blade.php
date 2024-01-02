@extends('layouts.app')

@section('title', 'Detail Depo')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Detail Depo</div>

                <div class="card-body">
                    <p><strong>Kode:</strong> {{ $depo->Kode }}</p>
                    <p><strong>Alamat:</strong> {{ $depo->alamat }}</p>
                    <!-- Display other fields as needed -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
