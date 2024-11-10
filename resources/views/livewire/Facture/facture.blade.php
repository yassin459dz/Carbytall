<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Facture
        </h2>
    </x-slot>
    <div class="px-4 sm:px-0">
        <h6 class="d-flex justify-content-center">  </h6>

        <h3 class="text-lg font-medium leading-6 text-gray-900">Step {{$currentstep}}</h3>
        <p class="mt-1 text-sm text-gray-600">out of {{$totalstep}}</p>
    </div>
<div class="py-12">
<div class="" >
        <ol class="flex items-center p-3 mx-auto space-x-4 text-lg font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-t-lg shadow-sm max-w-7xl dark:text-gray-400 sm:text-xl dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-6 rtl:space-x-reverse">
            <li class="flex items-center text-blue-600 dark:text-blue-500">
                <span class="flex items-center justify-center w-8 h-8 mr-3 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                    1
                </span>
            Personal <span class="hidden sm:inline-flex sm:ms-2"></span>
            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
            </svg>
        </li>
        <li class="flex items-center">
            <span class="flex items-center justify-center w-8 h-8 mr-3 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                2
            </span>
            Account <span class="hidden sm:inline-flex sm:ms-2"></span>
            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
            </svg>
        </li>
        <li class="flex items-center">
            <span class="flex items-center justify-center w-8 h-8 mr-3 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                3
            </span>
            Review <span class="hidden sm:inline-flex sm:ms-2"></span>
        </li>
    </ol>
    <div class=" sm:mt-0">
        <div class="mx-auto md:grid max-w-7xl ">

            {{-- <div class="flex items-center justify-center md:col-span-2"> --}}


            {{-- </div> --}}

            {{-- <div class="md:col-span-2">
                 @if ($errors->isNotEmpty())
                    <div class="relative px-4 py-3 mb-4 text-sm text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">There are some errors with your submission.</span>
                    </div>
                @endif
                @if ($success)
                    <div class="relative px-4 py-3 mb-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                        <span class="block sm:inline">{{ $success }}</span>
                        <span wire:click="resetSuccess" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="w-6 h-6 text-green-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                @endif --}}
                <form wire:submit.prevent="submit">
                    <div class="overflow-hidden shadow sm:rounded-b-lg">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            @if($currentstep===1)
                            <div class="flex flex-col">

                                {{-- THE FACTURE N° --}}
                                <div class="w-full py-2">
                                    <label for="facture" class="block text-sm font-medium text-gray-700">Facture N°</label>
                                    <!-- Display facture number as an h3 tag -->
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        {{ str_pad($facture_number, 8, '0', STR_PAD_LEFT) }}
                                    </h3>
                                </div>

                                {{-- THE FACTURE N° --}}

                                {{-- THE SERCHABLE DROPDOWN --}}
                                <div class="relative max-w-sm">
                                    <div x-data="{
                                            open: false,
                                            search: @js($search), // Initialize Alpine with Livewire's current search value
                                            setClientName() {
                                                this.search = @this.allclients.find(c => c.id === @this.client_id)?.name || '';
                                            }
                                        }"
                                        x-init="setClientName()" {{-- Initialize search value when component loads --}}
                                        @click.away="open = false"
                                        class="relative">

                                        <label for="client" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client Name</label>

                                        <!-- Input Field -->
                                        <input
                                            type="text"
                                            class="block w-full p-2 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            x-model="search"
                                            @input.debounce.100ms="open = true; $wire.set('search', search)" {{-- Sync with Livewire on input --}}
                                            {{-- @focus="open = true" --}}
                                        />

                                        <!-- Dropdown List -->
                                        <div class="absolute z-50 w-full mt-2 bg-white border border-gray-200 rounded-lg dark:bg-neutral-800 dark:border-neutral-700"
                                             x-show="open && search.length > 0">
                                            <div class="overflow-hidden overflow-y-auto max-h-72">
                                                <template x-for="client in {{ json_encode($allclients) }}" :key="client.id">
                                                    <div class="flex items-center w-full px-4 py-2 text-sm text-gray-800 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-200"
                                                         @click="
                                                            $wire.set('client_id', client.id); // Update Livewire client_id
                                                            search = client.name; // Update Alpine search
                                                            open = false;
                                                         "
                                                         x-show="client.name.toLowerCase().includes(search.toLowerCase())">
                                                        <span x-text="client.name"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        @error('client_id')
                                            <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <select id="allcars"
                                class="bg-gray-50 border mt-4 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                wire:model="car_id">
                                <option value="" selected>Choose a Car</option>
                                @foreach ($allcars as $car)
                                <option value="{{ $car->id }}">{{ $car->model }}</option>
                                @endforeach
                                </select>
                                @error('car_id') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror


                                </div>
                                @endif
                                @if($currentstep===2)

                                <div class="flex flex-col">
                                    <div class="w-full py-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input wire:model.lazy="email" type="email" name="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @error('email') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="w-full py-2">
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone N°</label>
                                        <input wire:model.lazy="phone" type="text" name="phone" id="password_confirmation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @error('phone') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 text-right bg-gray-50 sm:px-6">
                            @if($currentstep>1)
                                <button wire:click="decrementstep" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-400 border border-transparent rounded-md shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                    Back
                                </button>
                            @endif
                            @if($currentstep === $totalstep)
                            <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Submit
                                </button>
                            @endif
                            @if($currentstep<$totalstep)
                                <button wire:click="incrementstep" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Next
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>



