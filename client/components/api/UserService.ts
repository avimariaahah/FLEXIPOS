import BaseAPIService from "./BaseAPIService";

class UserService extends BaseAPIService {
    // Fetch all users
    async getUsers(): Promise<any> {
        return await this.request(`/users`, "GET");
    }

    // Fetch a single user by ID
    async getUserById(userId: number): Promise<any> {
        return await this.request(`/users/${userId}`, "GET");
    }

    // Create a new user
    async createUser(params: object): Promise<any> {
        return await this.request(`/users`, "POST", params);
    }

    // Update an existing user
    async updateUser(userId: number, params: object): Promise<any> {
        return await this.request(`/users/${userId}`, "PUT", params);
    }

    // Delete a user by ID
    async deleteUser(userId: number): Promise<any> {
        return await this.request(`/users/${userId}`, "DELETE");
    }
}

export const userService = new UserService();