@extends('layouts.app')


@section('title', 'Edit Depo')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('depo.index') }}">Outlet</a></li>
        <li class="breadcrumb-item active">Ubah</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form method="POST" action="{{ route('depo.update', $depo->Kode) }}">
        @csrf
                        @method('PUT')
                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Ubah Depo <i class="bi bi-check"></i></button>
                    </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
               
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                <div class="card-body">
               

                        <!-- Add your form fields based on your "Depo" model -->
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" value="{{ $depo->Kode }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $depo->alamat }}</textarea>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
