import { Component } from '@angular/core';
import { IonicModule, ToastController } from '@ionic/angular';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { Preferences } from '@capacitor/preferences';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
  standalone: true,
  imports: [IonicModule, FormsModule, CommonModule]
})
export class LoginPage {
  username = '';
  password = '';

  constructor(
    private userService: UserService,
    private toastCtrl: ToastController,
    private router: Router
  ) {
    console.log('LoginPage constructor loaded');
  }

  ngOnInit() { console.log('LoginPage ngOnInit started'); }

  login() {
    this.userService.login(this.username, this.password).subscribe({
      next: async (res) => {
        if (res.success) {
          await Preferences.set({ key: 'auth_token', value: res.token });

          const toast = await this.toastCtrl.create({
            message: res.message,
            duration: 2000,
            color: 'success'
          });
          toast.present();

          // 成功登入 → 去 products page
          this.router.navigateByUrl('/products');
        } else {
          const toast = await this.toastCtrl.create({
            message: res.message,
            duration: 2000,
            color: 'danger'
          });
          toast.present();
        }
      },
      error: async () => {
        const toast = await this.toastCtrl.create({
          message: 'Server error',
          duration: 2000,
          color: 'danger'
        });
        toast.present();
      }
    });
  }

  goProducts() {
    // 無需 token，直接去 products page
    this.router.navigateByUrl('/products');
  }
}
