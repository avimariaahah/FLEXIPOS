<template>
    <div>
        <NuxtLayout name="admin">
            <main class="w-full mx-auto">

                <Head>
                    <Title>Bills Payment - {{ runtimeConfig.public.appName }}</Title>
                </Head>
                <div>
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex">
                            <h2 class="bg-white text-lg font-semibold">BILLS PAYMENT</h2>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 mt-8">
                            <div class="w-1/2">
                                <FormLabel label="Supplier" />
                                <FormSelect id="supplier_id" v-model="state.selectedSupplierId"
                                    :options="state.suppliers.map(s => ({ value: s.id, label: s.name }))"
                                    placeholder="select supplier" required />
                            </div>
                            <div class="w-1/2">
                                <FormLabel label="Is Cancelled" />
                                <FormSelect v-model="payment.is_cancelled" :options="[
                                    { value: false, label: 'No' },
                                    { value: true, label: 'Yes' },
                                ]">
                                </FormSelect>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 mt-8">
                            <div class="w-1/4">
                                <FormLabel label="Payment Type" />
                                <FormSelect v-model="payment.payment_type" :options="[
                                    { value: 'cash', label: 'Cash' },
                                    { value: 'cheque', label: 'Cheque' },
                                    { value: 'gcash', label: 'Gcash' },
                                ]">
                                </FormSelect>
                            </div>
                            <div class="w-1/4">
                                <FormLabel label="Cash Voucher Number" />
                                <FormTextField id="cashvoucher" name="cashvoucher" placeholder="voucher number" />
                            </div>
                            <div class="w-1/4">
                                <FormLabel label="Date" />
                                <FormTextField id="cashvoucher" name="cashvoucher" placeholder="mm/dd/yyyy" />
                            </div>
                            <div class="w-1/4">
                                <FormLabel label="Prepared By" />
                                <FormNumberField for="prepared_by_id" name="prepared_by_id"
                                    :placeholder="`${firstname} ${lastname}`" :value="`${firstname} ${lastname}`"
                                    readonly class="block cursor-default bg-gray-200" />
                            </div>
                        </div>
                        <div v-if="state.selectedSupplierId" class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300" />
                            </div>
                            <div class="relative flex">
                                <h2 class="bg-white text-lg font-semibold">BILLS DETAILS</h2>
                            </div>
                        </div>
                        <div v-if="state.selectedSupplierId" class="flex mt-8">
                            <div class="w-6/12">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300" />
                                    </div>
                                    <div class="relative flex">
                                        <h2 class="bg-white text-lg font-normal">Unpaid Bills</h2>
                                    </div>
                                </div>
                                <!-- Product Table -->
                                <Alert type="danger" :text="state.error?.message" v-if="state.error" />
                                <div class="table-responsive">
                                    <Table :columnHeaders="state.unpaidBillColumnHeader" :data="state.unpaidBills"
                                        :isLoading="state.isTableLoading" :sortData="state.sortData" @sort="sort">
                                        <template #body v-if="!state.isTableLoading && state.unpaidBills?.data.length">
                                            <tr v-for="(bill, index) in state.unpaidBills?.data" :key="index">
                                                <td class="pl-3">
                                                    {{ bill.id }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.purchase_order_no }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.bill_date }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.amount }}
                                                </td>
                                                <td class="pl-3">
                                                    <FormButton button-style="warning" @click="selectBill(bill)">Select
                                                    </FormButton>
                                                </td>
                                            </tr>
                                        </template>
                                    </Table>
                                </div>
                                <!-- <Pagination :data="state.categories" @previous="previous" @next="next" /> -->
                            </div>
                            <div class="w-6/12">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300" />
                                    </div>
                                    <div class="relative flex">
                                        <h2 class="bg-white text-lg font-normal">Selected Bills</h2>
                                    </div>
                                </div>
                                <!-- Product table -->
                                <Alert type="danger" :text="state.error?.message" v-if="state.error" />
                                <div class="table-responsive">
                                    <Table :columnHeaders="state.selectedBillColumnHeader" :data="state.selectedBills"
                                        :isLoading="state.isTableLoading" :sortData="state.sortData" @sort="sort">
                                        <template #body
                                            v-if="!state.isTableLoading && state.selectedBills?.data.length">
                                            <tr v-for="(bill, index) in state.selectedBills?.data" :key="index">
                                                <td class="pl-3">
                                                    {{ bill.id }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.purchase_order_no }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.bill_date }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.amount }}
                                                </td>
                                                <td class="pl-3">
                                                    <FormNumberField id="paymentamount" name="paymentamount"
                                                        v-model="paymentAmountNumber.toString"
                                                        placeholder="Payment Amount" />
                                                </td>
                                            </tr>
                                        </template>
                                    </Table>
                                </div>
                                <!-- <Pagination :data="state.categories" @previous="previous" @next="next" /> -->
                            </div>
                        </div>
                        <div v-if="state.selectedSupplierId" class="flex space-x-4 mt-8">
                            <div v-if="payment.payment_type === 'cheque'" class="w-6/12">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300" />
                                    </div>
                                    <div class="relative flex">
                                        <h2 class="bg-white text-lg font-normal">Cheque Details</h2>
                                    </div>
                                </div>
                                <!-- Product table -->
                                <Alert type="danger" :text="state.error?.message" v-if="state.error" />
                                <div class="table-responsive">
                                    <Table :columnHeaders="state.selectedBillColumnHeader" :data="state.selectedBills"
                                        :isLoading="state.isTableLoading" :sortData="state.sortData" @sort="sort">
                                        <template #body
                                            v-if="!state.isTableLoading && state.selectedBills?.data.length">
                                            <tr v-for="(bill, index) in state.selectedBills?.data" :key="index">
                                                <td class="pl-3">
                                                    {{ bill.id }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.purchase_order_no }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.bill_date }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ bill.amount }}
                                                </td>
                                                <td class="pl-3">
                                                    <FormNumberField id="paymentamount" name="paymentamount"
                                                        v-model="paymentAmountNumber.toString" placeholder="0" />
                                                </td>
                                            </tr>
                                        </template>
                                    </Table>
                                </div>
                                <!-- <Pagination :data="state.categories" @previous="previous" @next="next" /> -->
                            </div>
                            <div class="w-1/2">
                                <FormButton v-if="payment.payment_type === 'cheque'" button-style="xxx">Add Cheque
                                </FormButton>
                                <FormLabel v-if="payment.payment_type === 'cheque'" label="Cheque Amount" />
                                <FormNumberField v-if="payment.payment_type === 'cheque'" v-model="payment.cheque"
                                    name="chequeamount" placeholder="Cheque Amount" />
                                <FormLabel v-if="payment.payment_type === 'gcash'" label="Gcash Amount" />
                                <FormNumberField v-if="payment.payment_type === 'gcash'" v-model="payment.gcash"
                                    name="gcashamount" placeholder="Gcash Amount" />
                                <FormLabel v-if="payment.payment_type === 'gcash'" label="Gcash Reference Number" />
                                <FormNumberField v-if="payment.payment_type === 'gcash'"
                                    v-model="payment.gcashreference" name="gcashreference"
                                    placeholder="Gcash Reference Number" />
                                <FormLabel label="Cash Amount" />
                                <FormNumberField v-model="payment.cash" name="cashamount" placeholder="Cash Amount" />
                                <FormLabel label="Total Amount" />
                                <FormNumberField v-model="paymentAmountNumber" name="totalamount"
                                    placeholder="Total Amount" />
                            </div>
                        </div>
                        <div v-if="isPaymentAmountValid" class="flex space-x-4 mt-8">
                            <div class="w-full">
                                <FormButton class="w-full" button-style="success" @click="makePayment">Make Payment
                                </FormButton>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </NuxtLayout>
    </div>
</template>

<script setup lang="ts">
import { reactive, onMounted } from 'vue';
import type { Error } from '@/types/error';
import { supplierService } from '~/components/api/admin/SupplierService';
import { billService } from '~/components/api/admin/BillService';
import { useI18n } from 'vue-i18n';

// Alert and i18n setup
const { successAlert } = useAlert();
const { errorAlert } = useAlert();
const { warningAlert } = useAlert();
const { t } = useI18n()

const user_id = computed(() => localStorage.getItem('user_id'));
const firstname = computed(() => localStorage.getItem('firstname'));
const lastname = computed(() => localStorage.getItem('lastname'));
const runtimeConfig = useRuntimeConfig();

let currentTablePage = 1;

interface UnpaidBill {
    data: any[];
}

interface SelectedBill {
    data: any[];
}

interface SortData {
    sortField: string;
    sortOrder: "ascend" | "descend" | null;
}

const isPaymentAmountValid = computed(() => {
    return parseFloat(payment.amount) > 0;
});

const paymentAmountNumber = computed<string>({
    get() {
        return Number(payment.gcash) + Number(payment.cheque) + Number(payment.cash); // return as string
    },
    set(value) {
        payment.amount = value; // directly set as string
    },
});

function sort(sortingData: { column: string; sort: string }) {
    currentTablePage = 1;
    if (sortingData.sort === 'ascend' || sortingData.sort === 'descend') {
        state.sortData = {
            sortField: sortingData.column,
            sortOrder: sortingData.sort,
        };
    } else {
        console.error('Invalid sort order:', sortingData.sort);
        state.sortData = {
            sortField: sortingData.column,
            sortOrder: 'ascend',
        };
    }
    fetchBills();
}

async function makePayment() {
    successAlert('Payment successful!', 'Your payment has been successfully made.');
    navigateTo('/admin/payments');
}

async function fetchBills() {
    state.error = null;
    state.isTableLoading = true;

    try {
        // Fetch all bills
        const response = await billService.getBills();
        console.log("Fetched bills:", response.data);  // Debug: Log all fetched bills

        // Filter bills by selected supplier ID if it exists
        if (state.selectedSupplierId) {
            const filteredBills = response.data.filter((bill: any) => {
                console.log("Checking bill supplier:", bill.supplier_id, "against", state.selectedSupplierId);
                return String(bill.supplier_id) === String(state.selectedSupplierId);
            });

            state.unpaidBills = { data: filteredBills };
        } else {
            // If no supplier is selected, show all bills
            state.unpaidBills = response;
        }

    } catch (error: any) {
        state.error = error;
    }

    state.isTableLoading = false;
}

interface Supplier {
    id: string;
    name: string;
    email: string;
    phone: string;
    address: string;
    is_active: boolean;
}

const supplier = reactive({
    id: '',
    name: '',
    email: '',
    phone: '',
    address: '',
    is_active: true,
});

interface Payment {
    supplier_id: string;
    payment_type: string;
    voucher_number: string;
    date: string;
    amount: string;
    is_cancelled: boolean;
}

const payment = reactive({
    supplier_id: '',
    payment_type: 'cash',
    voucher_number: '',
    date: '',
    gcash: '',
    gcashreference: '',
    cheque: '',
    cash: '',
    amount: '',
    is_cancelled: false,
});

const state = reactive({
    unpaidBillColumnHeader: [
        { name: "ID", sorter: true, key: "id" },
        { name: "P.O. Number", sorter: true, key: "poNumber" },
        { name: "Date", sorter: true, key: "date" },
        { name: "Balance", sorter: true, key: "amount" },
        { name: "Actions", sorter: true, key: "actions" },
    ],
    selectedBillColumnHeader: [
        { name: "ID", sorter: true, key: "id" },
        { name: "P.O. Number", sorter: true, key: "poNumber" },
        { name: "Date", sorter: true, key: "date" },
        { name: "Amount", sorter: true, key: "amount" },
        { name: "Amount to pay", sorter: true, key: "paymentamount" },
    ],
    isTableLoading: false,
    error: null as Error | null,
    sortData: { sortField: 'id', sortOrder: 'ascend' } as SortData,
    unpaidBills: { data: [] } as UnpaidBill,
    selectedBills: { data: [] } as SelectedBill,
    suppliers: [] as Supplier[],
    payments: [] as Payment[],
    selectedSupplierId: null as number | null,
});

async function fetchSuppliers() {
    try {
        const response = await supplierService.getSuppliers();
        console.log(response);  // Log to see if the data structure matches expectations
        state.suppliers = response.data.filter((supplier: Supplier) => supplier.is_active);
    } catch (error) {
        console.error(error);
    }
}

function selectBill(bill: any) {
    // Remove the selected bill from unpaidBills and add it to selectedBills
    const index = state.unpaidBills.data.findIndex((b) => b.id === bill.id);
    if (index !== -1) {
        // Move the bill to selectedBills
        state.selectedBills.data.push(state.unpaidBills.data.splice(index, 1)[0]);
    }
}

// watch(() => payment.amount, (newAmount) => {
//     console.log('Payment amount changed:', newAmount);
// });

watch(
    () => state.selectedSupplierId,
    (newValue, oldValue) => {
        console.log("Supplier changed from", oldValue, "to", newValue);  // Debug: Log supplier change
        fetchBills();
        state.selectedBills.data = [];
    }
);

watch(
    () => supplier.id,
    (newSupplierID) => {
        // Find the selected product based on the selected product_id
        const selectedSupplier = state.suppliers.find(supplier => supplier.id === newSupplierID);

        // Update the name in billDetail if the selected product exists
        if (selectedSupplier) {
            supplier.name = selectedSupplier.name;
            supplier.email = selectedSupplier.email;
            supplier.phone = selectedSupplier.phone;
            supplier.address = selectedSupplier.address;
        } else {
            supplier.name = '';
            payment.payment_type = 'Cash';
            supplier.email = '';
            supplier.phone = '';
            supplier.address = '';
        }
    }
);

// Fetch suppliers when the component is mounted
onMounted(() => {
    fetchSuppliers();
    fetchBills();
});
</script>