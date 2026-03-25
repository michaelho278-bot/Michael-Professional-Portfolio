import { Component } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.page.html',
  styleUrls: ['./contact.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule],
})
export class ContactPage {
  name = '';
  email = '';
  message = '';

  sendEmail() {
    const subject = encodeURIComponent(`Contact from ${this.name}`);
    const body = encodeURIComponent(`Email: ${this.email}\nMessage: ${this.message}`);
    window.location.href = `mailto:youraccount@gmail.com?subject=${subject}&body=${body}`;
  }
}
