<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Pegawai Information') }}
                            </h2>

                        </header>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-500">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form method="post" action="{{ route('cuti.store') }}" class="mt-6 space-y-6">
                            @csrf


                            <div>
                                <x-input-label for="pegawai_id" :value="__('Pegawai')" />
                                <select id="pegawai_id" name="pegawai_id"
                                    class="block mt-1 w-full rounded border-gray-300 p-3" required>
                                    @foreach ($pegawai as $p)
                                        <option value="{{ $p->id }}"
                                            {{ old('pegawai_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->name . ' ' . $p->last_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('pegawai_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="keterangan" :value="__('Keterangan Cuti')" />
                                <x-text-input id="keterangan" name="keterangan" type="text" class="mt-1 block w-full"
                                    :value="old('keterangan')" required autofocus autocomplete="keterangan" />
                                <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="start_date" :value="__('Tanggal Mulai')" />
                                <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                                    value="{{ old('start_date') }}" required />
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="end_date" :value="__('Tanggal Selesai')" />
                                <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                                    value="{{ old('end_date') }}" required />
                                <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
