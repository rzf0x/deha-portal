<section>
    @if (session()->has('success'))
        <div class="d-flex justify-content-end">
            <div wire:poll class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="d-flex justify-content-between w-100">
                    <div class="mb-2 mb-sm-0">
                        <h5 class="card-title fs-5 mb-0">Daftar Service Laundry</h5>
                    </div>

                    <button wire:click='createService' data-bs-toggle="modal" data-bs-target="#createOrUpdateService"
                        class="btn btn-primary">Tambah service +</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Estimate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->listLaundryService() as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->unit }}</td>
                                <td>{{ $service->estimate }}</td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#createOrUpdateService"
                                        wire:click='editService("{{ $service->id }}")'
                                        class="btn btn-info">Edit</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        wire:click='deleteService("{{ $service->id }}")'
                                        wire:confirm='Yakin mau menghapus {{ $service->name }}'
                                        data-bs-target="#deleteService" class="btn btn-info">Delete</button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetail"
                                        wire:click='detailLaundryService("{{ $service->id }}")'
                                        class="btn btn-info">Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <p class="m-0">Service tidak tersedia!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $this->listLaundryService()->links() }}
            </div>
        </div>
    </div>

    {{-- Modal Detail Laundry --}}
    <div class="modal fade" wire:ignore.self id="orderDetail" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <h6>Informasi Service</h6>
                        <p class="mb-1">Nama: {{ $detailService?->name }}</p>
                        <div class="d-flex gap-1">
                            <p class="mb-1">Deskrpsi: </p>
                            <p class="mb-1">{{ $detailService?->description }}</p>
                        </div>
                        <p class="mb-1">Harga: Rp. {{ $detailService?->price }}</p>
                        <p class="mb-1">Estimasi Pengerjaan: {{ $detailService?->estimate }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create & Edit Laundry Service --}}
    <div class="modal fade" wire:ignore.self id="createOrUpdateService" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $serviceId ? 'Edit Service' : 'Service Baru' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                @if (session()->has('error'))
                    <div wire:poll class="d-flex w-100">
                        <div class="alert alert-danger w-100">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <form wire:submit.prevent='{{ $serviceId ? 'updateLaundryService' : 'createLaundryService' }}'>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" wire:model="serviceForm.name"
                                placeholder="Express Ramadhan" required>
                            @error('serviceForm.name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" placeholder="Tentang service" wire:model="serviceForm.description"
                                required></textarea>
                            @error('serviceForm.description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-2">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="price" wire:model="serviceForm.price"
                                    placeholder="20000" step="0.01" required>
                                @error('serviceForm.price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="form-group">
                                    <label for="unit" class="form-label">Unit</label>
                                    <select class="form-control" id="unit" wire:model="serviceForm.unit" required
                                        name="" id="">
                                        <option value="Kg">Kg</option>
                                        <option value="Pcs">Pcs</option>
                                    </select>
                                </div>
                                @error('serviceForm.unit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-2">
                                <label for="estimate" class="form-label">Estimasi Pengerjaan</label>
                                <input type="text" class="form-control" id="estimate"
                                    wire:model="serviceForm.estimate" placeholder="3 Hari" required>
                                @error('serviceForm.estimate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"
                            class="btn {{ $serviceId ? 'btn-warning' : 'btn-primary' }}">{{ $serviceId ? 'Update' : 'Tambah' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
