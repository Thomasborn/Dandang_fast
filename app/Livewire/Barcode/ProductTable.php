<?php

namespace App\Livewire\Barcode;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Milon\Barcode\Facades\DNS1DFacade;
use Modules\Product\Entities\Product;

class ProductTable extends Component
{
    public $product;
    public $quantity;
    public $barcodes;

    protected $listeners = ['productSelected'];

    public function mount() {
        $this->product = '';
        $this->quantity = 0;
        $this->barcodes = [];
    }

    public function render() {
        return view('livewire.barcode.product-table');
    }

    public function productSelected(Product $product) {
        $this->product = $product;
        $this->quantity = 1;
        $this->barcodes = [];
    }

    public function generateBarcodes(Product $product, $quantity) {
        if ($quantity > 100) {
            return session()->flash('message', 'Max quantity is 100 per barcode generation!');
        }

        if (!is_numeric($product->product_code)) {
            return session()->flash('message', 'Tidak Dapat menggunakan kode tersebut');
        }

        $this->barcodes = [];

        for ($i = 1; $i <= $quantity; $i++) {
            $barcode = DNS1DFacade::getBarCodeSVG($product->product_code, $product->product_barcode_symbology,2 , 60, 'black', false);
            array_push($this->barcodes, $barcode);
        }
    }
    public function getPdf() {

            $pdf = Pdf::loadView('product::barcode.print', [
                'barcodes' => $this->barcodes,
                'price' => $this->product->product_price,
                'name' => $this->product->product_name,
            ]);
    
            // Optional: You can set paper size, orientation, etc.
            $pdf->setPaper('a4');
    
            // Generate a unique filename
            $filename = 'barcodes-' . $this->product->product_code . '.pdf';
    
            // Save the PDF to a barcodesorary directory
            $pdf->save(public_path('barcodes/' . $filename));
    
            // Return the path to the saved PDF
            return public_path('barcodes/' . $filename);
     
    }
    

    public function updatedQuantity() {
        $this->barcodes = [];
    }
}
