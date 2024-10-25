<!-- Button to toggle the modal -->

<!-- Modal HTML -->
<div data-modal-target="modalEl" {{-- this for controll --}}
    id="modalEl" tabindex="-1" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white lg:text-2xl">
                    View Client
                </h3>
                <button data-modal-toggle="modalEl" type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg ms-auto hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7L1 1m6 6l6-6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->

            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Client</dt>
                    <dd class="text-lg font-semibold">yourname@flowbite.com</dd>
                </div>
                <div class="flex flex-col py-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Home address</dt>
                    <dd class="text-lg font-semibold">92 Miles Drive, Newark, NJ 07103, California, USA</dd>
                </div>
                <div class="flex flex-col pt-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Phone number</dt>
                    <dd class="text-lg font-semibold">+00 123 456 789 / +12 345 678</dd>
                </div>
            </dl>

            <!-- Modal footer -->
<!-- Modal footer -->
<div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b rtl:space-x-reverse dark:border-gray-600">
    <button data-modal-target="modalEl" id="acceptModal" type="button" class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        I accept
    </button>
    <button data-modal-target="modalEl" id="closeModalFooter" type="button" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
        Decline
    </button>
</div>

        </div>
    </div>
</div>
