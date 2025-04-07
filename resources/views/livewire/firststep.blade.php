<div class="relative max-w-sm ">
    <label for="client" class="block text-sm font-medium text-gray-700">Client Name</label>
    <div class="flex items-center space-x-0">
        <div x-data="{ search: '', open: false }" class="relative w-full">
            <!-- Searchable Input -->
            <input
            id="NewClient"

                type="text"
                x-model="search"
                class="block w-full p-2 text-gray-800 placeholder-gray-400 bg-white border-gray-300 rounded-l-lg focus:ring-blue-500 focus:outline-none"
                placeholder="Client"
                @focus="open = true"

            />

            <!-- Dropdown -->
            <div class="absolute z-50 w-full mt-1.5 bg-white border border-gray-200 rounded-lg shadow-lg"
                 x-show="open && search.length > 0">
                <div class="overflow-hidden overflow-y-auto max-h-72">
                    <template x-for="client in [...document.querySelectorAll('#clientSelect option')].filter(c => c.innerText.toLowerCase().includes(search.toLowerCase()))">
                        <div
                            class="flex items-center w-full px-4 py-2 text-sm text-gray-800 cursor-pointer hover:bg-blue-600 hover:text-white"
                            @click="
                                search = client.innerText;
                                document.querySelector('#clientSelect').value = client.value;
                                open = false;
                                $wire.set('selectedClient', client.value); // Explicit Livewire update
                            "
                        >
                            <span x-text="client.innerText"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Select Dropdown (Hidden) -->
            <select id="clientSelect" wire:model.lazy="selectedClient" class="hidden">
                <option value="">Select Client</option>
                @foreach ($allclients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Button on the right side -->
        <div>
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button"
                    class="px-2.5 py-2 text-white bg-blue-700 hover:bg-blue-800 border-l border-gray-300 rounded-r-lg focus:ring-4 focus:outline-none focus:ring-blue-300"
                    @click="console.log('Authentication modal triggered')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
            <div wire:ignore>
                <livewire:create-edit-client />
            </div>
        </div>
    </div>

    <!-- Car Dropdown (Dependent on Client) -->
    <label for="carSelect" class="block mt-4 text-sm font-medium text-gray-700">Car</label>
    <div class="flex items-center space-x-0">
        <select id="carSelect" wire:model.live="selectedCar" wire:key="carSelect" class="block w-full p-2 text-gray-800 bg-white border border-gray-300 rounded-l-lg focus:ring-blue-500 focus:outline-none">
            <option wire:key="car-select-default" value="">Select Car</option>
            @foreach ($groupedCars as $groupLabel => $cars)
                @php $groupClasses = $groupLabel == 'Owned Car' ? 'text-green-600' : 'text-red-600'; @endphp
                <optgroup wire:key="group-{{ $groupLabel }}" label="{{ $groupLabel }}" class="font-semibold {{ $groupClasses }}">
                    @foreach ($cars as $car)
                        <option wire:key="car-option-{{ $car->id }}" class="font-semibold" value="{{ $car->id }}">{{ $car->model }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>

        <button
            type="button"
            @click="console.log('Car button clicked')"
            class="px-2.5 py-2 text-white bg-blue-700 hover:bg-blue-800 border-l border-gray-300 rounded-r-lg focus:ring-4 focus:outline-none focus:ring-blue-300"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
    </div>

    <!-- Matricule Dropdown (Dependent on Car) -->
    <div x-data="{
        showNewMat: false,
        mat: @entangle('mat'),
        selectedMat: @entangle('selectedMat'),
        selectedCar: @entangle('selectedCar'),
        selectedClient: @entangle('selectedClient'),
        init() {
            this.$watch('selectedCar', (val) => {
                console.log('Car re-selected after matricule creation:', val);
            });
        }
    }"
     class="relative">
        <div class="relative max-w-sm">
            <label for="matSelect" class="block text-sm font-medium text-gray-700">Matricule</label>
            <div class="flex items-center space-x-0">
                <select
                    id="matSelect"
                    wire:model.live="selectedMat"
                    @change="console.log('Matricule selected:', $event.target.value)"
                    class="block w-full p-2 border-gray-200 rounded-l-lg"
                >
                    <option value="">Select Matricule</option>
                    @foreach ($this->filteredMatricules as $mat)
                        <option value="{{ $mat->id }}">{{ $mat->mat }}</option>
                    @endforeach
                </select>

                <!-- Create New Matricule Button -->
                <button
                    type="button"
                    class="px-2.5 py-2 text-white bg-blue-700 hover:bg-blue-800 border-l border-gray-300 rounded-r-lg focus:ring-4 focus:outline-none focus:ring-blue-300"
                    @click="showNewMat = !showNewMat; console.log('Toggle new matricule input:', showNewMat)"
                    :disabled="!selectedClient || !selectedCar"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>

<!-- New Matricule Input Section -->
<div
class="relative max-w-sm mt-2"
x-show="showNewMat"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 transform scale-95"
x-transition:enter-end="opacity-100 transform scale-100"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100 transform scale-100"
x-transition:leave-end="opacity-0 transform scale-95"
>
<div class="relative max-w-sm">
 <label for="NewMat" class="block text-sm font-medium text-gray-700">New Matricule</label>
 <div class="relative flex items-center">
     <div class="relative flex w-full">
         <input
             id="NewMat"
             type="text"
             class="block w-full p-2 text-sm text-gray-800 placeholder-gray-400 bg-white border border-gray-200 rounded-l-lg focus:border-blue-500 focus:ring-blue-500"
             x-model="mat"
             placeholder="Enter new matricule"
             @input="console.log('New matricule input:', $event.target.value)"
         />
         <button
             type="button"
             class="px-2.5 py-2 text-white bg-blue-700 hover:bg-blue-800 border-l border-gray-300 rounded-r-lg focus:ring-4 focus:outline-none focus:ring-blue-300"
             @click="
                 if (mat && mat.length > 0) {
                     // Store the selected car temporarily
                     const currentCar = selectedCar;

                     $wire.createMatricule(mat).then(() => {
                         // Clear mat input and close the input field
                         mat = '';
                         showNewMat = false;

                         // Explicitly reset the selected car
                         $wire.set('selectedCar', currentCar);
                         setTimeout(() => {
                             // Dispatch custom event for car restoration after short delay
                             window.dispatchEvent(new CustomEvent('car-restored', {
                                 detail: { id: currentCar }
                             }));
                         }, 50);
                     });
                 }
             "
         >
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20">
                 <path fill="currentColor" d="M3 5a2 2 0 0 1 2-2h1v3.5A1.5 1.5 0 0 0 7.5 8h4A1.5 1.5 0 0 0 13 6.5V3h.379a2 2 0 0 1 1.414.586l1.621 1.621A2 2 0 0 1 17 6.621V15a2 2 0 0 1-2 2v-5.5a1.5 1.5 0 0 0-1.5-1.5h-7A1.5 1.5 0 0 0 5 11.5V17a2 2 0 0 1-2-2zm9-2H7v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5zm2 8.5V17H6v-5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5" />
             </svg>
         </button>
     </div>
 </div>
</div>
</div>
</div>
</div>
