<?php

namespace App\Livewire\Admin\AdminWarung;

use App\Models\Cashless\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    #[Title('Dashboard Petugas Warung')]

    public $detailProductList;

    #[Computed]
    public function listProduct()
    {
        return Product::with('category')->paginate(10);
    }

    public function detailProduct($id)
    {
        $this->detailProductList = Product::with('category')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.admin-warung.dashboard');
    }
}
