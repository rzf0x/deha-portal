<div>
    @if (session()->has('message'))
    <div class="d-flex justify-content-end">
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)"
            class="alert alert-success w-25">
            {{ session('message') }}
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button wire:click="create()" type="button" class="btn btn-primary block" data-bs-toggle="modal"
                    data-bs-target="#default">
                    <i class="bi bi-plus-circle"></i>
                    <span class="ms-1">Tambah Data</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Biaya</th>
                            <th>Nominal Biaya</th>
                            <th>Jenjang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->getData as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        Rp. {{ number_format($item->nominal, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $item->jenjang->nama }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal"
                                            data-bs-target="#default" class="btn btn-sm btn-warning">Edit</button>
                                        <button wire:confirm="Yakin ingin menghapus data {{ $item->nama }}"
                                            wire:click="delete({{ $item->id }})"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data yang di tampilkan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header {{ $itemPembayaranId ? 'bg-warning' : 'bg-primary' }}">
                    <h5 class="modal-title {{ $itemPembayaranId ? 'text-dark' : 'text-white' }}">
                        {{ $itemPembayaranId ? 'Edit Item Pembayaran' : 'Tambah Item Pembayaran' }}</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" wire:model="ItemPembayaranForm.nama" required
                                    id="nama" placeholder="Enter Nama">
                                @error('ItemPembayaranForm.nama')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="">
                                <label for="nominal">Nominal</label>
                                <input type="number" class="form-control" wire:model="ItemPembayaranForm.nominal" required
                                    id="nominal" placeholder="Enter Nominal">
                                @error('ItemPembayaranForm.nominal')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="">
                                <label for="jenjang">Jenjang</label>
                                <select class="form-select" wire:model="ItemPembayaranForm.jenjang_id" required>
                                    <option value='' selected>-- Jenjang --</option>
                                    @foreach ($this->getAllJenjang() as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $ItemPembayaranForm->jenjang_id ? 'selected' : '' }}>
                                        {{ $item->nama }} 
                                    </option>
                                    @endforeach
                                </select>
                                @error('ItemPembayaranForm.jenjang_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal"
                        wire:click.prevent="store()">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">
                            {{ $itemPembayaranId ? 'Update Data' : 'Tambah Data' }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
