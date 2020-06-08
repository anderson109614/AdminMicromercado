import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class APIServisService {
 // urlP:string='https://serviciosand.000webhostapp.com/Servicios/'; 
 urlP: string = 'http://localhost/AdminMicromercado/API-Micromercado/';
 //urlP:string='http://micromercadoand.atwebpages.com/API-Micromercado/'; 
  constructor(private http: HttpClient) { }

  postLogin(usr,pass){
    let log={
      cedula:usr,
      contrasena:pass
    }
    return this.http.post(this.urlP+'Admin/Login/Login.php', log);
  }
}
