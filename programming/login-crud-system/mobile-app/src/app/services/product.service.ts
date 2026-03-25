import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

// Product model
export interface Product {
  pID: number;
  pCate: string;
  pName: string;
  pDescription: string;
  pSpec: string;
  pImage: string;
  pPrice: number;
  pStock: number;
}

// API Response 格式
export interface ApiResponse<T> {
  status: string;
  data: T;
  message?: string;
}

@Injectable({ providedIn: 'root' })
export class ProductService {
  private baseUrl = `${environment.apiUrl}/products.php`;

  constructor(private http: HttpClient) {}

  // Get all products
  getProducts(token: string): Observable<ApiResponse<Product[]>> {
    const headers = new HttpHeaders({
      Authorization: `Bearer ${token}`
    });
    return this.http.get<ApiResponse<Product[]>>(this.baseUrl, { headers });
  }

  // Get single product
  getProduct(id: number, token: string): Observable<ApiResponse<Product>> {
    const headers = new HttpHeaders({
      Authorization: `Bearer ${token}`
    });
    return this.http.get<ApiResponse<Product>>(`${this.baseUrl}?id=${id}`, { headers });
  }
}
