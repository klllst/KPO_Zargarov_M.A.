<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($groupName) }}
        </h2>
    </x-slot>

    <div
        class="container max-w-7xl mx-auto sm:px-6 lg:px-8 py-8"
        x-data="{ activeSemester: {{ $tests->keys()->first() }} }"
    >
        <!-- Кнопки для выбора семестра -->
        <div class="flex space-x-4 mb-6">
            @foreach ($tests as $semester => $testsBySemester)
                <button
                    class="px-4 py-2 rounded"
                    :class="activeSemester === {{ $semester }}
                        ? 'bg-blue-500 text-white'
                        : 'bg-gray-200 hover:bg-blue-500 hover:text-white'"
                    x-on:click="activeSemester = {{ $semester }}">
                    {{ $semester }} семестр
                </button>
            @endforeach
        </div>

        <div>
            @foreach ($tests as $semester => $testsBySemester)
                <div
                    x-show="activeSemester === {{ $semester }}"
                    x-cloak
                    class="space-y-4"
                >
                    @foreach ($testsBySemester as $test)
                        <div
                            x-data="{ showDetails: false }"
                            class="bg-white shadow-md rounded-lg border border-gray-200 overflow-hidden cursor-pointer"
                            x-on:click="showDetails = !showDetails"
                        >
                            <div class="flex items-center justify-center px-4 py-6">
                                <h4 class="font-bold text-lg text-center">{{ $test->subject->name }}</h4>
                            </div>
                            <div
                                x-show="showDetails"
                                class="px-4 py-2 bg-gray-50 border-t border-gray-200"
                                x-cloak
                            >
                                <p class="text-lg"><strong>Тип испытания:</strong> {{ $test->type }}</p>
                                <p class="text-lg"><strong>Семестр:</strong> {{ $test->semester }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
