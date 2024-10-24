<template>
    <div>
        <NuxtLayout name="admin">
            <main class="w-full mx-auto">
                <!-- Sales Details Input -->
                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-center">Sales Details</h2>
                    <div class="space-y-4">
                        <!-- Row 1 -->
                        <div class="flex items-center space-x-4 mt-8">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Sales Invoice ID</label>
                                <input v-model="salesDetails.sales_invoice_id" type="text"
                                    class="block w-full mt-3 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Product ID</label>
                                <input v-model="salesDetails.product_id" type="text"
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="flex items-center space-x-4">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Quantity Sold</label>
                                <input v-model.number="salesDetails.quantity_sold" type="text" @input="calculateTotal"
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Price</label>
                                <input v-model.number="salesDetails.price" type="text" @input="calculateTotal"
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                        </div>

                        <!-- Row 3 -->
                        <div class="flex items-center space-x-4">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Discount</label>
                                <input v-model.number="salesDetails.discount" type="text" @input="calculateTotal"
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Tax Amount</label>
                                <input v-model.number="salesDetails.tax_amount" type="text" @input="calculateTotal"
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                        </div>

                        <!-- Row 4 -->
                        <div class="flex items-center space-x-4">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Total</label>
                                <div class="flex items-center space-x-4">
                                    <input v-model="salesDetails.total" type="text"
                                        class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3"
                                        readonly />
                                    <button @click="addSales"
                                        class="rounded-md bg-gray-900 px-6 py-1 text-xs font-semibold text-white hover:bg-gray-800">Add
                                        Sales</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales List Table -->
                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-md mt-2">
                        <thead>
                            <tr class="text-left">
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900 rounded-tl-lg">Sales
                                    Invoice ID</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">Product ID</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">Quantity Sold</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">Price</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">Discount</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">Tax Amount</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">Total</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900 rounded-tr-lg">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100">
                            <tr v-for="(sale, index) in sales" :key="sale.sales_invoice_id" class="border-t bg-gray-50">
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.sales_invoice_id }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.product_id }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.quantity_sold }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.price }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.discount }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.tax_amount }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.total }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">
                                    <div class="flex space-x-2">
                                        <button @click="editSale(index)" class="text-gray-600 hover:text-gray-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0l-10 10V16a1 1 0 001 1h3.414l10-10a2 2 0 000-2.828l-1.586-1.586zM5 13l-1.5 1.5V13h1.5zm4.5-4.5L14 4l2 2-4.5 4.5H9.5V8.5z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteSale(index)" class="text-red-600 hover:text-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a2 2 0 00-2 2v1H2v2h1v9a2 2 0 002 2h8a2 2 0 002-2V7h1V5h-2V4a2 2 0 00-2-2H6zm4 12a1 1 0 102 0V8a1 1 0 10-2 0v6zm-3-1a1 1 0 002 0V8a1 1 0 10-2 0v5zm8-1a1 1 0 10-2 0V8a1 1 0 102 0v5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="sales.length === 0">
                                <td colspan="8" class="px-4 py-2 text-xxs text-gray-500 text-center bg-gray-100">No
                                    sales available.</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Save and Cancel Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button @click="saveSalesDetails"
                            class="rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold text-white hover:bg-gray-800">Save</button>
                        <button @click="cancel"
                            class="rounded-md bg-gray-300 px-4 py-2 text-xs font-semibold text-gray-800 hover:bg-gray-400">Cancel</button>
                    </div>
                </div>
            </main>
        </NuxtLayout>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const salesDetails = ref({
    sales_invoice_id: '',
    product_id: '',
    quantity_sold: 0,
    price: 0,
    discount: 0,
    tax_amount: 0,
    total: 0,
});

const sales = ref<Array<{
    sales_invoice_id: string,
    product_id: string,
    quantity_sold: number,
    price: number,
    discount: number,
    tax_amount: number,
    total: number
}>>([]);

function redirectToSalesInvoice() {
    router.push({ name: 'salesinvoice' });
}

function saveSalesDetails() {
    console.log('Sales details saved:', salesDetails.value);
    redirectToSalesInvoice();
}

function cancel() {
    redirectToSalesInvoice();
}

function editSale(index: number) {
    // Implement your edit logic here
}

function deleteSale(index: number) {
    sales.value.splice(index, 1);
}

function addSales() {
    calculateTotal();
    sales.value.push({ ...salesDetails.value });
    resetSalesDetails();
}

function resetSalesDetails() {
    salesDetails.value = {
        sales_invoice_id: '',
        product_id: '',
        quantity_sold: 0,
        price: 0,
        discount: 0,
        tax_amount: 0,
        total: 0,
    };
}

function calculateTotal() {
    const { quantity_sold, price, discount, tax_amount } = salesDetails.value;
    const subtotal = quantity_sold * price;
    const discountAmount = (discount / 100) * subtotal;
    const totalWithTax = subtotal - discountAmount + tax_amount;
    salesDetails.value.total = Number(totalWithTax.toFixed(2));
}
</script>
