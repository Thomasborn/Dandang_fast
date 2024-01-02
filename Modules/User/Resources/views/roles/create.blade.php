@extends('layouts.app')

@section('title', 'Create Role')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
@endsection

@push('page_css')
    <style>
        .custom-control-label {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('utils.alerts')
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah Role <i class="bi bi-check"></i>
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Role <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="permissions">Permissions <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="select-all">
                                    <label class="custom-control-label" for="select-all">Berikan Semua Akses / Permissions</label>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dashboard Permissions -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Beranda
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_total_stats" name="permissions[]"
                                                               value="show_total_stats" {{ old('show_total_stats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_total_stats">Total Stats</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_notifications" name="permissions[]"
                                                               value="show_notifications" {{ old('show_notifications') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_notifications">Notifikasi</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_month_overview" name="permissions[]"
                                                               value="show_month_overview" {{ old('show_month_overview') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_month_overview">Ringkasan Bulan</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_weekly_sales_purchases" name="permissions[]"
                                                               value="show_weekly_sales_purchases" {{ old('show_weekly_sales_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_weekly_sales_purchases">Penjualan dan Pembelian</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_monthly_cashflow" name="permissions[]"
                                                               value="show_monthly_cashflow" {{ old('show_monthly_cashflow') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_monthly_cashflow">Alur Kas Bulanan</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Management Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                           Manajemen User
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_user_management" name="permissions[]"
                                                               value="access_user_management" {{ old('access_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_user_management">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_own_profile" name="permissions[]"
                                                               value="edit_own_profile" {{ old('edit_own_profile') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_own_profile">Own Profile</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Products Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Barang /Produk
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_products" name="permissions[]"
                                                               value="access_products" {{ old('access_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_products">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_products" name="permissions[]"
                                                               value="show_products" {{ old('show_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_products">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_products" name="permissions[]"
                                                               value="create_products" {{ old('create_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_products">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_products" name="permissions[]"
                                                               value="edit_products" {{ old('edit_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_products">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_products" name="permissions[]"
                                                               value="delete_products" {{ old('delete_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_products">Hapus</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_product_categories" name="permissions[]"
                                                               value="access_product_categories" {{ old('access_product_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_product_categories">Kategori</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="print_barcodes" name="permissions[]"
                                                               value="print_barcodes" {{ old('print_barcodes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="print_barcodes">Print Barcodes</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Adjustments Permission -->
                           

                                <!-- Customers Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Outlet / Customers
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_customers" name="permissions[]"
                                                               value="access_customers" {{ old('access_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_customers">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_customers" name="permissions[]"
                                                               value="create_customers" {{ old('create_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_customers">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_customers" name="permissions[]"
                                                               value="show_customers" {{ old('show_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_customers">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_customers" name="permissions[]"
                                                               value="edit_customers" {{ old('edit_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_customers">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_customers" name="permissions[]"
                                                               value="delete_customers" {{ old('delete_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_customers">Hapus</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!-- depo Permission -->
                                 <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                       Depo
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_depo" name="permissions[]"
                                                               value="access_depo" {{ old('access_depo') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_depo">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_depo" name="permissions[]"
                                                               value="create_depo" {{ old('create_depo') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_depo">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_depo" name="permissions[]"
                                                               value="show_depo" {{ old('show_depo') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_depo">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_depo" name="permissions[]"
                                                               value="edit_depo" {{ old('edit_depo') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_depo">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_depo" name="permissions[]"
                                                               value="delete_depo" {{ old('delete_depo') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_depo">Hapus</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- saler Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                              Saler
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_saler" name="permissions[]"
                                                               value="access_saler" {{ old('access_saler') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_saler">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_saler" name="permissions[]"
                                                               value="create_saler" {{ old('create_saler') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_saler">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_saler" name="permissions[]"
                                                               value="show_saler" {{ old('show_saler') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_saler">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_saler" name="permissions[]"
                                                               value="edit_saler" {{ old('edit_saler') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_saler">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_saler" name="permissions[]"
                                                               value="delete_saler" {{ old('delete_saler') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_saler">Hapus</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Suppliers Permission -->
                                <!-- <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Suppliers
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_suppliers" name="permissions[]"
                                                               value="access_suppliers" {{ old('access_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_suppliers">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_suppliers" name="permissions[]"
                                                               value="create_suppliers" {{ old('create_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_suppliers">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_suppliers" name="permissions[]"
                                                               value="show_suppliers" {{ old('show_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_suppliers">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_suppliers" name="permissions[]"
                                                               value="edit_suppliers" {{ old('edit_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_suppliers">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_customers" name="permissions[]"
                                                               value="delete_customers" {{ old('delete_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_customers">Hapus</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- Sales Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Penjualan / Sale
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_sales" name="permissions[]"
                                                               value="access_sales" {{ old('access_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_sales">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_sales" name="permissions[]"
                                                               value="create_sales" {{ old('create_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_sales">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_sales" name="permissions[]"
                                                               value="show_suppliers" {{ old('show_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_sales">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_sales" name="permissions[]"
                                                               value="edit_sales" {{ old('edit_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_sales">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_sales" name="permissions[]"
                                                               value="delete_sales" {{ old('delete_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_sales">Hapus</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_pos_sales" name="permissions[]"
                                                               value="create_pos_sales" {{ old('create_pos_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_pos_sales">POS System</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_sale_payments" name="permissions[]"
                                                               value="access_sale_payments" {{ old('access_sale_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_sale_payments">Payments</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sale Returns Permission -->
                                <!-- <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Sale Returns
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_sale_returns" name="permissions[]"
                                                               value="access_sale_returns" {{ old('access_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_sale_returns">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_sale_returns" name="permissions[]"
                                                               value="create_sale_returns" {{ old('create_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_sale_returns">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_sale_returns" name="permissions[]"
                                                               value="show_sale_returns" {{ old('show_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_sale_returns">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_sale_returns" name="permissions[]"
                                                               value="edit_sale_returns" {{ old('edit_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_sale_returns">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_sale_returns" name="permissions[]"
                                                               value="delete_sale_returns" {{ old('delete_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_sale_returns">Hapus</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_sale_return_payments" name="permissions[]"
                                                               value="access_sale_return_payments" {{ old('access_sale_return_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_sale_return_payments">Payments</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- Purchases Permission -->
                                <!-- <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Purchases
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_purchases" name="permissions[]"
                                                               value="access_purchases" {{ old('access_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_purchases">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_purchases" name="permissions[]"
                                                               value="create_purchases" {{ old('create_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_purchases">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_purchases" name="permissions[]"
                                                               value="show_purchases" {{ old('show_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_purchases">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_purchases" name="permissions[]"
                                                               value="edit_purchases" {{ old('edit_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_purchases">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_purchases" name="permissions[]"
                                                               value="delete_purchases" {{ old('delete_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_purchases">Hapus</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_purchase_payments" name="permissions[]"
                                                               value="access_purchase_payments" {{ old('access_purchase_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_purchase_payments">Payments</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- Purchases Returns Permission -->
                                <!-- <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Purchase Returns
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_purchase_returns" name="permissions[]"
                                                               value="access_purchase_returns" {{ old('access_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_purchase_returns">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_purchase_returns" name="permissions[]"
                                                               value="create_purchase_returns" {{ old('create_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_purchase_returns">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_purchase_returns" name="permissions[]"
                                                               value="show_purchase_returns" {{ old('show_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_purchase_returns">Tampil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_purchase_returns" name="permissions[]"
                                                               value="edit_purchase_returns" {{ old('edit_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_purchase_returns">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_purchase_returns" name="permissions[]"
                                                               value="delete_purchase_returns" {{ old('delete_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_purchase_returns">Hapus</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_purchase_return_payments" name="permissions[]"
                                                               value="access_purchase_return_payments" {{ old('access_purchase_return_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_purchase_return_payments">Payments</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- Currencies Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Mata Uang
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_currencies" name="permissions[]"
                                                               value="access_currencies" {{ old('access_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_currencies">Akses</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_currencies" name="permissions[]"
                                                               value="create_currencies" {{ old('create_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_currencies">Tambah</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_currencies" name="permissions[]"
                                                               value="edit_currencies" {{ old('edit_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_currencies">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_currencies" name="permissions[]"
                                                               value="delete_currencies" {{ old('delete_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_currencies">Hapus</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reports -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Laporan
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_reports" name="permissions[]"
                                                               value="access_reports" {{ old('access_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_reports">Akses</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Settings -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Pengaturan
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_settings" name="permissions[]"
                                                               value="access_settings" {{ old('access_settings') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_settings">Akses</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#select-all').click(function() {
                var checked = this.checked;
                $('input[type="checkbox"]').each(function() {
                    this.checked = checked;
                });
            })
        });
    </script>
@endpush
