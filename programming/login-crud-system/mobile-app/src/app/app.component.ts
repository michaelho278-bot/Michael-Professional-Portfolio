import { Component } from '@angular/core';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
  standalone: true,              // 👈 standalone root component
  imports: [IonicModule],        // 👈 import Ionic components
})
export class AppComponent {}
