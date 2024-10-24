<template>
    <div>
        <NuxtLayout name="admin">
            <main>
                <!-- Search and Add Product Button Container -->
                <div class="relative flex items-center space-x-4 mt-3">
                    <!-- Search Bar -->
                    <div class="relative flex flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="absolute left-2 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-500"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 3a6 6 0 11-6 6 6 6 0 016-6zM2 9a7 7 0 1114 0A7 7 0 012 9zm11.293 4.293a1 1 0 00-1.415-1.414L10 12.586l-1.879-1.878a1 1 0 00-1.415 1.414L8.586 14l-1.879 1.879a1 1 0 001.415 1.415L10 15.414l1.879 1.879a1 1 0 001.415-1.415L11.414 14l1.879-1.879a1 1 0 000-1.415z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="text" placeholder="Search"
                            class="block w-70 rounded-md border border-gray-400 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs pl-8 pr-2 py-1.5" />
                    </div>

                    <!-- Add Product Button -->
                    <button @click="toggleForm" type="button"
                        class="rounded-md bg-gray-900 px-3 py-2 text-center text-xxs font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900 flex items-center justify-center gap-2">
                        <PlusIcon class="h-3 w-3" aria-hidden="true" />
                        New Payment
                    </button>
                </div>

                <!-- Payment Form -->
                <div v-if="showForm" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                        <form @submit.prevent="submitPayment">
                            <div class="grid grid-cols-1 gap-4">
                                <div class="flex items-center">
                                    <label for="paymentType" class="text-xxs font-medium text-gray-700 w-24">Payment
                                        Type</label>
                                    <select id="paymentType" v-model="payment.payment_type"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm px-3 py-2"
                                        required>
                                        <option value="" disabled>Select Payment Type</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>

                                <div class="flex items-center">
                                    <label for="paymentDate" class="text-xxs font-medium text-gray-700 w-24">Payment
                                        Date</label>
                                    <input id="paymentDate" v-model="payment.payment_date" type="date"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm px-3 py-2"
                                        required />
                                </div>
                                <div class="flex items-center">
                                    <label for="supplier"
                                        class="text-xxs font-medium text-gray-700 w-24">Supplier</label>
                                    <select id="supplier" v-model="payment.supplier"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm px-3 py-2"
                                        required>
                                        <!-- <option value="" disabled>Select Supplier</option>
                        <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.name">
                        {{ supplier.name }}
                        </option> -->
                                    </select>
                                </div>

                                <div class="flex items-center">
                                    <label for="cashVoucherNo" class="text-xxs font-medium text-gray-700 w-24">Cash
                                        Voucher No</label>
                                    <input id="cashVoucherNo" v-model="payment.cash_voucher_no" type="text"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm px-3 py-2" />
                                </div>
                                <div class="flex items-center">
                                    <label for="isCancelled" class="text-xxs font-medium text-gray-700 w-24">Is
                                        Cancelled</label>
                                    <select id="isCancelled" v-model="payment.is_cancelled"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <label for="preparedById" class="text-xxs font-medium text-gray-700 w-24">Prepared
                                        By ID</label>
                                    <input id="preparedById" v-model="payment.prepared_by_id" type="text"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm px-3 py-2" />
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="submit"
                                    class="rounded-md bg-gray-900 px-4 py-2 text-xxs font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Save
                                </button>
                                <button @click="toggleForm" type="button"
                                    class="rounded-md bg-gray-200 px-4 py-2 text-xxs font-semibold text-gray-700 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payments List Table -->
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-md mt-2 rounded-b-lg">
                        <thead>
                            <tr class="text-left">
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">payment_type</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">payment_date</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">supplier</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">cash_voucher_no</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">is_cancelled</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900">prepared_by_id</th>
                                <th class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900 rounded-tr-lg">
                                    actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100">
                            <tr v-for="(payment, index) in paginatedPayments" :key="index" class="border-t bg-gray-50">
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ payment.payment_type }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ payment.payment_date }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ payment.supplier }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ payment.cash_voucher_no }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ payment.is_cancelled }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ payment.prepared_by_id }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">
                                    <div class="flex space-x-2">
                                        <button @click="editPayment(index)" class="text-gray-600 hover:text-gray-900">
                                            <!-- Edit Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0l-10 10V16a1 1 0 001 1h3.414l10-10a2 2 0 000-2.828l-1.586-1.586zM5 13l-1.5 1.5V13h1.5zm4.5-4.5L14 4l2 2-4.5 4.5H9.5V8.5z" />
                                            </svg>
                                        </button>
                                        <button @click="deletePayment(index)" class="text-red-600 hover:text-red-900">
                                            <!-- Delete Icon -->
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
                            <tr v-if="payments.length === 0">
                                <td colspan="7" class="px-4 py-2 text-xxs text-gray-500 text-center bg-gray-100">No
                                    payments available.</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-xxs text-gray-700 ml-1">Page {{ currentPage }} of {{ totalPages }}</span>
                        <div class="flex space-x-2">
                            <button @click="previousPage" :disabled="currentPage === 1"
                                class="px-4 py-2 text-xxs font-semibold text-gray-900 bg-gray-200 rounded-md hover:bg-gray-300 disabled:bg-gray-100">
                                Previous
                            </button>
                            <button @click="nextPage" :disabled="currentPage === totalPages"
                                class="px-4 py-2 text-xxs font-semibold text-white bg-gray-900 rounded-md hover:bg-gray-800 disabled:bg-gray-700">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </NuxtLayout>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { PlusIcon } from '@heroicons/vue/24/outline';

const showForm = ref(false);
const payment = ref({
    payment_type: '',
    payment_date: '',
    supplier: '',
    cash_voucher_no: '',
    is_cancelled: 'No',
    prepared_by_id: ''
});
const payments = ref<Array<{
    payment_type: string,
    payment_date: string,
    supplier: string,
    cash_voucher_no: string,
    is_cancelled: string,
    prepared_by_id: string
}>>([]);
const currentPage = ref(1);
const itemsPerPage = 10;
let editingIndex = ref<number | null>(null);

const totalPages = computed(() => Math.ceil(payments.value.length / itemsPerPage));

const paginatedPayments = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return payments.value.slice(start, end);
});

function toggleForm() {
    showForm.value = !showForm.value;
    if (!showForm.value) {
        editingIndex.value = null;
        resetPaymentForm();
    }
}

function resetPaymentForm() {
    payment.value = {
        payment_type: '',
        payment_date: '',
        supplier: '',
        cash_voucher_no: '',
        is_cancelled: 'No',
        prepared_by_id: ''
    };
}

function submitPayment() {
    if (isPaymentFormValid()) {
        if (editingIndex.value !== null) {
            // Update the existing payment.
            payments.value[editingIndex.value] = { ...payment.value };
            editingIndex.value = null;
        } else {
            // Add a new payment.
            payments.value.push({ ...payment.value });
        }
        resetPaymentForm();
        showForm.value = false;
    }
}

function isPaymentFormValid() {
    return payment.value.payment_type.trim() !== '' &&
        payment.value.supplier.trim() !== '';
}

function editPayment(index: number) {
    payment.value = { ...payments.value[index] };
    editingIndex.value = index;
    showForm.value = true; // Open the form for editing.
}

function deletePayment(index: number) {
    payments.value.splice(index, 1);
}

function previousPage() {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
}

function nextPage() {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
}
</script>