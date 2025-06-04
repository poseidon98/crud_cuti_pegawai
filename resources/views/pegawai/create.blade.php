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


                        <form method="post" action="{{ route('pegawai.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="last_name" :value="__('Last Name')" />
                                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                                    :value="old('last_name')" required autofocus autocomplete="last_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                            </div>


                            <div>
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select id="gender" name="gender"
                                    class="block mt-1 w-full rounded border-gray-300 p-3" required>
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="birth_date" :value="__('Birth Date')" />
                                <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"
                                    value="{{ old('birth_date') }}" required />
                                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-text-input id="phone_number" name="phone_number" type="text"
                                    class="mt-1 block w-full" :value="old('phone_number')" required autofocus
                                    autocomplete="phone_number" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email')" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
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
