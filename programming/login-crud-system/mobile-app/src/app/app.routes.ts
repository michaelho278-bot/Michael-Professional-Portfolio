import { Routes } from '@angular/router';

export const routes: Routes = [
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: 'products', loadComponent: () => import('./pages/products/products.page').then(m => m.ProductsPage) },
  { path: 'contact', loadComponent: () => import('./pages/contact/contact.page').then(m => m.ContactPage) },
  { path: 'description/:id', loadComponent: () => import('./pages/description/description.page').then(m => m.DescriptionPage) },
  { path: 'login', loadComponent: () => import('./pages/login/login.page').then(m => m.LoginPage) },
];
