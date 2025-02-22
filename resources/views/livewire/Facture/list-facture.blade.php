<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('All FACTURE') }}
    </h2>
</x-slot>
<div class="py-12">
    <!-- Session Status Alert -->
    @if (session('status-created'))
    <div id="alert-1" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="text-sm font-medium ms-3">
            {{ session('status-created') }}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endif
@if (session('status-delete'))
<div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div class="text-sm font-medium ms-3">
        {{ session('status-delete') }}
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
  </div>
@endif
    <!-- Session Status Alert -->

    <div>
        <div>
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Create Client
            </button>
        </div>
        <div wire:ignore>
            <livewire:create-edit-client />
        </div>
    </div>
<!-- Search Form -->
    <div class="relative flex max-w-md mx-auto mb-8">
        <input wire:modal.live="search" type="search" id="location-search"
            class="block w-96 pl-4 pr-12 py-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500"
            placeholder="Search Client or Phone N°" required />
    </div>
    <!-- Client table -->
    {{-- <div class="mx-auto max-w-7xl sm:px-6 lg:px-8"> --}}
    <div class="mx-auto max-w-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="text-gray-900 ">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-gray-700 text-centre dark:text-gray-400">
                        <thead class="text-xs font-semibold text-gray-900 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-3 py-4 text-center">ID</th>
                                <th scope="col" class="px-6 py-4 text-center">Time</th>
                                <th scope="col" class="px-6 py-4 text-center">Client</th>
                                <th scope="col" class="px-6 py-4 text-center">Car Model</th>
                                <th scope="col" class="px-6 py-4 text-center">Matricule</th>
                                <th scope="col" class="px-6 py-4 text-center">KM</th>
                                <th scope="col" class="px-6 py-4 text-center">Remark</th>
                                <th scope="col" class="px-6 py-4 text-center">Status</th>
                                <th scope="col" class="px-6 py-4 text-center">Total</th>
                                <th scope="col" class="px-6 py-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($factures as $facture)
                            <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                                <td class="px-3 py-4 font-medium text-center dark:text-white">
                                    <span class="inline-flex items-center justify-center text-sm font-medium whitespace-nowrap">#{{ $facture->id }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                <span class="
    inline-flex items-center justify-center
    gap-x-1
    rounded-md
    text-sm font-medium
    ring-1 ring-inset ring-gray-500
    px-2 py-1
    min-w-[1.5rem]
    bg-black-50 text-black-600
    dark:bg-black-400/10 dark:text-black-400 dark:ring-black-400/30
    whitespace-nowrap
  ">{{ $facture->created_at->format('d-M-Y') }}</span></td>
                                <td class="px-6 py-4 font-medium text-center text-gray-900 dark:text-white">
                                    <span class="
                                        inline-flex items-center justify-center
                                        gap-x-1
                                        rounded-md
                                        text-sm font-medium
                                        ring-1 ring-inset ring-blue-600/10
                                        px-2 py-1
                                        min-w-[1.5rem]
                                      bg-blue-50 text-blue-600
                                      dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/30
                                        whitespace-nowrap">
                                        {{ $facture->client->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                <span class="
    inline-flex items-center justify-center
    gap-x-1
    rounded-md
    text-sm font-medium
    bg-green-50 text-green-600
    ring-1 ring-inset ring-green-600/10
    px-2 py-1
    min-w-[1.5rem]
    dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/30
    whitespace-nowrap">{{ $facture->car->model }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                <a wire:navigate href="{{ route('history', ['clientId' => $facture->client_id, 'matId' => $facture->matricule_id, 'carId' => $facture->car_id]) }}"
                                 class="
    inline-flex items-center justify-center
    gap-x-1
    rounded-md
    text-sm font-medium
    ring-1 ring-inset ring-red-600/10
    px-2 py-1
    min-w-[1.5rem]
    bg-red-50 text-red-600
    dark:bg-red-400/10 dark:text-red-400 dark:ring-red-400/30
    whitespace-nowrap
  ">{{ $facture->matricule->mat }}</a>
                                </td>
                                <td class="px-6 py-4 text-center">
                                 <span class="
                                 inline-flex items-center justify-center
    gap-x-1
    rounded-md
    text-sm font-medium
    ring-1 ring-inset ring-gray-500
    px-2 py-1
    min-w-[1.5rem]
    bg-black-50 text-black-600
    dark:bg-black-400/10 dark:text-black-400 dark:ring-black-400/30
    whitespace-nowrap">{{ $facture->km }} </span>

                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center text-sm font-medium whitespace-nowrap">{{ $facture->remark }}</span></td>
                                <td class="px-2 py-4 text-center">
                                    <span class="
    inline-flex items-center justify-center
    gap-x-1
    rounded-md
    text-sm font-medium
    bg-green-50 text-blue-600
    ring-1 ring-inset ring-blue-600/10
    px-2 py-1
    min-w-[1.5rem]
    dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/30
    whitespace-nowrap
                                    {{ $facture->status === 'PAID' ? 'bg-blue-50 text-blue-600 ring-1 ring-inset ring-blue-600/10 dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/30' : 'bg-red-50 text-red-600 ring-1 ring-inset ring-red-600/10 dark:bg-red-400/10 dark:text-red-400 dark:ring-red-400/30' }}">
                                    @if ($facture->status === 'PAID')
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9.75l4.5 4.5M14.25 9.75l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                    <span>{{ $facture->status }}</span>
                                </span>

                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                    class="
    inline-flex items-center justify-center
    gap-x-1
    rounded-md
    text-sm font-medium
    ring-1 ring-inset ring-green-600/10
    px-2 py-1
    min-w-[1.5rem]
    bg-green-50 text-green-600
    dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/30
    whitespace-nowrap
  ">


                                        {{ $facture->total_amount }} DA
                                    </span>
                                </td>
                                <td class="py-4 ">
                                    <a wire:navigate href="{{ route('viewfacture', ['id' => $facture->id]) }}"
                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                       View
                                    </a>
                                    <a wire:navigate href="{{ route('editfacture', ['edit' => $facture->id]) }}"
                                       class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                       Edit
                                    </a>

                                     <button data-modal-target="popup-modal-{{ $facture->id }}" data-modal-toggle="popup-modal-{{ $facture->id }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                        Delete
                                        </button>
                                        <livewire:deletefacture :factureId="$facture->id" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->

                    <!-- If there are no clients -->
                     {{-- @if ($clients->isEmpty())
                        <p class="p-4 text-gray-500">No clients available.</p>
                    @endif --}}
                </div>

            </div>

        </div>
    </div>
    <div>

    </div>
</div>
