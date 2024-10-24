<div class="py-12">
    <!-- Session Status Alert -->

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

    <!-- Client table -->
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Client Name</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->index + 1 }}</th>
                                <td class="px-6 py-4">{{ $client->name }}</td>
                                <td class="px-6 py-4">
                                    <!-- Trigger Edit Modal -->
                                    <button @click="$dispatch('edit-mode', { id: {{ $client->id }} })" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>

                                    <!-- Delete Button -->
                                    <button wire:click="delete({{ $client->id }})"  class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- If there are no clients -->
                    @if ($clients->isEmpty())
                        <p class="p-4 text-gray-500">No clients available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


</div>

