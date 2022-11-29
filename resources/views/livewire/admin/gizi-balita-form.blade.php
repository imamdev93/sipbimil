<div class="ibox-content">
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Nama Posyandu</label>
        <div class="col-lg-8" wire:ignore>
            <select id="posyandu_id" class="form-control select2_demo_3" wire:model="posyandu_id">
                <option value="">Pilih Salah Satu</option>
                @foreach ($posyandu as $row)
                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2">
            <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModalCenter"><i
                    class="fa fa-plus"></i></button>
            <button class="btn btn-secondary btn-md" data-toggle="modal" data-target="#lihat"><i
                    class="fa fa-eye"></i></button>
        </div>
        @error('posyandu_id')
            <label class="col-lg-2 col-form-label"></label>
            <div class="col-lg-10">
                <span class="form-text m-b-none text-danger">{{ $errors->first('posyandu_id') }}</span>
            </div>
        @enderror
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Nama Balita</label>
        <div class="col-lg-10" wire:ignore>
            <select id="balita_id" class="form-control select2_demo_3" wire:model="balita_id">
                <option value="">Pilih Salah Satu</option>
                @foreach ($balita as $row)
                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                @endforeach
            </select>
        </div>
        @error('balita_id')
            <label class="col-lg-2 col-form-label"></label>
            <div class="col-lg-10">
                <span class="form-text m-b-none text-danger">{{ $errors->first('balita_id') }}</span>
            </div>
        @enderror
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Tinggi Badan (cm)</label>
        <div class="col-lg-10">
            <input type="text" placeholder="Masukan tinggi badan balita (cm)" wire:model.lazy="tinggi_badan"
                class="form-control">
            @error('tinggi_badan')
                <span class="form-text m-b-none text-danger">{{ $errors->first('tinggi_badan') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Berat Badan (kg)</label>
        <div class="col-lg-10">
            <input type="text" placeholder="Masukan berat badan balita (kg)" wire:model.lazy="berat_badan"
                class="form-control">
            @error('berat_badan')
                <span class="form-text m-b-none text-danger">{{ $errors->first('berat_badan') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Tanggal Pengukuran</label>
        <div class="col-lg-10">
            <input type="date" placeholder="Masukan Nama Balita" wire:model.lazy="tanggal_pengukuran"
                class="form-control">
            @error('tanggal_pengukuran')
                <span class="form-text m-b-none text-danger">{{ $errors->first('tanggal_pengukuran') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-offset-2 col-lg-10">
            <a href="{{ route('admin.balita.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            <button class="btn btn-sm btn-primary"
                wire:click="{{ $action }}">{{ $action == 'store' ? 'Simpan' : 'Ubah' }}</button>
        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Posyandu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Nama</label>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Masukan Nama Posyandu" wire:model.lazy="nama_posyandu"
                            class="form-control">
                        @error('nama_posyandu')
                            <span class="form-text m-b-none text-danger">{{ $errors->first('nama_posyandu') }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:click="storePosyandu">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="lihat" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Posyandu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Posyandu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posyandu as $data)
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td>
                                    <a wire:click="deletePosyandu({{ $data->id }})" href="#"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#balita_id').change(function() {
            @this.set('balita_id', $(this).val())
        })

        $('#posyandu_id').change(function() {
            @this.set('posyandu_id', $(this).val())
        })
    </script>
@endpush
