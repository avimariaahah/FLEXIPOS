<template>

    <Head>
        <Title>POS - {{ runtimeConfig.public.appName }}</Title>
    </Head>
    <div class="min-h-screen flex flex-col bg-gray-200">
        <header class="bg-gray-900 text-white p-4 flex justify-between items-center">
            <img class="h-8 pl-6 w-auto" src="/public/images/Logo.png" alt="" />
            <button @click="logout"
                class="bg-gray-900 hover:bg-gray-600 mt-2 text-white py-1 px-3 rounded flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                </svg>
            </button>
        </header>

        <main class="flex-1 p-6 flex">

            <div class="flex-grow flex flex-col space-y-4">
                <div class="flex items-center space-x-4">

                    <div class="flex h-16 items-center rounded-l-md overflow-hidden">
                        <img class="h-8 w-auto" src="public/images/Barcode.png" alt="" />
                    </div>

                    <button @click="toggleDescCode"
                        class="bg-gray-900 hover:bg-gray-600 text-white py-1 px-3 rounded w-20 font-bold">
                        {{ displayText }}
                    </button>

                    <input type="text" ref="barcodeInputRef" v-model="barcodeInput" @keyup.enter="addItem"
                        class="border bg-white border-gray-400 rounded py-1 pl-3 pr-0 text-gray-700 focus:outline-none focus:border-blue-500 flex-grow"
                        :placeholder="placeholderText" />

                    <select
                        class="border bg-white border-gray-400 rounded py-1 px-20 text-gray-700 focus:outline-none focus:border-blue-500 w-48">
                    </select>
                </div>
                <div class="mt-6 flex-grow">
                    <table class="w-full bg-white border border-gray-300 rounded-md shadow-md">
                        <thead>
                            <tr class="bg-white text-black">
                                <th class="py-2 px-4 border-b text-left">Barcode</th>
                                <th class="py-2 px-4 border-b text-left">Description</th>
                                <th class="py-2 px-4 border-b text-right">Price</th>
                                <th class="py-2 px-4 border-b text-right">Quantity</th>
                                <th class="py-2 px-4 border-b text-right">Discount</th>
                                <th class="py-2 px-4 border-b text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in paginatedItems" :key="item.barcode" class="bg-gray-200">
                                <td class="py-2 px-4 border-b text-left">{{ item.barcode }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ item.description }}</td>
                                <td class="py-2 px-4 border-b text-right">{{ item.price }}</td>
                                <td class="py-2 px-4 border-b text-right">{{ item.quantity }}</td>
                                <td class="py-2 px-4 border-b text-right">{{ item.discount }}</td>
                                <td class="py-2 px-4 border-b text-right">{{ item.total }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-end mt-4">
                        <button @click="prevPage"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                            Prev
                        </button>
                        <button @click="nextPage"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Amount Details -->
            <div class="w-1/4 bg-gray-900 text-white p-4 ml-4">
                <div class="text-center py-2 rounded-t-sm">
                    <div class="bg-white text-gray-900 text-2xl font-bold text-center rounded py-6 px-4 w-full">
                        <!-- Replace with the dynamic amount of products scanned -->
                        <!-- PUT PRICE HERE -->
                        {{ totalAmount.toFixed(2) }}
                    </div>
                </div>
                <div v-if="mostRecentItem" class="mt-4">
                    <h2 class="text-lg font-bold text-center">{{ mostRecentItem.description }}</h2>
                    <ul class="list-disc">
                        <li class="mb-1 flex justify-between">
                            <span>Price:</span>
                            <span>{{ mostRecentItem.price }}</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>Quantity:</span>
                            <span>{{ mostRecentItem.quantity }}</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>Discount:</span>
                            <span>{{ mostRecentItem.discount }}</span>
                        </li>
                        <li class="mb-1 flex justify-between font-bold">
                            <span>Total:</span>
                            <span>{{ mostRecentItem.total }}</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-3">
                    <h2 class="text-lg font-bold text-center ">SALES SUB TOTALS</h2>
                    <ul class="list-disc">
                        <li class="mb-1 flex justify-between mt-2">
                            <span>Amount Due:</span>
                            <span>200.00</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>Total Item/s:</span>
                            <span>2.00</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>Total Discount:</span>
                            <span>0</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>NET:</span>
                            <span>0</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>VAT:</span>
                            <span>0</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>VAT EXEMPT:</span>
                            <span>0</span>
                        </li>
                        <li class="mb-1 flex justify-between font-bold">
                            <span>Total Amount Due:</span>
                            <span>200.00</span>
                        </li>
                        <li class="mb-1 mt-64 flex justify-between">
                            <span>CASHIER: </span>
                            <span> {{ firstname }} {{ lastname }}</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>DATE: </span>
                            <span> {{ currentDateTime }}</span>
                        </li>
                        <li class="mb-1 flex justify-between">
                            <span>TIME: </span>
                            <span> {{ currentTime }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </main>

        <!-- Buttons -->
        <div class="flex flex-wrap gap-2 p-4">
            <button
                class="bg-white text-black ml-5 mr-4 font-bold py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F1</span>
            </button>

            <button class="bg-white font-bold mr-4 text-black py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F2</span>
            </button>

            <button class="bg-white text-black mr-4 font-bold py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F3</span>
            </button>

            <button @click="toggleCashForm"
                class="bg-white text-black font-bold mr-4 py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">CTRL<br>+<br>ENTER</span>
            </button>

            <button @click="toggleVoidForm"
                class="bg-white text-black font-bold mr-4 py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">CTRL<br>+SHIFT+<br>V</span>
            </button>

            <button class="bg-white text-black font-bold mr-4 py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F6</span>
            </button>

            <button class="bg-white text-black font-bold mr-4 py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F7</span>
            </button>

            <button class="bg-white text-black font-bold mr-4 py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F8</span>
            </button>

            <button class="bg-white text-black font-bold mr-4 py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F9</span>
            </button>

            <button class="bg-white text-black font-bold mr-4 py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F10</span>
            </button>

            <button class="bg-white text-black font-bold mr-4 py-3 px-4 w-24 h-24 rounded flex flex-col items-center">
                <span class="text-xxs">F11</span>
            </button>
        </div>

        <!-- Popup Forms -->
        <!-- Cash Form -->
        <div v-if="showCashForm" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <form @submit.prevent="">
                    <div class="grid grid-cols-1 gap-1 mt-3 mx-2">
                        <!-- Fields -->
                        <div class="mb-1">
                            <FormLabel for="cashtendered" label="Cash Tendered" class="mr-3" />
                            <FormTextField id="cashtendered" name="cashtendered" v-model="payment.cash_tendered"
                                placeholder="Cash Tendered" required />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-2 mt-4">
                            <FormButton type="submit" buttonStyle="success" class="w-full">
                                Save
                            </FormButton>
                            <FormButton @click="toggleCashForm" buttonStyle="xxx" class="w-full">
                                Cancel
                            </FormButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Void Item Form -->
        <div v-if="showVoidForm" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <form @submit.prevent="removeItem(voidItem.barcode)">
                    <div class="grid grid-cols-1 gap-1 mt-3 mx-2">
                        <!-- Fields -->
                        <div class="mb-1">
                            <FormLabel for="voiditem" label="Enter barcode" class="mr-3" />
                            <FormTextField id="voiditem" name="voiditem" v-model="voidItem.barcode"
                                placeholder="Enter item barcode" required />
                        </div>
                        <div class="mb-1">
                            <FormLabel for="supervisorcode" label="Security" class="mr-3" />
                            <FormTextField id="supervisorcode" name="supervisorcode" v-model="voidItem.supervisor_code"
                                placeholder="Enter void code" required />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-2 mt-4">
                            <FormButton type="submit" buttonStyle="success" class="w-full">
                                Save
                            </FormButton>
                            <FormButton @click="toggleVoidForm" buttonStyle="xxx" class="w-full">
                                Cancel
                            </FormButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
//import area
import { ref, onMounted, onUnmounted } from 'vue';
import { useI18n } from 'vue-i18n';
import { productService } from '~/components/api/admin/ProductService.js';


// Alert and i18n setup
const { successAlert } = useAlert();
const { errorAlert } = useAlert();
const { t } = useI18n()

// interface area
interface Item {
    barcode: string;
    description: string;
    price: number;
    quantity: number;
    discount: number;
    total: number;
}

interface Product {
    id: number;
    barcode: string;
    name: string;
    current_price: number;
}

// const area
const runtimeConfig = useRuntimeConfig();
const user_id = computed(() => localStorage.getItem('user_id'));
const firstname = computed(() => localStorage.getItem('firstname'));
const lastname = computed(() => localStorage.getItem('lastname'));
const displayText = ref('CODE');
const placeholderText = ref('Enter Barcode');
const currentTime = ref('');
const currentDateTime = ref('');
const barcodeInput = ref('');
const barcodeInputRef = ref<HTMLInputElement | null>(null);
const itemsPerPage = 16;
const currentPage = ref(1);
const items = ref<Item[]>([]);
const paginatedItems = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return items.value.slice(start, end);
});

const state = reactive({
    error: null as Error | null,
    isTableLoading: false,
    products: [] as Product[],
});

// computed property to calculate total amount
const totalAmount = computed(() => {
    return items.value.reduce((total, item) => total + item.total, 0);
});

// computed property for the most recent item
const mostRecentItem = computed(() => {
    return items.value[items.value.length - 1] || null;
});

// async functions area
async function fetchProducts() {
    state.isTableLoading = true;
    state.error = null;
    try {
        const response = await productService.getProducts();
        state.products = response.data; // Adjust if necessary based on API response structure
        console.log('Fetched products:', response.data); // Log fetched products
    } catch (error: any) {
        state.error = error;
    }
    state.isTableLoading = false;
}

// form functions area
const showCashForm = ref(false);
const showVoidForm = ref(false);

function toggleCashForm() {
    showCashForm.value = !showCashForm.value;
    // Reset fields form when toggling
}

function toggleVoidForm() {
    showVoidForm.value = !showVoidForm.value;
    // Reset fields form when toggling
}

const payment = ref({
    cash_tendered: '',
});

const voidItem = ref({
    barcode: '',
    supervisor_code: '',
});

// rules
// const rules = computed(() => ({
//     payment: {
//         cash_tendered: {
//             required: helpers.withMessage('This field is required.', required),
//         },
//         isActive: {
//             required: helpers.withMessage('This field is required.', required),
//         },
//     },
// }));

// const v$ = useVuelidate(rules, payment);

// functions area

function prevPage() {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
}

function nextPage() {
    if (currentPage.value * itemsPerPage < items.value.length) {
        currentPage.value++;
    }
}

function addItem() {
    // Check if the barcode input is valid
    if (barcodeInput.value.trim() !== '') {
        // Find the product with the matching barcode
        const product = state.products.find(product => product.barcode === barcodeInput.value);
        console.log(product?.barcode);

        let quantity = 1;
        let discount = 0;

        if (product) {
            // Add the item to the list
            items.value.push({
                barcode: product.barcode,
                description: product.name,
                price: product.current_price,
                quantity: quantity,
                discount: discount,
                total: product.current_price * quantity,
            });
        } else {
            // Alert if the product does not exist
            alert(`Product with barcode ${barcodeInput.value} does not exist.`);
        }

        // Clear the barcode input
        barcodeInput.value = '';
    }
}

function printItems() {
    const printWindow = window.open('', 'Print Receipt', 'width=800,height=600');
    if (printWindow) {
        let html = '';
        html += '<!DOCTYPE html><html><head><title>Receipt</title></head><body>';
        html += '<style>body { font-family: Arial, sans-serif; }</style>';
        html += '<h1>Receipt</h1>';
        html += '<h4>Date: ' + currentDateTime.value + '</h4>';
        html += '<h4>Time: ' + currentTime.value + '</h4>';
        html += '<h4>Cashier: ' + firstname.value + ' ' + lastname.value + '</h4>';
        html += '<table border="1" cellpadding="5" cellspacing="0">';
        html += '<tr><th>Barcode</th><th>Description</th><th>Price</th><th>Quantity</th></tr>';

        // Debugging: Log items to console
        console.log('Items to print:', items.value);

        items.value.forEach((item) => {
            html += '<tr>';
            html += `<td>${item.barcode}</td>`;
            html += `<td>${item.description}</td>`;
            html += `<td>$${item.price}</td>`;
            html += `<td>${item.quantity}</td>`;
            html += '</tr>';
        });
        html += '</table>';

        const subtotal = items.value.reduce((acc, item) => acc + item.total, 0);
        html += '<h4>Subtotal: $' + subtotal + '</h4>';
        html += '<h4>Tax (0%): $0.00</p>';
        html += '<h4>Total: $' + subtotal + '</h4>';
        html += '<h4>Thank you for shopping with us!</h4>';
        html += '</body></html>';

        printWindow.document.write(html);
        printWindow.document.close(); // Close the document to prevent further modifications
        printWindow.focus(); // Focus on the print window

        // Use setTimeout to ensure the document is fully rendered before printing
        setTimeout(() => {
            printWindow.print(); // Print the window
            printWindow.close(); // Close the print window
        }, 100); // Adjust the timeout as necessary
    } else {
        console.log('Failed to open print window');
    }
}

// Function to remove item based on barcode
function removeItem(barcode: string) {
    const supervisorCode = "123";
    const index = items.value.findIndex(item => item.barcode === barcode);

    // Explicitly check for -1 to determine if the item was found
    if (index !== -1 && voidItem.value.supervisor_code === supervisorCode) {
        items.value.splice(index, 1);
        successAlert(`${t('alert.Success')}!`, `item with barcode ${barcode} removed successfully!`);
    } else {
        if (index === -1) {
            errorAlert(`${t('alert.Error')}!`, `Item with barcode ${barcode} not found.`);
        } else {
            errorAlert(`${t('alert.Error')}!`, `Item with barcode ${barcode} cannot be removed. Please check your supervisor code.`);
        }
    }
}

successAlert(`${t('alert.Success')}!`, `Product Category deleted sucessfully!`);
errorAlert(`${t('alert.Error')}!`, `'Product Category deletion failed.'`);

function handleCashPaymentEvent(event: KeyboardEvent) {
    if (event.ctrlKey && event.key === 'Enter') {
        event.preventDefault(); // Prevent the default refresh action
        toggleCashForm();
    }
}

function handlePrintEvent(event: KeyboardEvent) {
    if (event.ctrlKey && event.key === 'r') {
        event.preventDefault(); // Prevent the default refresh action
        printItems();
    }
}

// for multiple event keys for instance: CTRL + E + Q
// USE THIS FOR MUTIPLE EVENT KEYS FOR INSTANCE: CTRL + E + Q
let keysPressed: { [key: string]: boolean } = {};

// Function to handle void item event
function handleVoidItemEvent(event: KeyboardEvent) {
    keysPressed[event.key] = true;
    console.log('Key pressed:', event.key, keysPressed);
    if (keysPressed['Control'] && keysPressed['Shift'] && keysPressed['V']) {
        event.preventDefault(); // Prevent default action
        toggleVoidForm(); // Call the function to toggle the void form
    }
}

// Event listener for keyup events to reset keysPressed object
function handleKeyUp(event: KeyboardEvent) {
    delete keysPressed[event.key];
    console.log('Key released:', event.key, keysPressed);
}


function toggleDescCode() {
    if (displayText.value === 'CODE') {
        displayText.value = 'DESC';
        placeholderText.value = 'Enter Item';
    } else {
        displayText.value = 'CODE';
        placeholderText.value = 'Enter Barcode';
    }
}

function handleCtrlS(event: KeyboardEvent) {
    if (event.ctrlKey && event.key === 's') {
        event.preventDefault();
        toggleDescCode();
    }
}

onMounted(() => {
    window.addEventListener('keydown', handleCtrlS);
    window.addEventListener('keydown', handlePrintEvent);
    window.addEventListener('keydown', handleCashPaymentEvent);
    window.addEventListener('keydown', handleVoidItemEvent);
    window.addEventListener('keyup', handleKeyUp);
    setInterval(updateDateTime, 1000);
    setInterval(updateTimeOnly, 1000);
    barcodeInputRef.value?.focus();
    fetchProducts();
});

onUnmounted(() => {
    window.removeEventListener('keydown', handleCtrlS);
    window.removeEventListener('keydown', handlePrintEvent);
    window.removeEventListener('keydown', handleCashPaymentEvent);
    window.removeEventListener('keydown', handleVoidItemEvent);
    window.removeEventListener('keyup', handleKeyUp);
});

function logout() {
    console.log('User logged out');
    const router = useRouter();
    router.push('/admin/dashboard');
}

function updateDateTime() {
    const currentTimeValue = new Date();
    const dayOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][currentTimeValue.getDay()];
    const month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'][currentTimeValue.getMonth()];
    const day = currentTimeValue.getDate();
    const year = currentTimeValue.getFullYear();
    let hours = currentTimeValue.getHours();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12;
    const minutes = currentTimeValue.getMinutes().toString().padStart(2, '0');
    const seconds = currentTimeValue.getSeconds().toString().padStart(2, '0');
    const dateTimeString = `${dayOfWeek}, ${month} ${day}, ${year}`;
    currentDateTime.value = dateTimeString;
}

function updateTimeOnly() {
    const currentTimeValue = new Date();
    let hours = currentTimeValue.getHours();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12;
    const minutes = currentTimeValue.getMinutes().toString().padStart(2, '0');
    const seconds = currentTimeValue.getSeconds().toString().padStart(2, '0');
    const timeString = `${hours}:${minutes}:${seconds} ${ampm}`;
    currentTime.value = timeString;
}
</script>