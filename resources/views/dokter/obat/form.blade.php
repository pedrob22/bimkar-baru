@php
    $isEdit = isset($obat);
@endphp
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                <form action="{{ $isEdit ? route('obat.update', $obat->id) : route('obat.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div>
                        <label for="nama_obat" class="block text-sm font-medium text-gray-700">Nama Obat</label>
                        <input type="text" name="nama_obat" id="nama_obat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                               value="{{ old('nama_obat', $isEdit ? $obat->nama_obat : '') }}" required>
                    </div>

                    <div>
                        <label for="kemasan" class="block text-sm font-medium text-gray-700">Kemasan</label>
                        <input type="text" name="kemasan" id="kemasan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                               value="{{ old('kemasan', $isEdit ? $obat->kemasan : '') }}" required>
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" name="harga" id="harga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                               value="{{ old('harga', $isEdit ? $obat->harga : '') }}" required>
                    </div>

                    {{-- Uncomment bagian berikut bila fitur-fitur tambahan diaktifkan di masa depan --}}
                    {{-- 
                    <div>
                        <label for="dosis" class="block text-sm font-medium text-gray-700">Dosis</label>
                        <input type="text" name="dosis" id="dosis" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                               value="{{ old('dosis', $isEdit ? $obat->dosis : '') }}">
                    </div>

                    <div>
                        <label for="aturan_pakai" class="block text-sm font-medium text-gray-700">Aturan Pakai</label>
                        <input type="text" name="aturan_pakai" id="aturan_pakai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                               value="{{ old('aturan_pakai', $isEdit ? $obat->aturan_pakai : '') }}">
                    </div>

                    <div>
                        <label for="efek_samping" class="block text-sm font-medium text-gray-700">Efek Samping</label>
                        <textarea name="efek_samping" id="efek_samping" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">{{ old('efek_samping', $isEdit ? $obat->efek_samping : '') }}</textarea>
                    </div>
                    --}}

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            {{ $isEdit ? 'Perbarui' : 'Simpan' }}
                        </button>
                        <a href="{{ route('obat.index') }}"
                           class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

