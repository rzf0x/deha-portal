<section>
    @if (session()->has('success'))
        <div class="d-flex justify-content-end">
            <div wire:poll class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <!-- Orders Table -->
    <div class="card border-0 mb-0">
        <div class="card-header bg-transparent">
            <div class="d-flex justify-content-between">
                <!-- Title -->
                <div class="mb-2 mb-sm-0">
                    <h5 class="card-title fs-5 mb-0">Daftar Produk</h5>
                </div>

                <button wire:click='create' data-bs-toggle="modal" data-bs-target="#createOrUpdateProduct"
                    class="btn btn-primary">Tambah
                    Product +</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Produk</th>
                            <th>Foto</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->listProduct() as $product)
                            <tr>
                                <td>{{ $product->product_number }}</td>
                                <td>
                                    @if ($product->foto)
                                        <img style="width: 3rem; border-radius: 50%; height: 3rem; object-fit:cover;"
                                            src="{{ Storage::url('photos/' . $product->foto) }}" alt="">
                                    @else
                                        <p class="m-0">Foto tidak tersedia!</p>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'Tidak Berkategori' }}</td>
                                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stok }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#createOrUpdateProduct"
                                            wire:click="edit('{{ $product->id }}')">Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="deleteProduct('{{ $product->id }}')"
                                            wire:confirm="Apakah kamu yakin ingin menghapus produk '{{ $product->name }}'?">Hapus
                                        </button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailProduct"
                                            wire:click="detailProduct('{{ $product->id }}')">Detail
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <p class="m-0">Tidak ada produk tersedia!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Order Detail Modal -->
    <div class="modal fade" id="detailProduct" wire:ignore.self tabindex="-1">
        <div class="modal-dialog {{ $detailProductList?->foto ? 'modal-lg' : 'modal-md' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk #{{ $detailProductList?->product_number }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        @if ($detailProductList?->foto)
                            <div class="me-3" style="width: 100%; position: relative;">
                                <img src="{{ Storage::url('photos/' . $detailProductList?->foto) }}"
                                    class="img-fluid rounded"
                                    style="position: absolute; object-fit:cover; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endif
                        <div class="flex-grow-1">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <strong>Nama Produk:</strong>
                                    <p class="mb-1">{{ $detailProductList?->name }}</p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Kategori:</strong>
                                    <p class="mb-1">{{ $detailProductList?->category?->name ?? 'Tidak Berkategori' }}
                                    </p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Harga:</strong>
                                    <p class="mb-1">Rp.
                                        {{ number_format($detailProductList?->price ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Stok:</strong>
                                    <p class="mb-1">{{ $detailProductList?->stok }} Unit</p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Deskripsi:</strong>
                                    <p class="mb-1">{{ $detailProductList?->description ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Dibuat Pada:</strong>
                                    <span class="badge bg-info">
                                        {{ $detailProductList?->created_at?->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Create & Update Modal --}}
    <div class="modal fade" wire:ignore.self id="createOrUpdateProduct" tabindex="-1">
        <div class="modal-dialog {{ $productForm->foto ? 'modal-lg' : 'modal-md' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $productId ? 'Update Produk' : 'Produk Baru' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                @if (session()->has('error'))
                    <div wire:poll class="d-flex w-100">
                        <div class="alert alert-danger w-100">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <form wire:submit.prevent='{{ $productId ? 'updateProduct' : 'createProduct' }}'>
                    <div class="modal-body">
                        <div class="d-flex">
                            {{-- Preview Gambar --}}
                            @if ($productForm->foto)
                                <div class="me-3" style="width: 40%; position: relative;">
                                    @if (is_string($productForm->foto))
                                        {{-- Untuk edit (gambar lama) --}}
                                        <img src="{{ Storage::url('photos/' . $productForm->foto) }}"
                                            class="img-fluid rounded"
                                            style="position: absolute; object-fit:cover; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        {{-- Untuk upload baru --}}
                                        <img src="{{ $productForm->foto->temporaryUrl() }}" class="img-fluid rounded"
                                            style="position: absolute; object-fit:cover; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <div class="mb-2">
                                    <label for="foto" class="form-label">Foto Produk</label>
                                    <input type="file" class="form-control" id="foto"
                                        wire:model.live="productForm.foto" accept="image/png,image/jpeg,image/jpg">
                                    @error('productForm.foto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Sisa kode form tetap sama -->
                                <div class="mb-2">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="name"
                                        wire:model.live="productForm.name" placeholder="Nama Produk" required>
                                    @error('productForm.name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select class="form-select" id="category"
                                        wire:model.live="productForm.category_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($this->getCategories() as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('productForm.category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="mb-2 col-lg-6">
                                        <label for="price" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="price"
                                            wire:model.live="productForm.price" placeholder="Harga Produk" required>
                                        @error('productForm.price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-2 col-lg-6">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control" id="stok"
                                            wire:model.live="productForm.stok" placeholder="Jumlah Stok" required>
                                        @error('productForm.stok')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="description" class="form-label">Deskripsi (Opsional)</label>
                                    <textarea class="form-control" id="description" wire:model.live="productForm.description"
                                        placeholder="Deskripsi Produk"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn {{ $productId ? 'btn-warning' : 'btn-primary' }}"
                            wire:loading.attr="disabled" wire:target="productForm.foto,createProduct,updateProduct">
                            <span wire:loading.remove wire:target="productForm.foto,createProduct,updateProduct">
                                {{ $productId ? 'Update' : 'Tambah' }}
                            </span>
                            <span wire:loading wire:target="productForm.foto,createProduct,updateProduct">
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                                {{ $productId ? 'Updating...' : 'Menambahkan...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
