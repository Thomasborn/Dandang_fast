

<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Mulai<span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Selesai <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Outlet</label>
                                    <select wire:model="customer_id" class="form-control" name="customer_id">
                                        <option value="">Pilih Outlet</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select wire:model="sale_status" class="form-control" name="sale_status">
                                        <option value="">Pilih Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <select wire:model="payment_status" class="form-control" name="payment_status">
                                        <!-- <option value="">Select Payment Status</option> -->
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Partial">Partial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                Filter Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center mb-0">
                        <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No Faktur</th>
                            <th>Depo</th>
                            <th>Sales</th>
                            <th>Outlet</th>
                            <th>Total</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</td>
                                <td>{{ $sale->reference }}</td>
                                <td>{{ $sale->kode_depo }}</td>
                                <td>{{ $sale->kode_salesman }}</td>
                              
                                <td>{{ ($sale->customer_name) }}</td>
                                <td>Rp {{ number_format($sale->total_amount / 10, 3) }}</td>
                                
                                
                            <td>
      <span class="badge">
      <a href="{{ route('sales.show', $sale->id) }}">
    <img 
        src="https://icons.veryicon.com/png/o/miscellaneous/simple-line-icon/view-details-4.png" 
        alt=""
        style="max-width: 100%; height: 50px;"
    >
</a>

      </span>
    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <span class="text-danger">No Sales Data Available!</span>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div @class(['mt-3' => $sales->hasPages()])>
                   
                    {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


