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
                    <h5 class="card-title fs-5 mb-0">Daftar Kategori Produk</h5>
                </div>

                <button wire:click='create' data-bs-toggle="modal" data-bs-target="#createOrUpdateCategory"
                    class="btn btn-primary">Tambah
                    Kategori +</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Product</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->listKategori() as $kategori)
                            <tr>
                                <td>{{ $kategori->category_number }}</td>
                                <td>{{ $kategori->name }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#createOrUpdateCategory"
                                            wire:click='edit("{{ $kategori->id }}")'>Edit</button>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click='deleteCategory("{{ $kategori->id }}")'
                                            wire:confirm='Apakah kamu ingin menghapus "{{ $kategori->name }}"?'>Delete</button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailCategory"
                                            wire:click='detailCategory("{{ $kategori->id }}")'>Detail</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">
                                    <p class="m-0">List Kategori tidak tersedia!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Order Detail Modal -->
    <div class="modal fade" id="detailCategory" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Category #{{ $detailCategoryProduct?->category_number }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-1">Nama Kategori: {{ $detailCategoryProduct?->name }}</p>
                    <p class="mb-1">DI Buat Pada: <span
                            class="badge bg-info">{{ $detailCategoryProduct?->created_at->format('d M Y') }}</span></p>
                </div>
            </div>
        </div>
    </div>
    {{-- Create & Update Modal --}}
    <div class="modal fade" wire:ignore.self id="createOrUpdateCategory" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $categoryId ? 'Update Kategori' : 'Kategori Baru' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                @if (session()->has('error'))
                    <div wire:poll class="d-flex w-100">
                        <div class="alert alert-danger w-100">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <form wire:submit.prevent='{{ $categoryId ? 'updateCategory' : 'createCategory' }}'>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="name"
                                wire:model.live="categoryForm.name" placeholder="Makanan Ringan" required>
                            @error('categoryForm.name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit"
                            class="btn {{ $categoryId ? 'btn-warning' : 'btn-primary' }}">{{ $categoryId ? 'Update' : 'Tambah' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
