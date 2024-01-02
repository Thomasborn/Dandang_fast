@extends('layouts.app')

@section('title', 'Edit Saler')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('saler.index') }}">Saler</a></li>
        <li class="breadcrumb-item active">Ubah</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('saler.update', $saler->Kode) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-6">
                    @include('utils.alerts')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Ubah Saler</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kode" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode" value="{{ $saler->Kode }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $saler->Nama }}" required>
                            </div>

                            <!-- Add other fields as needed -->

                            <button type="submit" class="btn btn-primary">Ubah Saler <i class="bi bi-check"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
