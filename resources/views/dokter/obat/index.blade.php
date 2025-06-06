<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <a href="{{ route('obat.create') }}"
                       class="inline-flex items-center px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        + Tambah Obat Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Nama Obat</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Kemasan</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Harga</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $obat)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $obat->nama_obat }}</td>
                                    <td class="px-4 py-2 border">{{ $obat->kemasan }}</td>
                                    <td class="px-4 py-2 border">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('obat.edit', $obat->id) }}"
                                               class="inline-flex items-center px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('obat.destroy', $obat->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500 border">
                                        Tidak ada data obat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
