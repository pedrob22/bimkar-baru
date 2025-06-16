<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Pemeriksaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl space-y-6 sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                        <input type="text" value="{{ $periksa->janjiPeriksa->pasien->nama }}" disabled
                            class="w-full px-4 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label for="tgl_periksa" class="block text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                        <input type="date" name="tgl_periksa" required
                        value="{{ old('tgl_periksa', $periksa->tgl_periksa->format('Y-m-d')) }}"
                        class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm">

                    </div>

                    <div>
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Pemeriksaan</label>
                        <textarea name="catatan" required
                            class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm">{{ old('catatan', $periksa->catatan) }}</textarea>
                    </div>

                    <div>
                        <label for="obats" class="block text-sm font-medium text-gray-700">Pilih Obat</label>
                        <select name="obats[]" multiple
                            class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                            @foreach ($obats as $obat)
                                <option value="{{ $obat->id }}" {{ in_array($obat->id, $selectedObatIds) ? 'selected' : '' }}>
                                    {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-gray-500">Gunakan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu.</small>
                    </div>

                    <div>
                        <label for="biaya_periksa" class="block text-sm font-medium text-gray-700">Total Biaya Pemeriksaan</label>
                        <input type="number" name="biaya_periksa" readonly required
                            value="{{ $totalBiaya }}"
                            class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm bg-gray-100">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                            Update Pemeriksaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    const obatSelect = document.querySelector('select[name="obats[]"]');
    const biayaInput = document.querySelector('input[name="biaya_periksa"]');
    const baseBiaya = 150000;

    const hargaObatMap = {
        @foreach ($obats as $obat)
            "{{ $obat->id }}": {{ $obat->harga }},
        @endforeach
    };

    function updateBiayaPeriksa() {
        const selectedOptions = Array.from(obatSelect.selectedOptions);
        const totalHargaObat = selectedOptions.reduce((total, option) => {
            return total + (hargaObatMap[option.value] || 0);
        }, 0);

        const total = baseBiaya + totalHargaObat;
        biayaInput.value = total;
    }

    obatSelect.addEventListener('change', updateBiayaPeriksa);

    // Panggil saat awal jika sudah ada yang terpilih
    document.addEventListener('DOMContentLoaded', updateBiayaPeriksa);
</script>

    
</x-app-layout>
