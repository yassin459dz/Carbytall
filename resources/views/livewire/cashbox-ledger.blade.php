<div>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-sm text-gray-700 table-fixed">
            <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Start</th>
                    <th class="px-4 py-2 text-green-600">Inflow</th>
                    <th class="px-4 py-2 text-red-600">Outflow</th>
                    <th class="px-4 py-2">Balance</th>
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
                        <td class="px-4 py-2">
                            <button wire:click="view('{{ $date }}')" class="font-medium text-blue-600 hover:underline">Details</button>
                            <button wire:click="editEndValue('{{ $date }}')" class="text-yellow-600 hover:underline">End Value</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No data available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($selectedDate)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-3/4 max-w-2xl p-3 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xl font-semibold text-blue-600">Details for {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}</h3>
                    <button wire:click="$set('selectedDate', null)" class="text-red-400 hover:text-red-900">&times;</button>
                </div>

                <h6 class="mb-2 text-lg font-semibold">START VALUE: {{ number_format($dailyBalances[$selectedDate]['start'],2,',',' ') }} DA</h6>
                <h4 class="mb-2 font-medium">Invoices</h4>
                <div class="mb-4 overflow-x-auto">
                    @forelse($facturesOfDay as $facture)
                        <div>#{{ $facture->id }} — {{ number_format($facture->total_amount,2,',',' ') }} DA</div>
                    @empty
                        <div>No invoices</div>
                    @endforelse
                </div>

                <h4 class="mb-2 font-medium">Cash Movements</h4>
                <div class="overflow-x-auto">
                    @forelse($mouvementsOfDay as $mvt)
                        <div>#{{ $mvt->id }}: {{ $mvt->type }} — {{ number_format($mvt->montant,2,',',' ') }} DA</div>
                    @empty
                        <div>No movements</div>
                    @endforelse

                    <div class="flex justify-between mt-4">
                        <div>Total: {{ number_format($dailyBalances[$selectedDate]['solde'],2,',',' ') }} DA</div>
                        <div>
                            End Value:
                            <input type="number" wire:model.defer="endValue" placeholder="Enter value" class="px-2 py-1 border rounded-md" />
                            <button wire:click="saveEndValue" class="px-3 py-1 ml-2 text-white bg-blue-600 rounded">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showEndModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
                <h3 class="mb-4 text-lg font-bold">Edit End Value – {{ \Carbon\Carbon::parse($endEditDate)->format('d/m/Y') }}</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block mb-1 font-semibold">End Value (DA)</label>
                        <input type="number" step="0.01" wire:model.defer="endValue" class="w-full px-4 py-2 border rounded-md" />
                    </div>
                    <div class="flex justify-end">
                        <button wire:click="saveEndValue" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
