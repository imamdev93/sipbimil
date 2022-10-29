<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Daftar Balita</h5>
            <div class="ibox-tools">
                <a href="{{ route('admin.balita.create') }}" class="btn btn-primary btn-sm">Tambah Balita</a>
            </div>
        </div>
        <div class="ibox-content table-responsive">
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
                        <th width="5%">#</th>
                        <th width="20%">Nama Orangtua</th>
                        <th width="20%">Nama Balita</th>
                        <th width="15%">Jenis Kelamin</th>
                        <th width="20%">Tanggal Lahir</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($balita) > 0)
                    @foreach ($balita as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->orangtua->nama ?? '-' }}</td>
                        <td>{{ $row->nama ?? '-' }}</td>
                        <td>{{ $row->jenis_kelamin ?? '-' }}</td>
                        <td>{{ $row->tanggal_lahir ?? '-' }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-secondary" wire:click="show({{ $row->id }})"
                                data-toggle="modal" data-target="#show"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.balita.edit', $row->id)}}"><i
                                    class="fa fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger" wire:click="show({{ $row->id }})" data-toggle="modal"
                                data-target="#hapus"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{ $balita->links() }}
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama Orangtua</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->orangtua->nama ?? '-' : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->nama : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->jenis_kelamin : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->tanggal_lahir : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Alamat</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->alamat.' RT.'.$data->rt.' RW.'.$data->rw : '-' }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @include('admin.modal-delete')
</div>
