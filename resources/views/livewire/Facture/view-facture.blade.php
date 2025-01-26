
<div class="min-h-screen p-4 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="max-w-4xl mx-auto space-y-4">
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="p-4 text-white bg-gradient-to-r from-blue-600 to-indigo-600">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <div>
                            <h1 class="text-xl font-bold">Invoice #{{ $invoiceNumber }}</h1>
                            <p class="text-sm opacity-90">{{ $date }} - {{ $time }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="inline-flex items-center px-2 py-1 text-green-100 rounded-full
                        {{ $status === 'PAID' ? 'bg-green-500/20' : 'bg-red-500/20' }}">
                        @if ($status === 'PAID')
                            <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        @endif
                        {{ $status }}
                    </div>


                    <div class="flex space-x-2">
                        <button
                            wire:click="print"
                            x-on:click="printPreview = true"
                            class="bg-white/20 hover:bg-white/30 p-1.5 rounded-lg">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                        </button>
                    </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 p-4">
                <div class="p-3 rounded-lg bg-blue-50">
                    <div class="flex items-center mb-2 space-x-2">
                        <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h2 class="font-medium text-blue-800">Client : <span>{{ $client['name'] }}</span> </h2>
                    </div>
                    <div class="flex items-center mt-4 space-x-2">
                        <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                          </svg>
                        <h2 class="font-medium text-blue-800 ">Phone :
                            <span>{{ $client['phone'] }}
                            @if (!empty($client['phone2']))
                                <span> - {{ $client['phone2'] }}
                                </span>
                            @endif
                            </span>
                        </h2>
                    </div>


                </div>
                <div class="p-3 rounded-lg bg-indigo-50">
                    <div class="flex items-center mb-2 space-x-2">
                        <svg class="w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" height="12" width="12" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#1c64f2" d="M135.2 117.4L109.1 192l293.8 0-26.1-74.6C372.3 104.6 360.2 96 346.6 96L165.4 96c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32l181.2 0c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2l0 144 0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L96 400l0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L0 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>

                        <h2 class="font-medium text-blue-800">Car : {{ $vehicle['model'] }}</h2>
                        </div>
                        <div>
                            <h2 class="font-medium text-blue-800">Matricule : {{ $vehicle['matricule'] }}</h2>
                            <h2 class="font-medium text-blue-800">KM : {{ number_format($vehicle['kilometers']) }}</h2>
                        </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2 overflow-hidden bg-white rounded-lg shadow-md">
                <div class="flex items-center px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-indigo-600">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <h2 class="font-medium">Order Items</h2>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="py-2 text-base text-left text-gray-900 ">Name</th>
                                    <th class="px-1 py-1 text-left text-gray-900 ext-base">Description</th>
                                    <th class="px-3 py-1 text-gray-900 ext-base">Qty</th>
                                    <th class="px-3 py-1 text-right text-gray-900 ext-base">Price</th>
                                    <th class="px-3 py-1 text-right text-gray-900 ext-base">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderItems as $item)
                                <tr class="border-t">
                                    <td class="py-1 pr-3 ">{{ $item['name'] }}</td>
                                    <td class="px-1 py-2">{{ $item['description'] }}</td>
                                    <td class="py-2 pl-6 ">{{ $item['quantity'] }}</td>
                                    <td class="px-2 py-2 text-right">{{ number_format($item['price'], 2) }}</td>
                                    <td class="py-2 pl-1 font-medium text-right">{{ number_format($item['total'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-md">
                <div class="space-y-2">
                    <div class="flex justify-between text-lg font-medium text-green-600 " style="font-size: 17.5px;" >
                        <span>Extra Charges</span>
                        <span>+{{ number_format($financial['extra_charge'], 2) }} DA</span>
                    </div>
                    <div class="flex justify-between text-lg font-medium text-red-600" style="font-size: 17.5px;">
                        <span>Discount :</span>
                        <span>-{{ number_format($financial['discount_amount'], 2) }} DA</span>
                    </div>
                    <div class="flex justify-between text-xl font-bold text-blue-600 ">
                        <span>Total :</span>
                        <span>{{ number_format($financial['total_amount'], 2) }} DA</span>
                    </div>
                </div>
                <div class="pt-2 mt-4 border-t ">
                    <div class="flex items-center mb-2 space-x-2">
                        <h2 class="text-lg font-medium text-gray-800">Remark</h2>
                    </div>
                    <p class="text-base text-gray-800 rounded-lg bg-gray-50">{{ $remark }}</p>
                </div>
            </div>
        </div>
    </div>


    <div>
        <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-thermal-invoice-preview', (event) => {
                const printData = event[0] || event;

        const printWindow = window.open();

        if (!printWindow) {
            alert('Please allow pop-ups for this site to print invoices');
            return;
        }

                printWindow.document.write(`

      <style>
        @media print {
          @page {
            margin: 0;
            size: 80mm auto;
          }
          body {
            margin: 0;
            padding: 0;
            width: 80mm;
          }
          .screen-only {
            display: none !important;
          }
          * {
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
          }
          .no-break {
            break-inside: avoid;
          }
          * {
            color: black !important;
          }
          .rounded-lg, .rounded-full {
            border-radius: 0 !important;
          }
        }
        body {
          background: #f9fafb;
          font-family: Arial, sans-serif;
          line-height: 1.6;
        }
        .invoice-container {
          width: 80mm;
          margin: auto;
          background: #fff;
          padding: 8px;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header, .footer {
          text-align: center;
          border-bottom: 1px solid #ddd;
          padding-bottom: 8px;
          margin-bottom: 8px;
        }
        .order-items, .totals {
          width: 100%;
          border-collapse: collapse;
        }
        .order-items th, .order-items td, .totals td {
          text-align: left;
          padding: 4px 4px;
          border-bottom: 1px solid #ddd;
        }
         .total-row , .final-total{
            font-weight: bold !important;
        }
         .totals  {
            text-align: right;

        }
         .totals  th{
            font-weight: normal

        }

        .screen-only {
          text-align: right;
          margin-bottom: 16px;
        }
      </style>

      <div class="invoice-container" id="invoice">
        <div class="header">
          <h1 class="text-xl font-bold">INV #{{ $invoiceNumber }}</h1>
          <p id="date-time">{{ $date }} - {{ $time }}</p>
          <h3 id="status">{{ $status }}</h3>
        </div>
        <div>
          <p><strong>Client :</strong> {{ $client['name'] }}</p>
          <p><strong>Car :</strong> {{ $vehicle['model'] }}</p>
          <p><strong>Matricule :</strong> {{ $vehicle['matricule'] }}</p>
          <p><strong>KM :</strong> {{ number_format($vehicle['kilometers']) }}</p>
        </div>
        <table class="order-items">
          <thead>
            <tr>
              <th>Name</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody id="order-items">
            <tbody>
                @foreach($orderItems as $item)
                <tr class="border-t">
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'], 2) }}</td>
                    <td>{{ number_format($item['total'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>          </tbody>
        </table>
        <table class="totals">
          <tr>
            <td>Extra Charges:</td>
            <th id="extra-charges">+{{ number_format($financial['extra_charge'], 2) }} DA</th>
          </tr>
          <tr>
            <td>Discount:</td>
            <th id="discount">-{{ number_format($financial['discount_amount'], 2) }} DA</th>
          </tr>
          <tr class="total-row">
            <td>Total:</td>
            <th id="final-total">{{ number_format($financial['total_amount'], 2) }} DA</th>
          </tr>
        </table>
        <div>
          <p><strong>Remarks:</strong></p>
          <p id="remarks">{{ $remark }}</p>
        </div>
        <div class="footer">
          <p>Thank you for your business!</p>
        </div>
      </div>
    `);

       printWindow.document.close();

        // Call the print method to directly show the print dialog
        printWindow.print();

    // Optionally, close the print window after printing
    printWindow.onafterprint = () => {
    printWindow.close();
        };
    });
});
</script>
</div>





</div>
