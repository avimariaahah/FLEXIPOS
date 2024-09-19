import BaseAPIService from "./BaseAPIService";

class UserService extends BaseAPIService {
    // Create a new user
    async createUser(params: object): Promise<any> {
        return await this.request(`/users`, "POST", params);
    }
}

export const userService = new UserService();