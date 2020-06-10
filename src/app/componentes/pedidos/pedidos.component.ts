import { Component, OnInit } from '@angular/core';
import { APIServisService } from '../../servicios/apiservis.service';
import { Pedido } from '../../Modelos/Pedido';
@Component({
  selector: 'app-pedidos',
  templateUrl: './pedidos.component.html',
  styleUrls: ['./pedidos.component.css']
})
export class PedidosComponent implements OnInit {
  listaPedidos: any = [];
  listaPedidosAux: any = [];
  listaDetalles: any = [];
  
  constructor(private api: APIServisService) { }
  url=this.api.urlP+'Admin/Reportes/Factura.php?id=';
  pedidoSelec: Pedido = {
    Apellido: '',
    Cedula: '',
    Color: '',
    Direccion: '',
    Estado: '',
    Fecha: '',
    Id: '',
    Nombre: '',
    Total: '',
    Celular: ''
  };

  ngOnInit(): void {
    this.CargarPedidos();
  }
  CargarPedidos() {
    this.api.GetPedidos().subscribe(
      res => {
        this.listaPedidos = res;
        this.listaPedidosAux = res;
      },
      err => console.log(err)
    );
  }

  checkBien($event: KeyboardEvent) {

    this.listaPedidos = this.listaPedidosAux;

    let value = (<HTMLInputElement>event.target).value;
    const result = this.listaPedidos.filter(pedido => pedido.Id.search(value) >= 0
      || pedido.Cedula.search(value) >= 0
      || pedido.Nombre.toUpperCase().search(value.toUpperCase()) >= 0
      || pedido.Apellido.toUpperCase().search(value.toUpperCase()) >= 0
      || pedido.Fecha.toUpperCase().search(value.toUpperCase()) >= 0
      || pedido.Estado.toUpperCase().search(value.toUpperCase()) >= 0

    );
    this.listaPedidos = result;

  }
  textoBoton = '';
  color = '';

  selecPedido(p: Pedido) {
    this.pedidoSelec = p;
    if (p.Estado == 'Espera') {
      this.textoBoton = 'Aprobar';
      this.color = 'primary';

      (<HTMLButtonElement>document.getElementById('btnAccion')).style.display = 'block';
      (<HTMLButtonElement>document.getElementById('btnDescartado')).style.display = 'block';
      
    } else if (p.Estado == 'Aprobado') {
      this.textoBoton = 'Entregado';

      this.color = 'success';
      (<HTMLButtonElement>document.getElementById('btnAccion')).style.display = 'block';
      (<HTMLButtonElement>document.getElementById('btnDescartado')).style.display = 'block';
    } else {
      (<HTMLButtonElement>document.getElementById('btnDescartado')).style.display = 'none';
      (<HTMLButtonElement>document.getElementById('btnAccion')).style.display = 'none';
    }

    this.api.GetDetallesPedidos(p.Id).subscribe(
      res => {
        this.listaDetalles = res;
      },
      err => console.log(err)
    );
  }
  clickbtnAccion() {
    let id = '0';
    if (this.pedidoSelec.Estado == 'Espera') {
      id = '2';
    } else if (this.pedidoSelec.Estado == 'Aprobado') {
      id = '3';
    }
    this.api.ActualisarPedido(this.pedidoSelec.Id, id).subscribe(
      res => {
        this.CargarPedidos();
      },
      err => console.log(err)
    );
  }
  clickbtnDescartar(){
    this.api.ActualisarPedido(this.pedidoSelec.Id, 4).subscribe(
      res => {
        this.CargarPedidos();
      },
      err => console.log(err)
    );
  }
}
