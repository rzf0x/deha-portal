<?php

namespace App\Livewire\Admin\AdminWarung;

use App\Livewire\Forms\CategoryProductForm;
use App\Models\Cashless\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Kategori extends Component
{
    #[Title('Halaman Kategori Produk')]

    public CategoryProductForm $categoryForm;
    public $categoryId, $detailCategoryProduct;

    #[Computed]
    public function listKategori()
    {
        return Category::all();
    }

    public function create()
    {
        $this->categoryId = null;
        $this->categoryForm->reset();
    }

    public function createCategory()
    {
        try {
            $this->categoryForm->validate([
                'name' => 'required'
            ]);

            $orderNumber = 'CAT-' . date('YmdHis');

            Category::create([
                'category_number' => $orderNumber,
                'name' => $this->categoryForm->name
            ]);

            session()->flash('success', 'Kategori baru berhasil dibuat!');

            return to_route('petugas-warung.kategori');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->categoryId = $id;
        $categoryEdit = Category::findOrFail($id);
        $this->categoryForm->fill($categoryEdit);
    }

    public function updateCategory()
    {
        try {
            $this->categoryForm->validate([
                'name' => 'required'
            ]);

            Category::findOrFail($this->categoryId)->update([
                'name' => $this->categoryForm->name
            ]);

            session()->flash('success', 'Kategori berhasil diupdate!');

            return to_route('petugas-warung.kategori');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        session()->flash('success', 'Berhasil hapus ' . $category->category_number);
        $category->delete();
    }

    public function detailCategory($id)
    {
        $this->detailCategoryProduct = Category::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.admin-warung.kategori');
    }
}
