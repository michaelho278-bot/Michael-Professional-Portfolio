import { Component, OnInit } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms'; // ✅ for ngModel
import { Preferences } from '@capacitor/preferences';
import { ProductService } from '../../services/product.service';
import { environment } from '../../../environments/environment';

@Component({
  selector: 'app-products',
  templateUrl: './products.page.html',
  styleUrls: ['./products.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, RouterModule, FormsModule]
})
export class ProductsPage implements OnInit {
  products: any[] = [];
  filteredProducts: any[] = [];
  selectedCategory: string = 'all';

  // ✅ 定義 environment property，方便 HTML 使用
  environment = environment;

  constructor(private productService: ProductService) {}

  async ngOnInit() {
    const { value } = await Preferences.get({ key: 'auth_token' });
    if (!value) {
      console.error('No token found, please login first');
      return;
    }

    this.productService.getProducts(value).subscribe({
      next: (res) => {
        if (res.status === 'success') {
          this.products = res.data;
          this.filteredProducts = this.products; // 初始顯示全部
        } else {
          console.error('Failed to load products:', res.message);
        }
      },
      error: (err) => {
        console.error('Server error:', err);
      }
    });
  }

  filterProducts(event: any) {
    const category = event.detail.value;
    this.selectedCategory = category;

    if (category === 'all') {
      this.filteredProducts = this.products;
    } else {
      this.filteredProducts = this.products.filter(p => p.pCate === category);
    }
  }
}
