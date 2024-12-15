<body class="antialiased bg-gray-100">
    <div
        x-data="orderApp({{ $product->toJson() }})"
        x-init="initializeState()"
        class="mx-auto max-w-7xl">
        {{-- class="container mx-auto max-w-7xl"> --}}

        <div class="bg-white shadow-2xl rounded-xl">
            <div class="flex flex-col md:flex-row">
                <!-- Left Section: Product List -->
                <div class="w-full p-6 md:w-3/5 bg-gray-50">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">
                            Available Products
                        </h2>
                        <div class="flex items-center space-x-2">
                            <input
                                type="text"
                                placeholder="Search products..."
                                class="px-4 py-2 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                x-model="searchTerm"
                            >
                            <!-- Optionally, you could add a filter icon or additional search functionality -->
                        </div>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 overflow-y-scroll no-scrollbar max-h-[100vh]">
                        <template x-for="product in filteredProducts" :key="product.id">
                            <div
                                class="p-4 text-center transition duration-300 transform bg-white border border-gray-200 rounded-lg cursor-pointer hover:scale-105 hover:shadow-lg"
                                @click="addToOrder(product)">
                                <div class="mb-3 ">
                                    <h3 class="text-lg font-semibold text-gray-800 " x-text="product.name"></h3>
                                    <p class="font-bold text-blue-600 " x-text="product.description"></p>
                                </div>
                                <div class="text-xl font-semibold text-red-500" x-text="`${product.price} DA`"></div>
                            </div>
                        </template>
                    </div>
                </div>

<!-- Right Section: Order Summary -->
                <div class="w-full p-6 bg-white md:w-2/5">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Current Order</h2>
                        <button
                        class="px-4 py-2 text-red-500 bg-red-200 rounded-md hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300"
                        @click="clearOrder">
                            Clear All
                        </button>
                    </div>

                    <!-- Order Items -->
<!-- Order Items -->
<div class="space-y-4 max-h-[40vh] overflow-y-scroll no-scrollbar">
    <template x-for="(item, index) in orderItems" :key="item.id">
        <div
            x-data="{ isDragging: false }"
            :data-drag-index="index"
            @mousedown.prevent="
                initDrag(index, $event);
                isDragging = true;
            "
            @mousemove.prevent="
                handleDragMove($event);
                if (isDragging) $event.preventDefault();
            "
            @mouseup.prevent="
                handleDragEnd($event);
                isDragging = false;
            "
            @mouseleave.prevent="
                handleDragEnd($event);
                isDragging = false;
            "
            class="relative flex items-center justify-between p-3 transition-all duration-200 ease-in-out rounded-lg bg-blue-50"
            :class="{
                'shadow-lg': Math.abs(dragState.dragOffset) > 50,
                'bg-red-100': Math.abs(dragState.dragOffset) > 100
            }"
        >
            <div class="flex-grow">
                <div class="font-semibold text-gray-800" x-text="item.name"></div>
                <div class="text-sm font-bold text-blue-600" x-text="item.description"></div>
            </div>
            <div class="flex items-center space-x-2">
                <button
                    class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full"
                    @click="updateQuantity(index, -1)"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>
                </button>
                <span class="px-2 font-semibold" x-text="item.quantity"></span>
                <button
                    class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full"
                    @click="updateQuantity(index, 1)"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>
            <div class="ml-4 font-bold text-blue-600" x-text="`${(item.price * item.quantity).toFixed(2)}`"></div>
        </div>
    </template>
</div>

<!-- Modal Overlay -->
<div

    x-show="editModalOpen"

    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    {{-- class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" --}}

    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    x-cloak

>
    <!-- Modal Container -->
    <div
            class="relative p-6 bg-white rounded-lg shadow-xl w-96"
            x-show="editModalOpen"
    >
        <!-- Close Button -->
        <button
            @click="closeEditModal()"
            class="absolute text-gray-600 top-4 right-4 hover:text-red-700"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="mb-4 text-2xl font-bold">Edit Item</h2>

        <!-- Item Name -->
        <div class="mb-4">
            <label class="block mb-2 text-sm font-bold text-gray-700" for="item-name">
                Name
            </label>
            <input
                id="item-name"
                x-model="editedItem.name"
                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                type="text"
                wire:model.lazy="product"
                @input="$wire.set('product', editedItem.name)"

            >
        </div>

        <!-- Item Description -->
        <div class="mb-4">
            <label class="block mb-2 text-sm font-bold text-gray-700" for="item-description">
                Description
            </label>
            <input
                id="item-description"
                x-model="editedItem.description"
                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                type="text"
            >
        </div>

        <!-- Item Quantity -->
        <div class="mb-4">
            <label class="block mb-2 text-sm font-bold text-gray-700">
                Quantity
            </label>
            <div class="flex items-center space-x-2">
                <button
                    @click="editedItem.quantity > 1 ? editedItem.quantity-- : null"
                    class="flex items-center justify-center w-8 h-8 transition-transform duration-100 transform bg-gray-200 rounded-full active:scale-90"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>
                </button>
                <span class="px-2 font-semibold" x-text="editedItem.quantity"></span>
                <button
                    @click="editedItem.quantity++"
                    class="flex items-center justify-center w-8 h-8 transition-transform duration-100 transform bg-gray-200 rounded-full active:scale-90"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Item Price -->
        <div class="mb-4">
            <label class="block mb-2 text-sm font-bold text-gray-700" for="item-price">
                Price
            </label>
            <input
                id="item-price"
                x-model.number="editedItem.price"
                type="number"
                step="0.01"
                min="0"
                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            >
        </div>

        <!-- Modal Actions -->
        <div class="flex justify-between mt-6">
            <button
                @click="updateItem()"
                class="px-4 py-2 font-bold text-white transition-transform duration-100 transform bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline active:scale-90"
            >
                Update
            </button>
        </div>
    </div>
</div>

<!-- Minimal Tailwind CSS Custom Animations -->
<style>
@keyframes fade-in {
    from { opacity: ; }
    to { opacity: 1; }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
                    <!-- Extra Charge Buttons -->
                    <div class="mt-8 space-y-4">
                        <div class="flex justify-center space-x-3">
                            <button
                            class="px-4 py-2 font-semibold text-white bg-green-500 rounded-md hover:bg-green-600"
                            @click="addExtraCharge(2000)">
                            +2000 DA
                            </button>
                            <button
                            class="px-4 py-2 font-semibold text-white bg-green-500 rounded-md hover:bg-green-600"
                            @click="addExtraCharge(1000)">
                            +1000 DA
                            </button>
                            <button
                            class="px-4 py-2 font-semibold text-white bg-green-500 rounded-md hover:bg-green-600"
                            @click="addExtraCharge(500)">
                            +500 DA
                            </button>

                        </div>
                        <div class="flex justify-center space-x-3">
                            <button
                            class="px-4 py-2 font-semibold text-white bg-red-500 rounded-md hover:bg-red-600"
                            @click="discount(2000)"
                            :disabled="!canApplyDiscount(2000)"
                            :class="{'opacity-50 cursor-not-allowed': !canApplyDiscount(2000)}">
                            -2000 DA
                        </button>
                        <button
                            class="px-4 py-2 font-semibold text-white bg-red-500 rounded-md hover:bg-red-600"
                            @click="discount(1000)"
                            :disabled="!canApplyDiscount(1000)"
                            :class="{'opacity-50 cursor-not-allowed': !canApplyDiscount(1000)}">
                            -1000 DA
                        </button>
                        <button
                            class="px-4 py-2 font-semibold text-white bg-red-500 rounded-md hover:bg-red-600"
                            @click="discount(500)"
                            :disabled="!canApplyDiscount(500)"
                            :class="{'opacity-50 cursor-not-allowed': !canApplyDiscount(500)}">
                            -500 DA
                        </button>
                        </div>
                    </div>

                    <!-- Total and Validate -->
                    <div class="p-4 mt-6 rounded-lg bg-blue-50">
                        <!-- Extra Charges -->
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-semibold text-green-600">Extra Charges:</span>
                            <span
                                class="text-xl font-bold text-green-700"
                                x-text="extraCharge > 0 ? '+' + extraCharge.toFixed(2) + ' DA' : '0.00 DA'">
                            </span>
                        </div>

                        <!-- Discounts -->
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-semibold text-red-600">Discounts:</span>
                            <span
                                class="text-xl font-bold text-red-700"
                                {{-- x-text="discount > 0 ? '-' + discount.toFixed(2) + ' DA' : '0.00 DA'"> --}}
                                x-text="discountAmount > 0 ? '-' + discountAmount.toFixed(2) + ' DA' : '0.00 DA'">

                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-800">Total:</span>
                            <span
                                class="text-2xl font-bold text-blue-600"
                                {{-- x-text="(totalPrice() + extraCharge).toFixed(2) + ' DA'"> --}}
                                x-text="(totalPrice() + extraCharge - discountAmount).toFixed(2) + ' DA'">

                            </span>
                        </div>
                        <button
                            class="w-full py-3 mt-4 font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700"
                            @click="validateOrder">
                            Validate Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Order Items -->

<script>
function orderApp(products) {
    return {
        products: products,
        orderItems: [],
        extraCharge: 0,
        discountAmount: 0,
        searchTerm: '',
        dragState: {
            direction: null,
            startX: 0,
            isDragging: false,
            draggedIndex: null,
            dragOffset: 0
        },
        editModalOpen: false,
        editingItem: null,
        editedItem: null,

        initializeState() {
            // Ensure everything is reset on page load
            this.editModalOpen = false;
            this.editedItem = {
                name: '',
                description: '',
                quantity: 1,
                price: 0
            };
        },
        // Existing methods...
        get filteredProducts() {
            if (!this.searchTerm) return this.products;

            return this.products.filter(product =>
                product.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                product.description.toLowerCase().includes(this.searchTerm.toLowerCase())
            );
        },

        addToOrder(product) {
            const existingItem = this.orderItems.find(item => item.id === product.id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                this.orderItems.push({
                    ...product,
                    quantity: 1
                });
            }
        },

        updateQuantity(index, change) {
            if (this.orderItems[index].quantity + change <= 0) {
                this.orderItems.splice(index, 1);

                if (this.orderItems.length === 0) {
                    this.extraCharge = 0;
                    this.discountAmount = 0;
                }
            } else {
                this.orderItems[index].quantity += change;
            }
        },

        // Enhanced drag-related methods
        initDrag(index, event) {
            this.dragState = {
                direction: null,
                startX: event.clientX,
                isDragging: true,
                draggedIndex: index,
                dragOffset: 0
            };
        },

        handleDragMove(event) {
            if (!this.dragState.isDragging) return;

            // Calculate drag distance and direction
            const dragDistance = event.clientX - this.dragState.startX;
            this.dragState.dragOffset = dragDistance;
            this.dragState.direction = dragDistance > 0 ? 'right' : '';

            // Apply movement effect
            const draggedElement = document.querySelector(`[data-drag-index="${this.dragState.draggedIndex}"]`);
            if (draggedElement) {
                draggedElement.style.transform = `translateX(${dragDistance}px)`;

                // Add visual feedback for drag intensity
                if (Math.abs(dragDistance) > 50) {
                    draggedElement.classList.add('bg-red-100');
                } else {
                    draggedElement.classList.remove('bg-red-100');
                }
            }
        },

  // Drag methods remain the same as previous implementation...
  handleDragEnd(event) {
            if (!this.dragState.isDragging) return;

            const dragDistance = event.clientX - this.dragState.startX;
            const absDistance = Math.abs(dragDistance);

            // Open modal when drag exceeds 100px
            if (absDistance > 100) {
                if (this.dragState.direction === 'right') {
                    // Open edit modal
                    this.openEditModal(this.dragState.draggedIndex);
                } else if (this.dragState.direction === 'left') {
                    // Remove item
                    this.orderItems.splice(this.dragState.draggedIndex, 1);
                }
            }

            // Reset drag state and styles
            const draggedElement = document.querySelector(`[data-drag-index="${this.dragState.draggedIndex}"]`);
            if (draggedElement) {
                draggedElement.style.transform = '';
                draggedElement.classList.remove('bg-red-100');
            }

            // Reset drag state
            this.dragState = {
                direction: null,
                startX: 0,
                isDragging: false,
                draggedIndex: null,
                dragOffset: 0
            };
        },



        openEditModal(index) {
            this.$nextTick(() => {
                this.editingItem = this.orderItems[index];
                this.editedItem = { ...this.editingItem };
                this.editModalOpen = true;
            });
        },


        updateItem() {
            const index = this.orderItems.findIndex(item => item.id === this.editingItem.id);

            if (index !== -1) {
                this.orderItems[index] = { ...this.editedItem };
            }

            this.editModalOpen = false;
        },

        closeEditModal() {
            this.editModalOpen = false;

            this.$nextTick(() => {
                this.editingItem = null;
                this.editedItem = null;
            });
        },

        // Existing methods continue...
        clearOrder() {
            this.orderItems = [];
            this.extraCharge = 0;
            this.discountAmount = 0;
            this.searchTerm = "";
        },

        addExtraCharge(amount) {
            this.extraCharge += amount;
        },

        discount(amount) {
            const currentTotal = this.totalPrice() + this.extraCharge;

            if (currentTotal >= amount) {
                this.discountAmount += amount;
            } else {
                alert('Discount amount exceeds current total.');
            }
        },

        canApplyDiscount(amount) {
            if (this.orderItems.length === 0) {
                return false;
            }

            const currentTotal = this.totalPrice() + this.extraCharge;

            return currentTotal >= amount &&
                   (currentTotal - this.discountAmount - amount) >= 0;
        },

        calculateTotal() {
            const subtotal = this.totalPrice();
            return Math.max(0, subtotal + this.extraCharge - this.discountAmount);
        },

        totalPrice() {
            return this.orderItems.reduce((total, item) => total + item.price * item.quantity, 0);
        },

        validateOrder() {
            alert('Order validated! Total: ' + this.calculateTotal().toFixed(2) + ' DA');
        }
    }
}
</script>