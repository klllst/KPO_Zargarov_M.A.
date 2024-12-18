<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактирование пользователя') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('users.update', [$user]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="first_name" :value="__('Имя')" />
                            <x-text-input id="first_name" name="first_name" type="text" :value="$user->userable->first_name" class="mt-1 block w-full"/>
                        </div>

                        <div>
                            <x-input-label for="last_name" :value="__('Фамилия')" />
                            <x-text-input id="last_name" name="last_name" type="text" :value="$user->userable->last_name" class="mt-1 block w-full"/>
                        </div>

                        <div>
                            <x-input-label for="middle_name" :value="__('Отчество')" />
                            <x-text-input id="middle_name" name="middle_name" type="text" :value="$user->userable->middle_name" class="mt-1 block w-full"/>
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Эл. почта')" />
                            <x-text-input id="email" name="email" type="text" :value="$user->email" class="mt-1 block w-full"/>
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Пароль')" />
                            <x-text-input id="password" name="password" type="text" class="mt-1 block w-full"/>
                        </div>

                        <div>
                            <x-input-label for="birthday" :value="__('Дата рождения')" />
                            <x-text-input id="birthday" name="birthday" type="date" :value="$user->userable->birthday" class="mt-1 block w-full"/>
                        </div>

                        <div x-data="{ showGroupSelect: '{{ $user->type->value === 'Студент' ? 'true' : 'false' }}' === 'true' }">
                            <div>
                                <x-input-label for="type" :value="('Тип пользователя')" />
                                <select
                                    id="type"
                                    name="type"
                                    x-on:change="showGroupSelect = $event.target.value === 'Студент'"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    @foreach (App\Enums\UserType::getCreateTypes() as $value)
                                        <option value="{{ $value->value }}" @if ($user->type->value === $value->value) selected @endif>
                                            {{ $value->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div x-show="showGroupSelect" class="mt-4">
                                <x-input-label for="group_id" :value="('Группа')" />
                                <select id="group_id" name="group_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="" disabled selected>Выберите группу</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" @if ($user->userable?->group_id === $group->id) selected @endif>
                                            {{ $group->groupName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
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
