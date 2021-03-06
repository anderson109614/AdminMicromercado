
import {APIServisService} from './servicios/apiservis.service';
import { Component, Inject , Injectable} from '@angular/core';
import {Usuario} from './Modelos/Usuario';
import { SESSION_STORAGE, StorageService } from 'ngx-webstorage-service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'AdminMicromercado';
  
  log:boolean=false;
  constructor(@Inject(SESSION_STORAGE) private storage: StorageService,
  private loginService: APIServisService,  public router: Router){}
  ngOnInit() {
    let lg:Usuario=this.storage.get('Usuario');
    if(lg!=null){
      this.MostrarLogin(false);
    }else{
      this.MostrarLogin(true);
    }
    



  }
  MostrarLogin(estado:boolean){
    console.log('entro');
    if(estado){
      (<HTMLDivElement>document.getElementById('DivPagina')).style.display='none';
    (<HTMLDivElement>document.getElementById('DivLogin')).style.display='block';
    }else{
      (<HTMLDivElement>document.getElementById('DivPagina')).style.display='block';
      (<HTMLDivElement>document.getElementById('DivLogin')).style.display='none';
      
    }
    
  }

  onClickLogin(){
    
    var usr= (<HTMLInputElement>document.getElementById("txt-login-username")).value;
    var cont= (<HTMLInputElement>document.getElementById("txt-login-password")).value;
   
    this.loginService.postLogin(usr,cont).subscribe(
      res => {
        try {
          if(res[0].id!=0){
            this.MostrarLogin(false);
            this.storage.set('Usuario',res[0]);
            this.router.navigateByUrl('/pedidos');
          } 
        }
        catch(e) {
          (<HTMLLabelElement>document.getElementById('lbl_error')).style.display='block';
          (<HTMLLabelElement>document.getElementById('lbl_error')).textContent="Error.... Ingrese un usuario y contraseña validos!!";

        }


        
      },
      err => console.log(err)
    );
  }
}
