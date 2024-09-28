<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button wire:click="create()" type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#default">
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
                                        <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#default"
                                            class="btn btn-sm btn-warning">Edit</button>
                                        <button wire:confirm="Yakin ingin menghapus data {{ $item->nama }}" wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger">Delete</button>
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
</div>
