<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Form Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl space-y-6 sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('dokter.periksa.simpan', $janjiPeriksa->id) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                        <input type="text" value="{{ $janjiPeriksa->pasien->nama }}" disabled
                               class="w-full px-4 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="tgl_periksa" class="block text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                            <input type="date" name="tgl_periksa" required
                                   value="{{ old('tgl_periksa', now()->toDateString()) }}"
                                   class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keluhan</label>
                        <textarea disabled
                                  class="w-full px-4 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm">{{ $janjiPeriksa->keluhan }}</textarea>
                    </div>

                    <div>
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Pemeriksaan</label>
                        <textarea name="catatan" required
                                  class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm">{{ old('catatan') }}</textarea>
                    </div>

                    <div>
                        <label for="obats" class="block text-sm font-medium text-gray-700">Pilih Obat</label>
                        <select name="obats[]" multiple onchange="hitungBiayaPeriksa()"
                                id="obatSelect"
                                class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                            @foreach ($obats as $obat)
                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                    {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-gray-500">Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu.</small>
                    </div>

                    <div>
                        <label for="biaya_periksa" class="block text-sm font-medium text-gray-700">Total Biaya Pemeriksaan</label>
                        <input type="number" id="biayaPeriksa" name="biaya_periksa" readonly required
                               value="150000"
                               class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                            Simpan Pemeriksaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function hitungBiayaPeriksa() {
            const biayaDasar = 150000;
            let totalObat = 0;

            const select = document.getElementById('obatSelect');
            const selectedOptions = Array.from(select.selectedOptions);

            selectedOptions.forEach(option => {
                totalObat += parseInt(option.dataset.harga);
            });

            const total = biayaDasar + totalObat;
            document.getElementById('biayaPeriksa').value = total;
        }
    </script>
</x-app-layout>
