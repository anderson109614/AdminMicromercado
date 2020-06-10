import { Component, OnInit } from '@angular/core';
import {APIServisService} from '../../servicios/apiservis.service'
@Component({
  selector: 'app-clientes',
  templateUrl: './clientes.component.html',
  styleUrls: ['./clientes.component.css']
})
export class ClientesComponent implements OnInit {
  listaClientes:any=[];
  listaClientesAux:any=[];

  constructor(private api:APIServisService) { }

  ngOnInit(): void {
    this.cargarClientes();
  }
  cargarClientes(){
    this.api.GetClientes().subscribe(
      res => {
        this.listaClientes = res;
        this.listaClientesAux = res;
      },
      err => console.log(err)
    );
  }
  checkBien($event: KeyboardEvent) {

    this.listaClientes=this.listaClientesAux;
    
    let value = (<HTMLInputElement>event.target).value;
    const result = this.listaClientes.filter(cliente => cliente.Id.search(value)>=0 
                                           || cliente.Cedula.search(value)>=0 
                                           || cliente.Nombre.toUpperCase().search(value.toUpperCase())>=0
                                           || cliente.Apellido.toUpperCase().search(value.toUpperCase())>=0 
                                           || cliente.Telefono.toUpperCase().search(value.toUpperCase())>= 0
                                           || cliente.Celular.toUpperCase().search(value.toUpperCase())>= 0 
                                           || cliente.Direccion.toUpperCase().search(value.toUpperCase())>= 0 
                                          );
    this.listaClientes=result;

  }
}
