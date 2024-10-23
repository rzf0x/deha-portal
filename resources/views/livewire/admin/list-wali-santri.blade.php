<div class="card">
    <div class="card-body">
        <div class="filter-option d-flex mb-4">
            <div style="background-color: #fafafa;" class="search px-4 border border-2 py-2 rounded-5">
                <input class="bg-transparent" style="border: none; outline: none;" type="text"
                    wire:model.live='search' placeholder="Cari wali...">
                <a href="#" class="search_icon"><i class="fa fa-search" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama Santri</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas</th>
                        <th>Jenjang</th>
                        <th>Kamar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->getData as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->santri->nama }}</td>
                            <td>{{ $item->nama_ayah }}</td>
                            <td>{{ $item->nama_ibu }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $item->santri->jenis_kelamin == 'putera' ? 'laki-laki' : 'perempuan' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $item->santri->kelas?->nama }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $item->santri->kelas?->jenjang?->nama }}
                                </span>
                            </td>
                            <td>
                                <span class="badge text-black bg-warning">
                                    {{ $item->santri->kamar?->nama }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.master-santri.santri') }}" wire:navigate
                                        wire:click="edit({{ $item->santri_id}})" data-bs-toggle="modal"
                                        data-bs-target="#default" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit</a>
                                    <button wire:confirm="Yakin ingin menghapus data {{ $item->nama }}"
                                        wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash-fill"></i>
                                        Delete</button>
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
            {{ $this->getData->links() }}
        </div>
    </div>
</div>
