<x-app-layout>
    <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Obat Baru') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @include('dokter.obat.form')
    </div>
</x-app-layout>
