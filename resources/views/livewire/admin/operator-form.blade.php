<div class="ibox-content">
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Nama Posyandu</label>
        <div class="col-lg-10" wire:ignore>
            <select id="posyandu_id" class="form-control select2_demo_3" wire:model="posyandu_id">
                <option value="">Pilih Salah Satu</option>
                @foreach ($posyandu as $row)
                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                @endforeach
            </select>
        </div>
        @error('posyandu_id')
            <label class="col-lg-2 col-form-label"></label>
            <div class="col-lg-10">
                <span class="form-text m-b-none text-danger">{{ $errors->first('posyandu_id') }}</span>
            </div>
        @enderror
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Nama</label>
        <div class="col-lg-10">
            <input type="text" placeholder="" wire:model.lazy="nama" class="form-control">
            @error('nama')
                <span class="form-text m-b-none text-danger">{{ $errors->first('nama') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Username</label>
        <div class="col-lg-10">
            <input type="text" placeholder="" wire:model.lazy="username" class="form-control">
            @error('username')
                <span class="form-text m-b-none text-danger">{{ $errors->first('username') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Password</label>
        <div class="col-lg-10">
            <input type="password" placeholder="" wire:model.lazy="password" class="form-control">
            @error('password')
                <span class="form-text m-b-none text-danger">{{ $errors->first('password') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label">Konfirmasi Password</label>
        <div class="col-lg-10">
            <input type="password" placeholder="" wire:model.lazy="password_confirmation" class="form-control">
            @error('password_confirmation')
                <span class="form-text m-b-none text-danger">{{ $errors->first('password_confirmation') }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-offset-2 col-lg-10">
            <a href="{{ route('admin.ibu-hamil.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            <button class="btn btn-sm btn-primary"
                wire:click="{{ $action }}">{{ $action == 'store' ? 'Simpan' : 'Ubah' }}</button>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#posyandu_id').change(function() {
            @this.set('posyandu_id', $(this).val())
        })
    </script>
@endpush
