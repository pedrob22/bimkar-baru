@php
    $isEdit = isset($obat);
@endphp

<form action="{{ $isEdit ? route('obat.update', $obat->id) : route('obat.store') }}" method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nama_obat" class="form-label">Nama Obat</label>
        <input type="text" name="nama_obat" id="nama_obat" class="form-control" 
            value="{{ old('nama_obat', $isEdit ? $obat->nama_obat : '') }}" required>
    </div>

    <div class="mb-3">
        <label for="kemasan" class="form-label">Kemasan</label>
        <input type="text" name="kemasan" id="kemasan" class="form-control" 
            value="{{ old('kemasan', $isEdit ? $obat->kemasan : '') }}" required>
    </div>

    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control" 
            value="{{ old('harga', $isEdit ? $obat->harga : '') }}" required>
    </div>

    <!-- <div class="mb-3">
        <label for="dosis" class="form-label">Dosis</label>
        <input type="text" name="dosis" id="dosis" class="form-control" 
            value="{{ old('dosis', $isEdit ? $obat->dosis : '') }}">
    </div>

    <div class="mb-3">
        <label for="aturan_pakai" class="form-label">Aturan Pakai</label>
        <input type="text" name="aturan_pakai" id="aturan_pakai" class="form-control" 
            value="{{ old('aturan_pakai', $isEdit ? $obat->aturan_pakai : '') }}">
    </div>

    <div class="mb-3">
        <label for="efek_samping" class="form-label">Efek Samping</label>
        <textarea name="efek_samping" id="efek_samping" class="form-control">{{ old('efek_samping', $isEdit ? $obat->efek_samping : '') }}</textarea>
    </div> -->

    <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Perbarui' : 'Simpan' }}</button>
    <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
</form>
