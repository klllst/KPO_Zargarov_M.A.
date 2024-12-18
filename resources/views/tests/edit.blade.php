<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание испытания') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('tests.update', [$test]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <x-input-label for="group_id" :value="('Группа')" />
                            <select id="group_id" name="group_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="" disabled selected>Выберите группу</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" @if ($test->group_id === $group->id) selected @endif>
                                        {{ $group->groupName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="subject_id" :value="('Предмет')" />
                            <select id="subject_id" name="subject_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="" disabled selected>Выберите предмет</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if ($test->subject_id === $subject->id) selected @endif>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="type" :value="('Тип испытания')" />
                            <select
                                id="type"
                                name="type"
                                x-data
                                x-on:change="$dispatch('type-changed', $el.value)"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach (App\Enums\TestType::cases() as $value)
                                    <option value="{{ $value }}" @if ($test->type === $value) selected @endif>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="semester" :value="__('Семестр')" />
                            <x-text-input id="semester" name="semester" type="text" class="mt-1 block w-full" value="{{ $test->semester }}"/>
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
