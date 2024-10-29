<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-4">
            <div class="filter-option align-items-center d-flex gap-3">
                <div class="form-group search rounded-3">
                    <input id="search" class="bg-transparent border form-control" style="border: none; outline: none;"
                        type="text" wire:model.live='search' placeholder="Car nama santri...">
                </div>
                <div class="form-group">
                    <select id="kelas" class="form-select" wire:model.live="kelasFilter">
                        <option value="">Kelas</option>
                        @foreach ($kelas as $kelasFilter)
                            <option value="{{ $kelasFilter->nama }}">{{ $kelasFilter->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select id="jenjang" class="form-select" wire:model.live="jenjangFilter">
                        <option value="">Jenjang</option>
                        @foreach ($jenjang as $jenjangFilter)
                            <option value="{{ $jenjangFilter->nama }}">{{ $jenjangFilter->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select id="kamar" class="form-select" wire:model.live="kamarFilter">
                        <option value="">Kamar</option>
                        @foreach ($kamar as $kamarFilter)
                            <option value="{{ $kamarFilter->nama }}">{{ $kamarFilter->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select id="jenis_kelamin" class="form-select" wire:model.live="jenisKelaminFilter">
                        <option value="">Jenis Kelamin</option>
                        <option value="putera">Laki-laki</option>
                        <option value="puteri">Perempuan</option>
                    </select>
                </div>
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
                        <th>Aksi</th>
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
                                    {{-- parsing santri_id of wali santri on edit url params --}}
                                    <a href="{{ route('admin.master-santri.santri') }}?wali={{ $item->santri_id }}"
                                        class="btn btn-sm btn-warning" wire:navigate>
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>
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
