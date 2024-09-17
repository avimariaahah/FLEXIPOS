import BaseAPIService from "./BaseAPIService";

class ProductCategoryService extends BaseAPIService {
    // Fetch all product categories
    async getProductCategories(): Promise<any> {
        return await this.request(`/productcategories`, "GET");
    }

    // Fetch a single product category by ID
    async getProductCategoryById(productCategoryId: number): Promise<any> {
        return await this.request(`/productcategories/${productCategoryId}`, "GET");
    }

    // Create a new product category
    async createProductCategory(params: object): Promise<any> {
        return await this.request(`/productcategories`, "POST", params);
    }

    // Update an existing product category
    async updateProductCategory(productCategoryId: number, params: object): Promise<any> {
        return await this.request(`/productcategories/${productCategoryId}`, "PUT", params);
    }

    // Delete a product category by ID
    async deleteProductCategory(productCategoryId: number): Promise<any> {
        return await this.request(`/productcategories/${productCategoryId}`, "DELETE");
    }
}

export const productCategoryService = new ProductCategoryService();
