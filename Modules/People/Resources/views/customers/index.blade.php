@extends('layouts.app')

@section('title', 'Outlet List')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active">Outlet</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="m-0">Daftar Outlet</h2>
                            <div>
                                <a href="{{ route('customers.create') }}" class="btn btn-primary">
                                    Tambah Outlet <i class="bi bi-plus"></i>
                                </a>
                               
                            </div>
                        </div>

                        <!-- Add DataTable initialization here -->
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
