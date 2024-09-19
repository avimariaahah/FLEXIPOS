import BaseAPIService from "./BaseAPIService";

class EmployeeService extends BaseAPIService {
    // Fetch all employees
    async getEmployees(): Promise<any> {
        return await this.request(`/employees`, "GET");
    }

    // Fetch a single employee by ID
    async getEmployeeById(employeeId: number): Promise<any> {
        return await this.request(`/employees/${employeeId}`, "GET");
    }

    // Create a new employee
    async createEmployee(params: object): Promise<any> {
        return await this.request(`/employees`, "POST", params);
    }

    // Update an existing employee
    async updateEmployee(employeeId: number, params: object): Promise<any> {
        return await this.request(`/employees/${employeeId}`, "PUT", params);
    }

    // Delete an employee by ID
    async deleteEmployee(employeeId: number): Promise<any> {
        return await this.request(`/employees/${employeeId}`, "DELETE");
    }
}

export const employeeService = new EmployeeService();
