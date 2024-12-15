<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Испытания студента') }}
        </h2>
    </x-slot>

    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8 py-8" x-data="{ activeSemester: null }">
        <div class="flex space-x-4 mb-6">
            @foreach ($testsBySemester as $semester => $tests)
                <button
                    class="px-4 py-2 rounded {{ $loop->first ? 'bg-blue-500 text-white' : 'bg-gray-200' }} hover:bg-blue-500 hover:text-white"
                    :class="activeSemester === {{ $semester }} ? 'bg-blue-500 text-white' : ''"
                    x-on:click="activeSemester = {{ $semester }}">
                    {{ $semester }} семестр
                </button>
            @endforeach
        </div>

        <!-- Список испытаний -->
        <div>
            @foreach ($testsBySemester as $semester => $tests)
                <div x-show="activeSemester === {{ $semester }}">
                    <h3 class="text-lg font-semibold mb-4">Испытания семестра {{ $semester }}</h3>
                    <ul>
                        @foreach ($tests as $test)
                            <li x-data="{ showDetails: false }" class="mb-4">
                                <div class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded">
                                    <span>{{ $test->subject->name }}</span>
                                    <button
                                        class="text-blue-500 hover:underline"
                                        x-on:click="showDetails = !showDetails">
                                        Подробнее
                                    </button>
                                </div>
                                <!-- Детали испытания -->
                                <div x-show="showDetails" class="mt-2 px-4 py-2 bg-gray-50 border border-gray-200 rounded">
                                    <p><strong>Тип испытания:</strong> {{ $test->type }}</p>
                                    <p><strong>Семестр:</strong> {{ $test->semester }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
