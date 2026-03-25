import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

export interface User {
  uID: number;
  uName: string;
  uRole: string;
  uUsername: string;
  uPassword: string;
}

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  // Login
  login(username: string, password: string): Observable<any> {
    return this.http.post(`${this.apiUrl}/auth_login.php`, {
      uUsername: username,
      uPassword: password
    });
  }

  // Fetch all users
  getUsers(): Observable<User[]> {
    return this.http.get<User[]>(`${this.apiUrl}/users.php`);
  }

  // Fetch single user
  getUserById(id: number): Observable<User> {
    return this.http.get<User>(`${this.apiUrl}/users.php/${id}`);
  }
}
