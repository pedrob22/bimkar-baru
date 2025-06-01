<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Obat
        </h2>
    </x-slot>

    <div class="container mt-4">
        <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">Tambah Obat Baru</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Kemasan</th>
                    <th>Harga</th>
                    <!-- <th>Dosis</th>
                    <th>Aturan Pakai</th>
                    <th>Efek Samping</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obats as $obat)
                <tr>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kemasan }}</td>
                    <td>{{ $obat->harga }}</td>
                    <!-- <td>{{ $obat->dosis }}</td>
                    <td>{{ $obat->aturan_pakai }}</td>
                    <td>{{ $obat->efek_samping }}</td> -->
                    <td>
                        <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>