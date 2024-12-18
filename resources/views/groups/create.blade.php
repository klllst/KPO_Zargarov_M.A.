<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание группы') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('groups.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <div>
                            <x-input-label for="name" :value="__('Название')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"/>
                        </div>

                        <div>
                            <x-input-label for="course" :value="__('Курс')" />
                            <x-text-input id="course" name="course" type="text" class="mt-1 block w-full"/>
                        </div>

                        <div>
                            <x-input-label for="number" :value="__('Номер группы')" />
                            <x-text-input id="number" name="number" type="text" class="mt-1 block w-full"/>
                        </div>

                        <div x-show="showGroupSelect" class="mt-4">
                            <x-input-label for="faculty_id" :value="('Факультет')" />
                            <select id="faculty_id" name="faculty_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="" disabled selected>Выберите факультет</option>
                                @foreach ($faculties as $faculty)
                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
