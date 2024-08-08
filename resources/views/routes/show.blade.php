<!-- resources/views/routes/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Route Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">
                    Route from {{ $route->start }} to {{ $route->end }} at
                    {{ \Carbon\Carbon::createFromFormat('H:i', $route->time)->format('H:i') }}
                </h3>
                <p><strong>Slots:</strong> {{ $route->slots }}</p>
                <p><strong>Reserved:</strong> {{ $route->reserved }}</p>
                <p><strong>Status:<strong> {{ $route->passengers_count + $route->reserved }} / {{ $route->slots }}</p>

                <div class="mt-4">
                    <a href="{{ route('routes.edit', $route->id) }}" class="btn btn-primary">Edit Route</a>
                    <form action="{{ route('routes.destroy', $route->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete
                            Route</button>
                    </form>
                </div>

                <div class="mt-6">
                    <h4 class="text-lg font-medium text-gray-900">Passengers</h4>
                    <table class="table-auto w-full mt-4">
                        <tbody>
                            @foreach ($route->passengers as $passenger)
                                <tr>
                                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $passenger->label }}</td>
                                    <td class="border px-4 py-2">
                                        <form action="#" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
