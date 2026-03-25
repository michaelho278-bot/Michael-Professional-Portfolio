import { ApplicationConfig } from '@angular/core';
import { provideRouter } from '@angular/router';
import { routes } from './app.routes';
import { provideHttpClient, withFetch } from '@angular/common/http';
import { provideIonicAngular } from '@ionic/angular/standalone';

export const appConfig: ApplicationConfig = {
  providers: [
    // ✅ Router setup
    provideRouter(routes),

    // ✅ HttpClient setup (with Fetch API support)
    provideHttpClient(withFetch()),

    // ✅ Ionic setup (standalone mode)
    provideIonicAngular(),
  ],
};
