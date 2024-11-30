<body class="antialiased bg-gray-100">
    <div
        x-data="orderApp({{ $product->toJson() }})"
        class="container max-w-6xl px-4 py-8 mx-auto">
        <div class="bg-white shadow-2xl rounded-xl">
            <div class="flex flex-col md:flex-row">
                <!-- Left Section: Product List -->
                <div class="w-full p-6 md:w-3/5 bg-gray-50">
                    <h2 class="pb-3 mb-6 text-2xl font-bold text-gray-800 border-b">
                        Available Products
                    </h2>

                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 overflow-y-scroll no-scrollbar max-h-[100vh]">
                        <template x-for="product in products" :key="product.id">
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
                        class="px-4 py-2 font-semibold text-red-500 bg-red-200 rounded-md hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300"
                        @click="clearOrder">
                            Clear All
                        </button>
                    </div>

                    <!-- Order Items -->
                    <div class="space-y-4 max-h-[40vh] overflow-y-scroll no-scrollbar ">
                        <template x-for="(item, index) in orderItems" :key="item.id">
                            <div class="flex items-center justify-between p-3 rounded-lg bg-blue-50">
                                <div class="flex-grow ">
                                    <div class="font-semibold text-gray-800" x-text="item.name"></div>
                                    <div class="text-sm font-bold text-blue-600" x-text="item.description"></div>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <button
                                        class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full "
                                        @click="updateQuantity(index, -1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                        </svg>
                                    </button>
                                    <span class="px-2 font-semibold" x-text="item.quantity"></span>
                                    <button
                                        class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full"
                                        @click="updateQuantity(index, 1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                          </svg>

                                    </button>
                                </div>

                                <div class="ml-4 font-bold text-blue-600" x-text="`${(item.price * item.quantity).toFixed(2)}`"></div>
                            </div>
                        </template>
                    </div>

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

    <script>
function orderApp(products) {
    return {
        products: products,
        orderItems: [],
        extraCharge: 0,
        discountAmount: 0,

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

        clearOrder() {
            this.orderItems = [];
            this.extraCharge = 0;
            this.discountAmount = 0;
        },

        addExtraCharge(amount) {
            this.extraCharge += amount;
        },

        discount(amount) {
            // Get the current total (products + extra charges)
            const currentTotal = this.totalPrice() + this.extraCharge;

            // Only apply discount if it doesn't make total negative
            if (currentTotal >= amount) {
                this.discountAmount += amount;
            } else {
                alert('Discount amount exceeds current total.');
            }
        },

        // Comprehensive method to check if a specific discount can be applied
        canApplyDiscount(amount) {
            // No items in the order
            if (this.orderItems.length === 0) {
                return false;
            }

            // Calculate current total (products + extra charges)
            const currentTotal = this.totalPrice() + this.extraCharge;

            // Check multiple conditions:
            // 1. Total must be greater than or equal to discount amount
            // 2. Applying discount won't make total negative
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
