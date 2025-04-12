<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full text-sm text-gray-700">
        <thead class="text-xs uppercase bg-gray-100">
            <tr>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2 text-green-600">Entrée (Total Factures)</th>
                <th class="px-4 py-2 text-red-600">Sortie</th>
                <th class="px-4 py-2">Solde</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dates as $m)
            @php
                $dateStr = \Carbon\Carbon::parse($m)->toDateString();
                $entree = $entrees[$dateStr]->total_entree ?? 0;
                $sortie = $sorties[$dateStr]->total_sortie ?? 0;
                $solde = $entree - $sortie;
            @endphp
            <tr class="border-t">
                <td class="px-4 py-2 font-medium">{{ \Carbon\Carbon::parse($m)->format('d/m/Y') }}</td>
                <td class="px-4 py-2 text-green-700">{{ number_format($entree, 2, ',', ' ') }} DA</td>
                <td class="px-4 py-2 text-red-700">{{ number_format($sortie, 2, ',', ' ') }} DA</td>
                <td class="px-4 py-2 font-semibold">{{ number_format($solde, 2, ',', ' ') }} DA</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-6 text-center text-gray-500">Aucune donnée disponible.</td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>
