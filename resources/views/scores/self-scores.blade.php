<x-app-layout>
    <div
        class="container max-w-7xl mx-auto sm:px-6 lg:px-8 py-8"
        x-data="{ activeSemester: {{ $scores->keys()->first() }} }"
    >
        <!-- Кнопки для выбора семестра -->
        <div class="flex space-x-4 mb-6">
            @foreach ($scores as $semester => $scoresBySemester)
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

        <!-- Карточки с оценками -->
        <div>
            @foreach ($scores as $semester => $scoresBySemester)
                <div
                    x-show="activeSemester === {{ $semester }}"
                    x-cloak
                    class="space-y-4"
                >
                    @foreach ($scoresBySemester as $item)
                        @php
                            $score = $item['score'];
                            $test = $item['test'];
                        @endphp

                        <div
                            x-data="{ showDetails: false }"
                            class="bg-white shadow-md rounded-lg border border-gray-200 overflow-hidden cursor-pointer"
                            x-on:click="showDetails = !showDetails"
                        >
                            <!-- Основная информация -->
                            <div class="flex items-center justify-between px-4 py-6">
                                <h4 class="font-bold text-lg text-center">{{ $test->subject->name }}</h4>
                                <span class="px-3 py-1 text-sm rounded-full {{ $score->value === 'Отлично' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                                    {{ $score->value }}
                                </span>
                            </div>

                            <!-- Детали -->
                            <div
                                x-show="showDetails"
                                class="px-4 py-2 bg-gray-50 border-t border-gray-200"
                                x-cloak
                            >
                                <p class="text-lg"><strong>Тип испытания:</strong> {{ $test->type }}</p>
                                <p class="text-lg"><strong>Оценка:</strong> {{ $score->mark }}</p>
                                <p class="text-lg"><strong>Семестр:</strong> {{ $test->semester }}</p>
                                <p class="text-lg"><strong>Дата сдачи:</strong> {{ $score->created_at->format('d.m.Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
