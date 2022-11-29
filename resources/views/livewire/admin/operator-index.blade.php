<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Daftar Operator</h5>
            <div class="ibox-tools">
                <a href="{{ route('admin.operator.create') }}" class="btn btn-primary btn-sm">Tambah Operator</a>
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
                        <th width="20%">Nama</th>
                        <th width="20%">Username</th>
                        <th width="20%">Posyandu</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($operator) > 0)
                        @foreach ($operator as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nama ?? '-' }}</td>
                                <td>{{ $row->username ?? '-' }}</td>
                                <td>{{ $row->posyandu->nama ?? '-' }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-secondary"
                                        wire:click="show({{ $row->id }})" data-toggle="modal"
                                        data-target="#show"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('admin.operator.edit', $row->id) }}"><i
                                            class="fa fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" wire:click="show({{ $row->id }})"
                                        data-toggle="modal" data-target="#hapus"><i class="fa fa-trash"></i></button>
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
            {{ $operator->links() }}
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="show" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Operator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->nama ?? '-' : '-' }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Username</label>
                        <div class="col-lg-8 mt-2">
                            {{ $data ? $data->username : '-' }}
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
    @include('admin.modal-delete')
</div>
