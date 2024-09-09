<template>
    <div>
        <NuxtLayout name="admin">
            <main>

                <Head>
                    <Title>Suppliers - {{ runtimeConfig.public.appName }}</Title>
                </Head>
                <!-- Add Button and Description -->
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Suppliers</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the suppliers and their details.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <button type="button" @click="toggleForm"
                            class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Add Supplier</button>
                    </div>
                </div>
                <!-- Search Bar -->
                <!-- Uncomment if needed
                <div class="relative flex items-center space-x-4 mt-3">
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
                </div> -->
                <!-- Supplier Form -->
                <div v-if="showForm" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                        <form @submit.prevent="saveSupplier">
                            <div class="grid grid-cols-1 gap-1 mt-3 mx-2">
                                <div class="flex items-center mb-1 ml-7">
                                    <label for="supplierName"
                                        class="text-xxs font-medium text-gray-700 w-20 mr-2">Name</label>
                                    <input id="supplierName" v-model="supplier.supplierName" type="text"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2"
                                        required />
                                </div>
                                <div class="flex items-center mb-1 ml-7">
                                    <label for="productName"
                                        class="text-xxs font-medium text-gray-700 w-20 mr-2">Product</label>
                                    <input id="productName" v-model="supplier.productName" type="text"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2" />
                                </div>
                                <div class="flex items-center mb-1 ml-7">
                                    <label for="address"
                                        class="text-xxs font-medium text-gray-700 w-20 mr-2">Address</label>
                                    <input id="address" v-model="supplier.address" type="text"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2" />
                                </div>
                                <div class="flex items-center mb-1 ml-7">
                                    <label for="telephone1" class="text-xxs font-medium text-gray-700 w-20 mr-2">Phone
                                        1</label>
                                    <input id="telephone1" v-model="supplier.telephone1" type="text"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2" />
                                </div>
                                <div class="flex items-center mb-1 ml-7">
                                    <label for="telephone2" class="text-xxs font-medium text-gray-700 w-20 mr-2">Phone
                                        2</label>
                                    <input id="telephone2" v-model="supplier.telephone2" type="text"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2" />
                                </div>
                                <div class="flex items-center mb-1 ml-7">
                                    <label for="isactive"
                                        class="text-xxs font-medium text-gray-700 w-20 mr-2">Active</label>
                                    <input id="isactive" v-model="supplier.isactive" type="checkbox"
                                        class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2" />
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
                            </div>
                        </form>
                    </div>
                </div>

                <!--EDIT TABLE AREA HERE-->
                <!--EDIT TABLE AREA HERE-->
                <!--EDIT TABLE AREA HERE-->

                <!-- Supplier Table -->
                <!-- <div>
                    <Alert type="danger" :text="state.error?.message" v-if="state.error" />
                    <div class="table-responsive">
                        <Table :columnHeaders="state.columnHeaders" :data="state.suppliers"
                            :isLoading="state.isTableLoading" :sortData="state.sortData" @sort="sort">
                            <template #body v-if="!(
                                state.isTableLoading ||
                                (state.suppliers?.data &&
                                    state.suppliers?.data.length === 0)
                            )">
                                <tr v-for="(supplier, index) in state.suppliers?.data" :key="index">
                                    <td>
                                        <span class="truncate">{{ supplier.supplierName }}</span>
                                    </td>
                                    <td>
                                        <span>{{ supplier.productName }}</span>
                                    </td>
                                    <td>
                                        <span>{{ supplier.address }}</span>
                                    </td>
                                    <td>
                                        <span>{{ supplier.telephone1 }}</span>
                                    </td>
                                    <td>
                                        <span>{{ supplier.telephone2 }}</span>
                                    </td>
                                    <td class="px-4 py-2 text-xxs text-gray-700">
                                        <div class="flex space-x-2">
                                            <button @click="" class="text-gray-600 hover:text-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0l-10 10V16a1 1 0 001 1h3.414l10-10a2 2 0 000-2.828l-1.586-1.586zM5 13l-1.5 1.5V13h1.5zm4.5-4.5L14 4l2 2-4.5 4.5H9.5V8.5z" />
                                                </svg>
                                            </button>
                                            <button @click="deleteSupplier(supplier.supplierID)"
                                                class="text-red-600 hover:text-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a2 2 0 00-2 2v1H2v2h1v9a2 2 0 002 2h8a2 2 0 002-2V7h1V5h-2V4a2 2 0 00-2-2H6zm4 12a1 1 0 102 0V8a1 1 0 10-2 0v6zm-3-1a1 1 0 002 0V8a1 1 0 10-2 0v5zm8-1a1 1 0 10-2 0V8a1 1 0 102 0v5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
</Table>
</div>
<Pagination :data="state.suppliers" @previous="previous" @next="next" />
</div> -->
            </main>
        </NuxtLayout>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useState } from '#app'

const runtimeConfig = useRuntimeConfig();

const state = useState('suppliers', () => ({
    suppliers: { data: [], meta: {} },
    columnHeaders: ['Name', 'Product', 'Address', 'Phone 1', 'Phone 2', 'Actions'],
    sortData: { column: '', direction: 'asc' },
    isTableLoading: false,
    error: null,
}))

const supplier = ref({
    supplierName: '',
    productName: '',
    address: '',
    telephone1: '',
    telephone2: '',
    isactive: true,
})

const showForm = ref(false)

const toggleForm = () => {
    showForm.value = !showForm.value
}

const saveSupplier = () => {
    // Implement save supplier logic
    toggleForm()
}

const deleteSupplier = (id: number) => {
    // Implement delete supplier logic
}

const sort = (column: string) => {
    // Implement sort logic
}

const previous = () => {
    // Implement pagination previous logic
}

const next = () => {
    // Implement pagination next logic
}
</script>

<style scoped>
/* Add any additional styles here */
</style>
