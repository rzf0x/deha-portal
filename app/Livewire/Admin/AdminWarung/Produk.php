<?php

namespace App\Livewire\Admin\AdminWarung;

use App\Livewire\Forms\ProductListForm;
use App\Models\Cashless\Category;
use App\Models\Cashless\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Produk extends Component
{
    use WithFileUploads;

    #[Title('Halaman Produk')]

    public ProductListForm $productForm;
    public $productId, $detailProductList;

    #[Computed]
    public function listProduct()
    {
        return Product::with('category')->get();
    }

    public function create()
    {
        $this->productId = null;
        $this->productForm->reset();
    }

    public function createProduct()
    {
        try {
            $this->productForm->validate([
                'name' => 'required',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric',
                'stok' => 'required|numeric'
            ]);

            $productNumber = 'PRD-' . date('YmdHis');

            if ($this->productForm->foto) {
                $image = $this->productForm->foto;
                $imgName = time() . '-' . $image->hashname();

                $imgUrl = Storage::disk('public')->putFIleAs('photos/', $image, $imgName);
                $this->productForm->foto = basename($imgUrl);
            }

            Product::create([
                'product_number' => $productNumber,
                'name' => $this->productForm->name,
                'foto' => $this->productForm->foto,
                'category_id' => $this->productForm->category_id,
                'price' => $this->productForm->price,
                'stok' => $this->productForm->stok,
                'description' => $this->productForm->description ?? null,
                'seller_id' => auth()->user()->id
            ]);

            session()->flash('success', 'Produk baru berhasil dibuat!');

            return to_route('petugas-warung.produk');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->productId = $id;
        $productEdit = Product::findOrFail($id);
        $this->productForm->fill($productEdit);
    }

    public function updateProduct()
    {
        try {
            $this->validate([
                'productForm.name' => 'required',
                'productForm.category_id' => 'required|exists:categories,id',
                'productForm.price' => 'required|numeric',
                'productForm.stok' => 'required|numeric'
            ]);

            $product = Product::findOrFail($this->productId);

            $oldFoto = $product->foto;

            if ($this->productForm->foto instanceof \Illuminate\Http\UploadedFile) {
                $image = $this->productForm->foto;
                $imgName = time() . '-' . $image->hashName();

                $imgUrl = Storage::disk('public')->putFileAs('photos/', $image, $imgName);
                $newFoto = basename($imgUrl);

                if ($oldFoto && Storage::disk('public')->exists('photos/' . $oldFoto)) {
                    Storage::disk('public')->delete('photos/' . $oldFoto);
                }

                $product->update([
                    'name' => $this->productForm->name,
                    'foto' => $newFoto,
                    'category_id' => $this->productForm->category_id,
                    'price' => $this->productForm->price,
                    'stok' => $this->productForm->stok,
                    'description' => $this->productForm->description ?? null
                ]);
            } else {
                $product->update([
                    'name' => $this->productForm->name,
                    'category_id' => $this->productForm->category_id,
                    'price' => $this->productForm->price,
                    'stok' => $this->productForm->stok,
                    'description' => $this->productForm->description ?? null
                ]);
            }

            session()->flash('success', 'Produk berhasil diupdate!');

            // Optional: Redirect atau refresh
            return to_route('petugas-warung.produk');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        session()->flash('success', 'Berhasil hapus ' . $product->product_number);
        $product->delete();
    }

    public function detailProduct($id)
    {
        $this->detailProductList = Product::with('category')->findOrFail($id);
    }

    public function getCategories()
    {
        return Category::all();
    }

    public function render()
    {
        return view('livewire.admin.admin-warung.produk', [
            'categories' => $this->getCategories()
        ]);
    }
}
