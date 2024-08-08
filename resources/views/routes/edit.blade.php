<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Route') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('routes.update', $route) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <!-- Start Location -->
                        <div>
                            <x-input-label for="start" :value="__('Start Location')" />
                            <x-text-input id="start" name="start" type="text" class="mt-1 block w-full" :value="old('start', $route->start)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('start')" />
                        </div>

                        <!-- End Location -->
                        <div>
                            <x-input-label for="end" :value="__('End Location')" />
                            <x-text-input id="end" name="end" type="text" class="mt-1 block w-full" :value="old('end', $route->end)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('end')" />
                        </div>

                        <!-- Time -->
                        <div>
                            <x-input-label for="time" :value="__('Time')" />
                            <x-text-input id="time" name="time" type="time" class="mt-1 block w-full" :value="old('time', $route->time)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('time')" />
                        </div>

                        <!-- Status -->
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="going" {{ old('status', $route->status) === 'going' ? 'selected' : '' }}>{{ __('Going') }}</option>
                                <option value="returning" {{ old('status', $route->status) === 'returning' ? 'selected' : '' }}>{{ __('Returning') }}</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <!-- Slots -->
                        <div>
                            <x-input-label for="slots" :value="__('Slots')" />
                            <x-text-input id="slots" name="slots" type="number" class="mt-1 block w-full" :value="old('slots', $route->slots)" required min="1" />
                            <x-input-error class="mt-2" :messages="$errors->get('slots')" />
                        </div>

                        <!-- Reserved -->
                        <div>
                            <x-input-label for="reserved" :value="__('Reserved')" />
                            <x-text-input id="reserved" name="reserved" type="number" class="mt-1 block w-full" :value="old('reserved', $route->reserved)" required min="0" />
                            <x-input-error class="mt-2" :messages="$errors->get('reserved')" />
                        </div>

                        <!-- Save Button -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'route-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
