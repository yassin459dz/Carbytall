<div>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-sm text-gray-700 table-fixed">
            <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Start</th>
                    <th class="px-4 py-2 text-green-600">Inflow</th>
                    <th class="px-4 py-2 text-red-600">Outflow</th>
                    <th class="px-4 py-2">NET</th>
                    <th class="px-4 py-2">END</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dailyBalances as $date => $data)
                    <tr class="border-t">

                        <td class="px-4 py-2 font-medium">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ number_format($data['start'], 2, ',', ' ') }} DA</td>
                        <td class="px-4 py-2 text-green-700">{{ number_format($data['entree'], 2, ',', ' ') }} DA</td>
                        <td class="px-4 py-2 text-red-700">{{ number_format($data['sortie'], 2, ',', ' ') }} DA</td>
                        <td class="px-4 py-2 font-semibold">{{ number_format($data['solde'], 2, ',', ' ') }} DA</td>
                        <td class="px-4 py-2 font-medium text-orange-600"> {{ number_format($data['solde'], 2, ',', ' ') }}</td>

                        <td class="px-4 py-2">
                            <button wire:click="editEndValue('{{ $date }}')">Test End Value</button>

                            <button wire:click="view('{{ $date }}')" class="font-medium text-blue-600 hover:underline">
                                Details
                            </button>
                            <button wire:click="editEndValue('{{ $date }}')" class="text-yellow-600 hover:underline">
                                End Value
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No data available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal showing invoices and movements for selected date --}}
    @if($selectedDate)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-3/4 max-w-2xl p-3 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="inline-flex items-center justify-center
                                        gap-x-1
                                        rounded-md
                                        text-xl font-semibold
                                        ring-1 ring-inset ring-blue-600/10
                                        px-2 py-1
                                        min-w-[1.5rem]
                                        bg-blue-50 text-blue-600
                                        dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/30
                                        whitespace-nowrap">
                        Details of : {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}
                    </h3>

                    <button wire:click="$set('selectedDate', null)"  class="end-2.5 text-red-400 bg-transparent hover:bg-gray-200 hover:text-red-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                     </svg>
                    </button>


                </div>
                    <h6 class="inline-flex items-center justify-center mb-2
                                rounded-md
                                text-xl font-semibold
                                ring-1 ring-inset ring-black-600/10
                                px-2 py-1
                                min-w-[1.5rem]
                                bg-black-50 text-black-600
                                dark:bg-black-400/10 dark:text-black-400 dark:ring-black-400/30
                                whitespace-nowrap">
                        START VALUE : {{ number_format($data['start'], 2, ',', ' ') }} DA
                    </h6>

                {{-- Invoices Table --}}
                <h4 class="pl-2 mb-2 text-lg font-medium">Invoices</h4>
                <div class="mb-4 overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="text-xs uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center">ID</th>
                                <th class="px-4 py-2 text-center">Client</th>
                                <th class="px-4 py-2 text-center">Model</th>
                                <th class="px-4 py-2 text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($facturesOfDay as $facture)
                                <tr class="border-t">
                                    <td class="px-3 py-2 text-center">#{{ $facture->id }}</td>
                                    <td class="px-3 py-2 text-center">
                                        <span class="inline-flex items-center justify-center
                                        gap-x-1
                                        rounded-md
                                        text-sm font-medium
                                        ring-1 ring-inset ring-blue-600/10
                                        px-2 py-1
                                        min-w-[1.5rem]
                                        bg-blue-50 text-blue-600
                                        dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/30
                                        whitespace-nowrap">{{ $facture->client->name }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <span class="inline-flex items-center justify-center
                                        gap-x-1
                                        rounded-md
                                        text-sm font-medium
                                        ring-1 ring-inset ring-black-600/10
                                        px-2 py-1
                                        min-w-[1.5rem]
                                        bg-black-50 text-black-600
                                        dark:bg-black-400/10 dark:text-black-400 dark:ring-black-400/30
                                        whitespace-nowrap">{{ $facture->car->model }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <span class="inline-flex items-center justify-center
                                        gap-x-1
                                        rounded-md
                                        text-sm font-medium
                                        ring-1 ring-inset ring-green-600/10
                                        px-2 py-1
                                        min-w-[1.5rem]
                                        bg-green-50 text-green-600
                                        dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/30
                                        whitespace-nowrap">{{ number_format($facture->total_amount,2,',',' ') }} DA
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-2 text-center">No invoices</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Cash Movements Table --}}
                <h4 class="pl-2 mb-2 text-lg font-medium">Cash Movements</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="text-xs uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center">ID</th>
                                <th class="px-4 py-2 text-center">Type</th>
                                <th class="px-4 py-2 text-center">Amount</th>
                                <th class="px-4 py-2 text-center">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mouvementsOfDay as $mvt)
                                <tr class="border-t">
                                    <td class="px-3 py-2 text-center"><span class="">#{{ $mvt->id }}</span>
                                        </td>
                                    <td class="px-3 py-2 text-center">
                                        <span class="inline-flex items-center justify-center
                                        gap-x-1
                                        rounded-md
                                        text-sm font-medium
                                        ring-1 ring-inset ring-green-600/10
                                        px-2 py-1
                                        min-w-[1.5rem]
                                        bg-green-50 text-green-600
                                        dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/30
                                        whitespace-nowrap">{{ $mvt->type }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <span class="inline-flex items-center justify-center
                                        gap-x-1
                                        rounded-md
                                        text-sm font-medium
                                        ring-1 ring-inset ring-red-600/10
                                        px-2 py-1
                                        min-w-[1.5rem]
                                        bg-red-50 text-red-600
                                        dark:bg-red-400/10 dark:text-red-400 dark:ring-red-400/30
                                        whitespace-nowrap">{{ number_format($mvt->montant,2,',',' ') }} DA
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <span class="inline-flex items-center justify-center
                                        gap-x-1
                                        rounded-md
                                        text-sm font-medium
                                        ring-1 ring-inset ring-black-600/10
                                        px-2 py-1
                                        min-w-[1.5rem]
                                        bg-black-50 text-black-600
                                        dark:bg-black-400/10 dark:text-black-400 dark:ring-black-400/30
                                        whitespace-nowrap">{{ $mvt->description }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-2 text-center">No movements</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="flex justify-end">
                        <table class="w-1/2 mt-1 text-sm text-gray-700 border-y">
                            <tbody>
                                <tr class="border-l border-r ">
                                    <td class="px-4 py-2 font-medium text-center bg-gray-100">TOTAL</td>
                                    <td class="px-4 py-2 text-center">
                                        <span class="inline-flex items-center justify-center
                                                     gap-x-1
                                                     rounded-md
                                                     font-bold
                                                     ring-1 ring-inset ring-green-600/10
                                                     px-2 py-1
                                                     min-w-[1.5rem]
                                                     bg-green-50 text-green-600
                                                     dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/30
                                                     whitespace-nowrap">
                                            {{ number_format($data['solde'], 2, ',', ' ') }} DA
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-t border-l border-r">
                                    <td class="px-4 py-2 font-medium text-center bg-gray-100 text-nowrap">End Value</td>
                                    <td class="px-4 py-2 text-center">
                                        <input type="number"
                                               wire:model.defer="endValue"
                                               placeholder="Enter the value"
                                               class="w-full px-2 py-1 font-bold text-center border border-gray-300 rounded-md focus:ring focus:ring-blue-400 focus:outline-none">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-2">
                        <button type="button" wire:click="saveEndValue"
                                class="w-1/2 px-4 py-2 font-semibold text-white transition-transform duration-100 ease-in-out bg-blue-600 rounded-lg active:scale-90 hover:bg-blue-700">
                            UPDATE
                        </button>
                    </div>



                </div>
            </div>
        </div>
    @endif


    @if($showEndModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">
                    Edit End Value – {{ \Carbon\Carbon::parse($endEditDate)->format('d/m/Y') }}
                </h3>
                <button wire:click="$set('showEndModal', false)" class="text-2xl text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">End Value (DA)</label>
                    <input type="number" step="0.01" wire:model.defer="endValue"
                        class="w-full px-4 py-2 border rounded-md" />
                </div>

                <div class="flex justify-end">
                    <button wire:click="saveEndValue"
                        class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif


</div>
