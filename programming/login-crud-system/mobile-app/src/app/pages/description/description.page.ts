import { Component, OnInit } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, RouterModule, Router } from '@angular/router';
import { Preferences } from '@capacitor/preferences';
import { ProductService, Product } from '../../services/product.service';

@Component({
  selector: 'app-description',
  templateUrl: './description.page.html',
  styleUrls: ['./description.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, RouterModule]
})
export class DescriptionPage implements OnInit {
  products: Product[] = [];

  constructor(
    private route: ActivatedRoute,
    private productService: ProductService,
    private router: Router
  ) {}

  async ngOnInit() {
    const { value } = await Preferences.get({ key: 'auth_token' });
    if (!value) {
      console.error('No token found, please login first');
      return;
    }

    const id = this.route.snapshot.paramMap.get('id');
    console.log('Route ID:', id); // Debug

    if (id) {
      this.productService.getProduct(+id, value).subscribe({
        next: (res) => {
          console.log('API Response:', res); // Debug
          if (res.status === 'success') {
            this.products = Array.isArray(res.data) ? res.data : [res.data];
          } else {
            console.error('Failed to load product:', res.message);
          }
        },
        error: (err) => {
          console.error('Server error:', err);
        }
      });
    }
  }

  goToContact() {
    this.router.navigate(['/contact']);
  }
}
