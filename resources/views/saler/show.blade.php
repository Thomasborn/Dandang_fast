@extends('layouts.app')

@section('title', 'Detail Saler')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('saler.index') }}">Saler</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Saler</h4>

                        <dl class="row">
                            <dt class="col-sm-3">Kode:</dt>
                            <dd class="col-sm-9">{{ $saler->Kode }}</dd>

                            <dt class="col-sm-3">Nama:</dt>
                            <dd class="col-sm-9">{{ $saler->Nama }}</dd>

                            <!-- Add other fields as needed -->
                        </dl>

                        <div class="mt-4">
                            <a href="{{ route('saler.edit', $saler->Kode) }}" class="btn btn-primary">Edit Saler <i class="bi bi-pencil"></i></a>
                            <!-- Add delete button or other actions as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
