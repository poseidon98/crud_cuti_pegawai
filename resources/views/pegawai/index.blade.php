<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{ route('pegawai.create') }}"
                    class="m-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    {{ __('Tambah Pegawai') }}
                </a>
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Jenis Kelamin</th>
                            <th class="border px-4 py-2">Tanggal Lahir</th>
                            <th class="border px-4 py-2">No Telepon</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- @dd($pegawai); --}}
                        @foreach ($pegawai as $p)
                            <tr>
                                <td class="border px-4 py-2">{{ $p->name . ' ' . $p->last_name }}</td>
                                <td class="border px-4 py-2">{{ $p->gender }}</td>
                                <td class="border px-4 py-2">{{ $p->birth_date }}</td>
                                <td class="border px-4 py-2">{{ $p->phone_number }}</td>
                                <td class="border px-4 py-2">{{ $p->email }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('pegawai.edit', $p->id) }}" class="text-blue-500">Edit</a> |
                                    <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST"
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
