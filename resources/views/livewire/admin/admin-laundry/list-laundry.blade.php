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
                <div class="col-12 col-sm-6 d-flex align Kgs-center mb-2 mb-sm-0">
                    <h5 class="card-title fs-5 mb-0">Daftar Laundry</h5>
                </div>

                <button wire:click='create' data-bs-toggle="modal" data-bs-target="#createOrUpdateLaundry"
                    class="btn btn-primary">Tambah
                    Laundry +</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Cucian</th>
                            <th>Nama Santri</th>
                            <th>Kelas</th>
                            <th>Kamar</th>
                            <th>Quantity</th>
                            <th>Jenis Service</th>
                            <th>Subtotal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->listLaundry() as $laundry)
                            <tr>
                                <td>{{ $laundry->order_number }}</td>
                                <td>{{ $laundry->santri->nama }}</td>
                                <td>{{ $laundry->santri->kelas->nama }}</td>
                                <td>{{ $laundry->santri->kamar->nama }}</td>
                                <td>{{ $laundry->quantity }}</td>
                                <td>{{ $laundry->laundryService->name }}</td>
                                <td>Rp. {{ number_format($laundry->subtotal, 0, ',', '.') }}</td>
                                <td><span class="badge bg-warning">Dicuci</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#orderDetail">Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#orderDetail">Delete
                                        </button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#orderDetail">Detail
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Order Detail Modal -->
    <div class="modal fade" id="orderDetail" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Cucian #LS-2024001</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Informasi Santri</h6>
                            <p class="mb-1">Nama: Ahmad Faiz</p>
                            <p class="mb-1">NIS: 2024001</p>
                            <p class="mb-1">Kelas: XI A</p>
                            <p class="mb-1">Kamar: Ummar bin Khattab</p>
                            <p class="mb-1">Paket: Bulanan</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Cucian</h6>
                            <p class="mb-1">Tanggal Masuk: 16 Nov 2024</p>
                            <p class="mb-1">Estimasi Selesai: 17 Nov 2024</p>
                            <p class="mb-1">Status: <span class="badge bg-warning">Dicuci</span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Update Status</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="createOrUpdateLaundry" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pesanan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                @if (session()->has('error'))
                    <div wire:poll class="d-flex w-100">
                        <div class="alert alert-danger w-100">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-2 form-group col-lg-6">
                                <label for="nama_santri" class="form-label">Nama Lengkap</label>
                                <select class="form-control" id="laundry_service_id" wire:model="laundryForm.santri_id"
                                    required>
                                    <option value="">Pilih Nama Santri</option>
                                    @foreach ($santris as $santri)
                                        <option value="{{ $santri->id }}">
                                            {{ $santri->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" wire:model="laundryForm.status" required>
                                    <option value="menunggu">Menunggu</option>
                                    <option value="dicuci">Dicuci</option>
                                    <option value="gagal">Gagal</option>
                                    <option value="disetrika">Disetrika</option>
                                    <option value="siap diambil">Siap Diambil</option>
                                    <option value="diterima">Diterima</option>
                                </select>
                                @error('laundryForm.status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-2 col-lg-6 form-group">
                                <label for="santri_id" class="form-label">Layanan Laundry</label>
                                <select class="form-control" id="santri_id" wire:model="laundryForm.laundry_service_id"
                                    required>
                                    <option value="">Pilih Layanan</option>
                                    @foreach ($laundryServices as $service)
                                        <option value="{{ $service->id }}">
                                            {{ $service->name }} - {{ number_format($service->price, 0, ',', '.') }}
                                            ({{ $service->estimate }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('laundryForm.laundry_service_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2 col-lg-6">
                                <label for="quantity" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="quantity"
                                    wire:model.live="laundryForm.quantity" placeholder="1" min="1" required>
                                @error('laundryForm.quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
