<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Form Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl space-y-6 sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('dokter.periksa.simpan', $janji->id) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                        <input type="text" value="{{ $janji->pasien->nama }}" disabled
                               class="w-full px-4 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keluhan</label>
                        <textarea disabled
                                  class="w-full px-4 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none">{{ $janji->keluhan }}</textarea>
                    </div>

                    <div>
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Pemeriksaan</label>
                        <textarea name="catatan" required
                                  class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"></textarea>
                    </div>

                    <div>
                        <label for="biaya_obat" class="block text-sm font-medium text-gray-700">Biaya Obat</label>
                        <input type="number" name="biaya_obat" required
                               class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
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
</x-app-layout>
