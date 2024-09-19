<template>
    <div>
        <NuxtLayout name="admin">
            <main>

                <Head>
                    <Title>Employees - {{ runtimeConfig.public.appName }}</Title>
                </Head>
                <div class="sm:flex sm:items-center sm:justify-between">
                    <!-- Search Bar -->
                    <div class="relative flex flex-1 ml-8 mt-5">
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
                    <!-- Add Employee Button -->
                    <div class="mt-4 sm:ml-16 sm:mt-3 sm:flex-none mr-6">
                        <button type="button" @click="toggleForm"
                            class="block rounded-md bg-gray-900 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Add Employee
                        </button>
                    </div>
                </div>

                <!-- Employee Form -->
                <div v-if="showForm" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                        <form @submit.prevent="saveEmployee">
                            <div class="flex items-center mb-1 ml-7">
                                <label for="employeeId"
                                    class="text-xxs font-medium text-gray-700 w-20 mr-2">userID</label>
                                <input id="employeeId" v-model="employee.userID" type="text"
                                    class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2"
                                    required />
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label for="firstname"
                                    class="text-xxs font-medium text-gray-700 w-20 mr-2">FirstName</label>
                                <input id="firstname" v-model="employee.firstname" type="text"
                                    class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2"
                                    required />
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label for="lastname"
                                    class="text-xxs font-medium text-gray-700 w-20 mr-2">LastName</label>
                                <input id="lastname" v-model="employee.lastname" type="text"
                                    class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2"
                                    required />
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label for="telephone"
                                    class="text-xxs font-medium text-gray-700 w-20 mr-2">Telephone</label>
                                <input id="telephone" v-model="employee.telephone" type="text"
                                    class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2"
                                    required />
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label for="designation"
                                    class="text-xxs font-medium text-gray-700 w-20 mr-2">Designation</label>
                                <input id="designation" v-model="employee.designation" type="text"
                                    class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2"
                                    required />
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label for="status" class="text-xxs font-medium text-gray-700 w-20 mr-2">Status</label>
                                <select id="status" v-model="employee.isactive"
                                    class="block flex-1 rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 text-xs px-3 py-2">
                                    <option :value="1">Active</option>
                                    <option :value="0">Inactive</option>
                                </select>
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

                <!-- View Details -->
                <div v-if="employeeToView"
                    class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                        <div class="grid grid-cols-1 gap-1 mt-3 mx-2">
                            <div class="flex items-center mb-1 ml-7">
                                <label class="text-xxs font-medium text-gray-700 w-20 mr-2">EmployeeID:</label>
                                <span>{{ employeeToView.employeeId }}</span>
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label class="text-xxs font-medium text-gray-700 w-20 mr-2">UserID:</label>
                                <span>{{ employeeToView.userID }}</span>
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label class="text-xxs font-medium text-gray-700 w-20 mr-2">FirstName:</label>
                                <span>{{ employeeToView.firstname }}</span>
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label class="text-xxs font-medium text-gray-700 w-20 mr-2">LastName:</label>
                                <span>{{ employeeToView.lastname }}</span>
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label class="text-xxs font-medium text-gray-700 w-20 mr-2">Telephone:</label>
                                <span>{{ employeeToView.telephone }}</span>
                            </div>
                            <div class="flex items-center mb-1 ml-7">
                                <label class="text-xxs font-medium text-gray-700 w-20 mr-2">Designation:</label>
                                <span>{{ employeeToView.designation }}</span>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button @click="employeeToView = null"
                                    class="rounded-md bg-gray-200 px-4 py-2 text-xxs font-semibold text-gray-700 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employees Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300 text-xs">
                        <thead class="bg-gray-900 text-xs text-white">
                            <tr>
                                <th class="px-3 py-1 text-left">Employee ID</th>
                                <th class="px-3 py-1 text-left">First Name</th>
                                <th class="px-3 py-1 text-left">Last Name</th>
                                <th class="px-3 py-1 text-left">Telephone</th>
                                <th class="px-3 py-1 text-left">Designation</th>
                                <th class="px-3 py-1 text-left">Status</th>
                                <th class="px-3 py-1 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <tr v-for="employee in employees" :key="employee.employeeId">
                                <td class="px-3 py-2">{{ employee.employeeId }}</td>
                                <td class="px-3 py-2">{{ employee.firstname }}</td>
                                <td class="px-3 py-2">{{ employee.lastname }}</td>
                                <td class="px-3 py-2">{{ employee.telephone }}</td>
                                <td class="px-3 py-2">{{ employee.designation }}</td>
                                <td class="px-3 py-2">
                                    <div :class="{
                                        'text-green-500': employee.isactive,
                                        'text-red-500': !employee.isactive
                                    }">
                                        {{ employee.isactive ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <button @click="viewEmployeeDetails(employee)"
                                        class="rounded-md bg-blue-500 px-2 py-1 text-white text-xs">
                                        View
                                    </button>
                                    <button @click="editEmployee(employee)"
                                        class="rounded-md bg-yellow-500 px-2 py-1 text-white text-xs ml-2">
                                        Edit
                                    </button>
                                    <button @click="deleteEmployee(employee.employeeId)"
                                        class="rounded-md bg-red-500 px-2 py-1 text-white text-xs ml-2">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-end">
                    <button @click="fetchEmployees" class="px-4 py-2 text-sm bg-gray-900 text-white rounded-md">
                        Refresh
                    </button>
                </div>
            </main>
        </NuxtLayout>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useRuntimeConfig } from '#app';
import { employeeService } from '~/components/api/EmployeeService';

const runtimeConfig = useRuntimeConfig();

const showForm = ref(false);
const employee = reactive({
    userID: '',
    firstname: '',
    lastname: '',
    telephone: '',
    designation: '',
    isactive: true,
});
const employeeToView = ref(null);
const employees = ref([]);
const pagination = reactive({
    currentPage: 1,
    totalPages: 1,
});

const fetchEmployees = async () => {
    try {
        const response = await employeeService.getAllEmployees();
        employees.value = response.data;
        // Set pagination data if available
    } catch (error) {
        console.error('Error fetching employees:', error);
    }
};

const saveEmployee = async () => {
    try {
        if (employee.employeeId) {
            // Update existing employee
            await employeeService.updateEmployee(employee.employeeId, employee);
        } else {
            // Create new employee
            await employeeService.createEmployee(employee);
        }
        fetchEmployees(); // Refresh the list
        toggleForm(); // Hide the form
    } catch (error) {
        console.error('Error saving employee:', error);
    }
};

const viewEmployeeDetails = (employee) => {
    employeeToView.value = employee;
};

const editEmployee = (employee) => {
    employeeToEdit.value = employee;
    showForm.value = true;
};

const deleteEmployee = async (employeeId) => {
    try {
        await employeeService.deleteEmployee(employeeId);
        fetchEmployees(); // Refresh the list
    } catch (error) {
        console.error('Error deleting employee:', error);
    }
};

const toggleForm = () => {
    showForm.value = !showForm.value;
};

onMounted(() => {
    fetchEmployees();
});
</script>
