<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
    @if($factures->isNotEmpty())
    <h1 class="text-xl font-bold">
        Facture History For CLIENT : <span class="font-bold text-blue-600">{{ $matricule->client->name }}</span>
        CAR : <span class="font-bold text-blue-600">{{ $matricule->car->model }}</span>
        MATRICULE : <span class="font-bold text-blue-600">{{ $matricule->mat }}</span>
    </h1>
    @else
    <h1 class="text-xl font-bold">
        Facture History for CLIENT : <span class="font-bold text-blue-600">{{ $matricule->client->name }}</span>
        CAR : <span class="font-bold text-blue-600">{{ $matricule->car->model }}</span>
        MATRICULE : <span class="font-bold text-blue-600">{{ $matricule->mat }}</span>
    </h1>
    @endif
</x-slot>
<div class="py-12 ">
    <div class="mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="text-gray-900 ">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    @if($factures->isNotEmpty())

                    <table class="w-full text-sm text-gray-700 text-centre dark:text-gray-400">
                        <thead class="text-xs font-semibold text-gray-900 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-3 py-4 text-center">ID</th>
                                <th scope="col" class="px-6 py-4 text-center">KM</th>
                                <th scope="col" class="px-6 py-4 text-center">Remark</th>
                                <th scope="col" class="px-6 py-4 text-center">Status</th>
                                <th scope="col" class="px-6 py-4 text-center">Total</th>
                                <th scope="col" class="px-6 py-4 text-center">Time</th>
                                <th scope="col" class="px-6 py-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($factures as $facture)
                            <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                                <td class="px-3 py-4 font-medium text-center text-gray-900 dark:text-white">#{{ $facture->id }}</td>

                                <td class="px-6 py-4 text-center">{{ $facture->km }}</td>
                                <td class="px-6 py-4 text-center">{{ $facture->remark }}</td>
                                <td class="px-2 py-4 text-center">
                                    <span class="inline-flex items-center justify-center gap-1 px-2 py-2 text-xs font-medium rounded-full whitespace-nowrap
                                    {{ $facture->status === 'PAID' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
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
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-center rounded-full bg-emerald-100 text-emerald-700 whitespace-nowrap">
                                        {{ $facture->total_amount }} DA
                                    </span>
                                </td>
                                <td class="px-4 py-4" text-center>{{ $facture->created_at }}</td>
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
        @else
        <h1 class="text-xl font-bold text-red-600">Facture Not Exist</h1>

        @endif
</div>


