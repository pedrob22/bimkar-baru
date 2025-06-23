<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!ssasas") }}
                </div>
                @if ($blmriwayat->isNotEmpty())
                    {{-- Riwayat Daftar Poli (Belum Diperiksa) --}}
                    <div x-data="{
                        modalOpen: false,
                        modalData: {},
                        formatDate(date) {
                            if (!date) return '-';
                            return new Date(date).toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            });
                        },
                        formatCurrency(num) {
                            if (!num) return '-';
                            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
                        }
                    }" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Janji Periksa Belum Diperiksa</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                                    <tr>
                                        <th class="px-4 py-2">No.</th>
                                        <th class="px-4 py-2">No. RM</th>
                                        <th class="px-4 py-2">Poli</th>
                                        <th class="px-4 py-2">Dokter</th>
                                        <th class="px-4 py-2">Hari</th>
                                        <th class="px-4 py-2">Mulai</th>
                                        <th class="px-4 py-2">Selesai</th>
                                        <th class="px-4 py-2">Antrian</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blmriwayat as $i => $item)
                                        @php
                                            $modalData = [
                                                'nama_poli' => $item->jadwalPeriksa->dokter->poli ?? '-',
                                                'nama_dokter' => $item->jadwalPeriksa->dokter->nama ?? '-',
                                                'hari' => $item->jadwalPeriksa->hari ?? '-',
                                                'mulai' => $item->jadwalPeriksa->jam_mulai ?? '-',
                                                'selesai' => $item->jadwalPeriksa->jam_selesai ?? '-',
                                                'nomor_antrian' => $item->no_antrian ?? '-',
                                                // Karena belum diperiksa, data periksa dikosongkan atau tanda '-'
                                                'tanggal_periksa' => '-',
                                                'diagnosa' => '-',
                                                'tindakan' => '-',
                                                'catatan' => '-',
                                                'biaya_periksa' => 0,
                                                'obats' => [],
                                            ];
                                        @endphp
                                        <tr class="border-b border-gray-200 dark:border-gray-600">
                                            <td class="px-4 py-2">{{ $i + 1 }}</td>
                                            <td class="px-4 py-2">{{ $item->pasien->no_rekam_medis ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $item->jadwalPeriksa->dokter->poli ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $item->jadwalPeriksa->dokter->nama ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $item->jadwalPeriksa->hari ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $item->jadwalPeriksa->jam_mulai ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $item->jadwalPeriksa->jam_selesai ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $item->no_antrian ?? '-' }}</td>
                                            <td class="px-4 py-2">
                                                <span class="text-red-600 font-semibold">Belum Diperiksa</span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <button
                                                    @click="modalData = {{ json_encode($modalData) }}; modalOpen = true"
                                                    class="text-blue-600 hover:underline">Detail</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Modal --}}
                        <div x-show="modalOpen"
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                            style="display: none;"
                            @click.self="modalOpen = false"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0">

                            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 relative max-h-[80vh] overflow-auto"
                                x-transition:enter="transition transform duration-300"
                                x-transition:enter-start="scale-90 opacity-0"
                                x-transition:enter-end="scale-100 opacity-100"
                                x-transition:leave="transition transform duration-200"
                                x-transition:leave-start="scale-100 opacity-100"
                                x-transition:leave-end="scale-90 opacity-0">

                                <button @click="modalOpen = false"
                                    class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 focus:outline-none text-xl font-bold">&times;</button>

                                <h3 class="text-xl font-semibold mb-4 text-center">Detail Jadwal Poli</h3>

                                <table class="min-w-full divide-y divide-gray-200 text-sm">
                                    <tbody class="divide-y divide-gray-200">
                                        <tr class="bg-white">
                                            <td class="px-6 py-3 font-medium text-gray-600 w-40">Nama Poli</td>
                                            <td class="px-6 py-3" x-text="modalData.nama_poli"></td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-3 font-medium text-gray-600">Nama Dokter</td>
                                            <td class="px-6 py-3" x-text="modalData.nama_dokter"></td>
                                        </tr>

                                        <tr class="bg-white">
                                            <td class="px-6 py-3 font-medium text-gray-600">Hari</td>
                                            <td class="px-6 py-3" x-text="modalData.hari"></td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-3 font-medium text-gray-600">Mulai</td>
                                            <td class="px-6 py-3" x-text="modalData.mulai"></td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td class="px-6 py-3 font-medium text-gray-600">Selesai</td>
                                            <td class="px-6 py-3" x-text="modalData.selesai"></td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-3 font-medium text-gray-600">Nomor Antrian</td>
                                            <td class="px-6 py-3" x-text="modalData.nomor_antrian"></td>
                                        </tr>

                                        {{-- Karena belum diperiksa, tampilkan info kosong --}}
                                        <tr>
                                            <td colspan="2" class="px-6 py-4 bg-gray-100 text-center font-semibold text-lg">Belum Diperiksa</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                @else
                    {{-- Pesan jika belum ada janji periksa yang belum diperiksa --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center text-gray-600 dark:text-gray-300">
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-100">Janji Periksa</h3>
                        <div class="flex flex-col items-center justify-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Belum ada janji periksa yang belum diperiksa.</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
