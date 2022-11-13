<div class="ibox-content">
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Nama Orang Tua</label>
        <div class="col-lg-8" wire:ignore>
            <select id="user_id" class="form-control select2_demo_3" wire:model="user_id">
                <option value="">Pilih Salah Satu</option>
                @foreach ($orangtua as $row)
                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Tambah
                Ortu</button>
        </div>
        @error('user_id')
        <label class="col-lg-2 col-form-label"></label>
        <div class="col-lg-10">
            <span class="form-text m-b-none text-danger">{{ $errors->first('user_id') }}</span>
        </div>
        @enderror
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Nama Balita</label>
        <div class="col-lg-10">
            <input type="text" placeholder="Masukan Nama Balita" wire:model.lazy="nama" class="form-control">
            @error('nama')
            <span class="form-text m-b-none text-danger">{{ $errors->first('nama') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Jenis Kelamin</label>
        <div class="col-lg-10">
            <select class="form-control" wire:model="jenis_kelamin">
                <option value="">Pilih Salah Satu</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            @error('jenis_kelamin')
            <span class="form-text m-b-none text-danger">{{ $errors->first('jenis_kelamin') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Tanggal Lahir</label>
        <div class="col-lg-10">
            <input type="date" placeholder="Masukan Nama Balita" wire:model.lazy="tanggal_lahir" class="form-control">
            @error('tanggal_lahir')
            <span class="form-text m-b-none text-danger">{{ $errors->first('tanggal_lahir') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Alamat</label>
        <div class="col-lg-10">
            <textarea type="text" placeholder="Masukan Alamat" wire:model.lazy="alamat" class="form-control"></textarea>
            @error('alamat')
            <span class="form-text m-b-none text-danger">{{ $errors->first('alamat') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">RT</label>
        <div class="col-lg-4">
            <input type="text" placeholder="Masukan RT" wire:model.lazy="rt" class="form-control">
            @error('rt')
            <span class="form-text m-b-none text-danger">{{ $errors->first('rt') }}</span>
            @enderror
        </div>
        <label class="col-lg-2 col-form-label">RW</label>
        <div class="col-lg-4">
            <input type="text" placeholder="Masukan RW" wire:model.lazy="rw" class="form-control">
            @error('rw')
            <span class="form-text m-b-none text-danger">{{ $errors->first('rw') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-offset-2 col-lg-10">
            <a href="{{ route('admin.balita.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            <button class="btn btn-sm btn-primary"
                wire:click="{{ $action }}">{{ $action=='store' ? 'Simpan' : 'Ubah' }}</button>
        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Orang Tua</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Nama</label>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Masukan Nama" wire:model.lazy="nama_ortu" class="form-control">
                        @error('nama_ortu')
                        <span class="form-text m-b-none text-danger">{{ $errors->first('nama_ortu') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Masukan Username" wire:model.lazy="username"
                            class="form-control">
                        @error('username')
                        <span class="form-text m-b-none text-danger">{{ $errors->first('username') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-12 col-form-label text-warning">Ket : Password sama dengan username</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:click="storeOrtu">Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $('#user_id').change(function () {
        @this.set('user_id', $(this).val())
    })

</script>
@endpush
