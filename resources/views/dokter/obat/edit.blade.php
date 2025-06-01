<x-app-layout>
    <x-slot name="header">
        <h1>Edit Obat</h1>
    </x-slot>

    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @include('dokter.obat.form')
    </div>
</x-app-layout>
