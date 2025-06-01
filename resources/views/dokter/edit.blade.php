<h2>Edit Data Dokter</h2>

<form method="POST" action="{{ route('dokter.update') }}">
    @csrf
    <label>Nama:</label>
    <input type="text" name="name" value="{{ $dokter->name }}"><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ $dokter->email }}"><br>

    <label>Spesialis:</label>
    <input type="text" name="spesialis" value="{{ $dokter->spesialis }}"><br>

    <label>No Telp:</label>
    <input type="text" name="no_telp" value="{{ $dokter->no_telp }}"><br>

    <label>Alamat:</label>
    <textarea name="alamat">{{ $dokter->alamat }}</textarea><br>

    <button type="submit">Simpan</button>
</form>
