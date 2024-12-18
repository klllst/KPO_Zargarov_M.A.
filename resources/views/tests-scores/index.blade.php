<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto">
            <h1 class="text-2xl text-gray-700">{{ $test->type }}. {{ $test->subject->name }}</h1>
        </div>
    </x-slot>

    <div class="container mx-auto mt-8">
        @if($scores->isEmpty())
            <p class="text-center text-gray-500">Оценок пока нет</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($scores as $score)
                    <form
                        action="{{ route('tests.scores.update', [$test, $score]) }}"
                        method="POST"
                        class="bg-white border border-gray-200 rounded-lg shadow p-4"
                    >
                        @csrf
                        @method('PUT')

                        <h3 class="text-xl font-semibold text-gray-700 mb-2">
                            Студент: {{ $score->student->fio }}
                        </h3>

                        <p class="text-gray-600 mb-4">
                            <strong>Преподаватель:</strong> {{ $score->teacher?->fio }}
                        </p>

                        <label for="mark" class="block mb-2 text-gray-700 font-medium">Оценка</label>
                        <div>
                            <x-input-label for="mark" :value="('Выберите оценку')" />
                            <select
                                id="mark"
                                name="mark"
                                x-data
                                x-on:change="$dispatch('type-changed', $el.value)"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach (App\Enums\ScoreEnum::getTestTypeScores($test->type) as $value)
                                    <option value="{{ $value }}" @if ($score->mark === $value->value) selected @endif>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 text-right">
                            <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                            >
                                Сохранить
                            </button>
                        </div>
                    </form>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
