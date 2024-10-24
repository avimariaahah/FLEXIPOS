<template>
    <div>
        <NuxtLayout name="admin">
            <main class="w-full mx-auto">

                <Head>
                    <Title>Sales Invoice - {{ runtimeConfig.public.appName }}</Title>
                </Head>
                <!-- Sales Details Input -->
                <div class="mt-4">
                    <h2 class="text-lg font-semibold">SALES INVOICE DETAILS</h2>
                    <div class="space-y-4">
                        <!-- Row 1 sales details -->
                        <div class="flex items-center space-x-4 mt-8">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Invoice Number</label>
                                <input v-model="salesInvoice.invoice_no" type="text"
                                    class="block w-full mt-3 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">remarks</label>
                                <input v-model="salesInvoice.remarks" type="text"
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                        </div>
                        <!-- Row 2 sales details -->
                        <div class="flex items-center space-x-4 mt-8">
                            <div class="w-1/2">
                                <FormLabel label="Customer" />
                                <FormSelect id="product_category_id" v-model="customer.id"
                                    :options="state.customers.filter(customer => customer.is_active).map(customer => ({ value: customer.id, label: customer.firstname + ' ' + customer.lastname }))"
                                    placeholder="select customer" required />
                            </div>
                            <div class="w-1/2">
                                <FormLabel label="Sales Representative" />
                                <FormSelect id="employee" v-model="employee.id"
                                    :options="state.employees.filter(employee => employee.is_active).map(employee => ({ value: employee.id, label: employee.firstname + ' ' + employee.lastname }))"
                                    placeholder="select customer" required />
                            </div>
                        </div>
                        <!-- Row 3 sales details -->
                        <div class="flex items-center space-x-4 mt-8">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Date</label>
                                <input id="date" type="date" v-model="salesInvoice.date"
                                    class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm px-3 py-2"
                                    required />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Due Date</label>
                                <input id="paymentDate" type="date" v-model="salesInvoice.due_date"
                                    class="block rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm px-3 py-2"
                                    required />
                            </div>
                        </div>

                        <!-- Row 1 -->
                        <div class="flex items-center space-x-4 mt-8">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Sales Invoice No</label>
                                <input v-model="salesInvoiceDetail.sales_invoice_id" type="text"
                                    class="block w-full mt-3 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Product ID</label>
                                <input v-model="salesInvoiceDetail.product_id" type="text"
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                        </div>


                        <!-- Row 2 -->
                        <div class="flex items-center space-x-4">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Quantity Sold</label>
                                <input v-model.number="salesInvoiceDetail" type="text" @input=""
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Price</label>
                                <input v-model.number="salesInvoiceDetail.price" type="text" @input=""
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                        </div>

                        <!-- Row 3 -->
                        <div class="flex items-center space-x-4">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Discount</label>
                                <input v-model.number="salesInvoiceDetail" type="text" @input=""
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Tax Amount</label>
                                <input v-model.number="salesInvoiceDetail" type="text" @input=""
                                    class="block w-full bg-gray-100 mt-3 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 text-sm p-3" />
                            </div>
                        </div>

                        <!-- Row 4 -->
                        <div class="flex items-center space-x-4">
                            <div class="w-1/2">
                                <label class="block text-xs font-medium text-gray-700">Total</label>
                                <div class="flex items-center space-x-4">
                                    <input v-model="salesInvoiceDetail" type="text"
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
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.barcode }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.quantity }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.unit }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.expiry_date }}</td>
                                <td class="px-4 py-2 text-xxs text-gray-700">{{ sale.price }}</td>
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
import { customerService } from '~/components/api/admin/CustomerService';
import { useAlert } from '@/composables/alert';
import { useI18n } from 'vue-i18n';
import { employeeService } from '~/components/api/admin/EmployeeService';

// Alert and i18n setup
const { successAlert } = useAlert();
const { errorAlert } = useAlert();
const { warningAlert } = useAlert();
const { t } = useI18n()

const runtimeConfig = useRuntimeConfig();

const router = useRouter();

interface Customer {
    id: string;
    firstname: string;
    lastname: string;
    email: string;
    phone: string;
    address: string;
    is_active: boolean;
}

interface Employee {
    id: string;
    firstname: string;
    lastname: string;
    email: string;
    phone: string;
    position: string;
    is_active: boolean;
}

const customer = ref({
    id: '',
    firstname: '',
    lastname: '',
    email: '',
    phone: '',
    address: '',
    is_active: true,
});

const employee = ref({
    id: '',
    firstname: '',
    lastname: '',
    email: '',
    phone: '',
    position: '',
    is_active: true,
});

const salesInvoice = ref({
    id: '',
    branch_id: '',
    sales_order_id: '',
    customer_id: '',
    prepared_by_id: '',
    cancelled_by_id: '',
    approved_by_id: '',
    invoice_no: '',
    sales_invoice_ref_doc_no: '',
    date: '',
    due_date: '',
    terms: '',
    is_cancelled: false,
    is_approved: false,
    remarks: '',
});

const salesInvoiceDetail = ref({
    sales_invoice_id: '',
    product_id: '',
    barcode: '',
    unit: '',
    expiry_date: '',
    quantity: 0,
    price: 0,
});

const sales = ref<Array<{
    sales_invoice_id: string,
    product_id: string,
    barcode: string,
    unit: string,
    expiry_date: string,
    quantity: number,
    price: number,
}>>([]);

const state = reactive({
    error: null as Error | null,
    isTableLoading: false,
    customers: [] as Customer[],
    employees: [] as Employee[],
    salesInvoiceDetail: [] as any,
    sales,
});

function redirectToSalesInvoice() {
    navigateTo("/admin/sales_invoice");
}

function saveSalesDetails() {
    console.log('Sales details saved:', salesInvoiceDetail.value);
    redirectToSalesInvoice();
    successAlert('Sucess', 'Sales invoice saved successfully!');
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
    sales.value.push({ ...salesInvoiceDetail.value });
    resetSalesDetails();
}

function resetSalesDetails() {
    salesInvoiceDetail.value = {
        sales_invoice_id: '',
        product_id: '',
        barcode: '',
        unit: '',
        expiry_date: '',
        quantity: 0,
        price: 0,
    };
}

async function fetchCustomers() {
    state.isTableLoading = true;
    state.error = null;
    try {
        const response = await customerService.getCustomers();
        state.customers = response.data.filter((customer: Customer) => customer.is_active); // Filter active customers
        console.log('Fetched customers:', state.customers); // Log fetched active customers
    } catch (error: any) {
        state.error = error;
    } finally {
        state.isTableLoading = false;
    }
}

async function fetchEmployees() {
    state.isTableLoading = true;
    state.error = null;
    try {
        const response = await employeeService.getEmployees();
        state.employees = response.data.filter((employee: Employee) => employee.is_active); // Filter active customers
        console.log('Fetched employees:', state.employees); // Log fetched active customers
    } catch (error: any) {
        state.error = error;
    } finally {
        state.isTableLoading = false;
    }
}

onMounted(() => {
    fetchCustomers();
    fetchEmployees();
});
</script>
