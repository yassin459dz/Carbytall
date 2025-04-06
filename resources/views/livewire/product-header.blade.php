<!-- Group heading and search input together -->
<div class="flex items-center justify-between mb-6">
    <!-- Left: Heading -->
    <h2 class="text-2xl font-bold text-gray-800">
      Available Products
    </h2>
<!-- Right: Search bar and button -->
<div class="flex items-center ">
<input
type="text"
placeholder="Search products..."
class="px-4 py-2 transition duration-300 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
x-model="searchTerm"
>
<button data-modal-target="authentication-modal-Product" data-modal-toggle="authentication-modal-Product" type="button"
class="px-2.5 py-2 text-white bg-blue-700 hover:bg-blue-800 border-l border-gray-300 rounded-r-lg focus:ring-4 focus:outline-none focus:ring-blue-300"
@click="console.log('Authentication modal triggered')">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
stroke="currentColor" class="size-6">
<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>
</button>
<div wire:ignore>
<livewire:create-edit-product />
</div>
</div>
</div>
