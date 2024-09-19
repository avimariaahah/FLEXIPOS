import BaseAPIService from "./BaseAPIService";
import axios from 'axios';


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

export const fetchProductCategories = async (): Promise<any[]> => {
    try {
        const response = await axios.get('/api/product-categories');
        return response.data;
    } catch (error) {
        console.error('Error fetching product categories:', error);
        return [];
    }
};

export const productCategoryService = new ProductCategoryService();
