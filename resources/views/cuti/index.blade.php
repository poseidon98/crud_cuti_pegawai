<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Cuti Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{ route('cuti.create') }}"
                    class="m-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    {{ __('Input Cuti Pegawai') }}
                </a>
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Mulai Cuti</th>
                            <th class="border px-4 py-2">Selesai Cuti</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- @dd($pegawai); --}}
                        @foreach ($cuti as $index => $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $item->pegawai->name . ' ' . $item->pegawai->last_name }}</td>
                                <td class="border px-4 py-2">{{ $item->pegawai->email }}</td>
                                <td class="border px-4 py-2">{{ $item->start_date }}</td>
                                <td class="border px-4 py-2">{{ $item->end_date }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('cuti.edit', $item->id) }}" class="text-blue-500">Edit</a> |
                                    <form action="{{ route('cuti.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
