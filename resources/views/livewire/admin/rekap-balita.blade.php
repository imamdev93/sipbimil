<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Rekap Gizi Balita</h5>
            <div class="ibox-tools">
                <a href="#" wire:click="export" class="btn btn-primary btn-sm">Export Laporan</a>
                {{-- <a href="{{ route('admin.gizi-ibu-hamil.create') }}" class="btn btn-primary btn-sm">Tambah Data</a> --}}
            </div>
        </div>
        <div class="ibox-content table-responsive">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select wire:model="status" class="form-control">
                        <option value="">Pilih Status</option>
                        <option value="Sangat Kurus">Sangat Kurus</option>
                        <option value="Kurus">Kurus</option>
                        <option value="Normal">Normal</option>
                        <option value="Gemuk">Gemuk</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select wire:model="posyandu_id" class="form-control">
                        <option value="">Semua Posyandu</option>
                        @foreach ($posyandu as $val)
                            <option value="{{ $val->id }}">{{ $val->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select wire:model="bulan" class="form-control">
                        <option value="">Semua Bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">Nopember</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col-md-1">
                    <select class="form-control" wire:model="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" wire:model.debounce.500ms="search" placeholder="cari">
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="15%">Nama</th>
                        <th width="15%">Posyandu</th>
                        <th width="15%">Tinggi Badan (CM)</th>
                        <th width="15%">Berat Badan (KG)</th>
                        <th width="20%">Tanggal Pengukuran</th>
                        <th width="10%">Status</th>
                        <th width="10%">Hasil</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($bumil) > 0)
                        @foreach ($bumil as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->balita->nama ?? '-' }}</td>
                                <td>{{ $row->posyandu->nama ?? '-' }}</td>
                                <td>{{ $row->tinggi_badan ?? '-' }}</td>
                                <td>{{ $row->berat_badan ?? '-' }}</td>
                                <td>{{ $row->tanggal_pengukuran ?? '-' }}</td>
                                <td>{{ $row->status ?? '-' }}</td>
                                <td>{{ $row->hasil ?? '-' }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-secondary"
                                        wire:click="show({{ $row->id }})" data-toggle="modal"
                                        data-target="#show"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $bumil->links() }}
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="show" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Ibu Hamil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->balita->nama ?? '-' : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Tinggi Badan (cm)</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->tinggi_badan : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Berat Badan (kg)</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->berat_badan : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Status</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->status : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Tanggal Pengukuran</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->tanggal_pengukuran : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Posyandu</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->posyandu->nama : '-' }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
