<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('subjects.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Добавить новый предмет</a>
    </x-slot>

    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left w-16">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Название</th>
                <th class="border border-gray-300 px-4 py-2 text-left w-32">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($subjects as $subject)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $subject->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $subject->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex space-x-2">
                            <a href="{{ route('subjects.edit', [$subject]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Редактировать</a>
                            <form action="{{ route('subjects.destroy', [$subject]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">Нет предметов</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>

