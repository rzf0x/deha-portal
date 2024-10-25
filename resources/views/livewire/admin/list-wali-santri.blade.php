<div class="card">
    <div class="card-body">
        <div class="filter-option d-flex mb-4">
            <div class="form search px-4 border border-2 py-2 rounded-3">
                <input class="bg-transparent" style="border: none; outline: none;" type="text" wire:model.live='search'
                    placeholder="Cari wali...">
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
                                    {{-- parse santri_id of wali santri on edit url params --}}
                                    <a href="{{ route('admin.master-santri.santri') }}?wali={{ $item->santri_id }}"
                                        class="btn btn-sm btn-warning" wire:navigate>
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $item->id }}, '{{ $item->nama }}')"
                                        class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                {{ $search ? 'Data tidak ditemukan!' : 'Tidak ada data yang di tampilkan' }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $this->getData->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Yakin ingin menghapus data ' + name + '?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('delete', {
                    santriId: id
                });
                Swal.fire(
                    'Terhapus!',
                    'Data berhasil dihapus.',
                    'success'
                )
            }
        })
    }
</script>
