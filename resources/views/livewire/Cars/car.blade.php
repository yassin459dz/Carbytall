<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Cars') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div x-data="{modalIsOpen: false}">
                    <button @click="modalIsOpen = true" type="button" class="px-4 py-2 text-sm font-medium tracking-wide text-center text-white transition bg-purple-500 cursor-pointer whitespace-nowrap rounded-2xl hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 active:opacity-100 active:outline-offset-0 dark:bg-purple-400 dark:text-black dark:focus-visible:outline-purple-400">Open Modal</button>
                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false" class="fixed inset-0 z-30 flex items-end justify-center p-4 pb-8 bg-black/20 backdrop-blur-md sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                        <livewire:create-cars>
                    </div>

                </div>

            </div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">




                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Client name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                            <tr class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$loop->index+1}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$car->model}}
                                </td>
                                <td class="px-6 py-4">
                                    <button type="button" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>

                                    {{-- i use a he use a Button --}}
                                    {{-- <button @click="$dispatch('edit-mode',{id:{{$car->id}}})" type="button" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button> --}}
                                    {{-- i use a he use a Button --}}
                                    {{-- <button @click="$dispatch('edit-mode',{id:{{$client->id}}})"  data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="text-red-600 ">test</button> --}}


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
        </div>

    </div>

                </div>
            </div>
        </div>
    </div>


