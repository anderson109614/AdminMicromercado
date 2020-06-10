import { Component, OnInit } from '@angular/core';
import { APIServisService } from '../../servicios/apiservis.service';
@Component({
  selector: 'app-productos',
  templateUrl: './productos.component.html',
  styleUrls: ['./productos.component.css']
})
export class ProductosComponent implements OnInit {

  constructor(private api: APIServisService) { }
listaProductos:any=[];
listaProductosAux:any=[];

  ngOnInit(): void {
    this.cargarProductos();
  }
  cargarProductos(){
    this.api.getProductos().subscribe(
      res => {
        this.listaProductos = res;
        this.listaProductosAux = res;
      },
      err => console.log(err)
    );
  }
  
  checkBien($event: KeyboardEvent) {

    this.listaProductos = this.listaProductosAux;

    let value = (<HTMLInputElement>event.target).value;
    const result = this.listaProductos.filter(pedido => pedido.idProducto.search(value) >= 0
  
      || pedido.Categoria.toUpperCase().search(value.toUpperCase()) >= 0
      || pedido.Producto.toUpperCase().search(value.toUpperCase()) >= 0
      

    );
    this.listaProductos = result;

  }
  eliminarBien(idp){
    if (confirm("¿Desea eliminar este pruducto?")) {
      this.api.DeleteProducto(idp).subscribe(
        res => {
          this.cargarProductos();
        },
        err => console.log(err)
      );
    } 
    
  }
}
