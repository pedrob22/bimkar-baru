<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Pemeriksaan') }}
                            
                            @if ($jadwalPeriksa)
                                <p class="mb-4 text-sm text-gray-600">
                                    Jadwal Aktif: <strong>{{ $jadwalPeriksa->hari }}</strong>
                                    ({{ $jadwalPeriksa->jam_mulai }} - {{ $jadwalPeriksa->jam_selesai }})
                                </p>
                            @else
                                <p class="mb-4 text-sm text-red-600">
                                    Tidak ada jadwal aktif untuk saat ini.
                                </p>
                            @endif
                        </h2>
                    </header>

                    @if(session('success'))
                        <div class="p-2 mb-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white divide-y divide-gray-200 rounded shadow">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jadwal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Antrian</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @forelse ($janjiPeriksas as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->pasien->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $item->jadwalPeriksa->hari }} -
                                        {{ $item->jadwalPeriksa->jam_mulai }} s/d
                                        {{ $item->jadwalPeriksa->jam_selesai }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->keluhan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->no_antrian }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->periksa)
                                            <a href="{{ route('dokter.periksa.edit', $item->periksa->id) }}"
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                                Edit Pemeriksaan
                                            </a>
                                        @else
                                            <a href="{{ route('dokter.periksa.form', $item->id) }}"
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                                Periksa
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
