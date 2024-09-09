import BaseAPIService from "./BaseAPIService";

class CustomerService extends BaseAPIService {
    // Fetch all customers
    async getCustomers(): Promise<any> {
        return await this.request(`/customers`, "GET");
    }

    // Fetch a single customer by ID
    async getCustomerById(customerId: number): Promise<any> {
        return await this.request(`/customers/${customerId}`, "GET");
    }

    // Create a new customer
    async createCustomer(params: object): Promise<any> {
        return await this.request(`/customers`, "POST", params);
    }

    // Update an existing customer
    async updateCustomer(customerId: number, params: object): Promise<any> {
        return await this.request(`/customers/${customerId}`, "PUT", params);
    }

    // Delete a customer by ID
    async deleteCustomer(customerId: number): Promise<any> {
        return await this.request(`/customers/${customerId}`, "DELETE");
    }
}

export const customerService = new CustomerService();