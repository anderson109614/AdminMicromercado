import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {Categoria} from '../Modelos/Categoria';
import {Producto} from '../Modelos/Producto';
import {Detalle} from '../Modelos/Detalle';
@Injectable({
  providedIn: 'root'
})
export class APIServisService {
 // urlP:string='https://serviciosand.000webhostapp.com/Servicios/'; 
 //public urlP: string = 'http://localhost/AdminMicromercado/API-Micromercado/';
 //urlP:string='http://micromercadoand.atwebpages.com/API-Micromercado/'; 
 urlP:string='http://app-ee239fef-4504-41bf-9543-34aa7055f385.cleverapps.io/API-Micromercado/'; 
  constructor(private http: HttpClient) { }

  postLogin(usr,pass){
    let log={
      cedula:usr,
      contrasena:pass
    }
    return this.http.post(this.urlP+'Admin/Login/Login.php', log);
  }
  GetClientes(){
    return this.http.get(this.urlP+'Admin/Cliente/Cliente.php' );
  }
  GetPedidos(){
    return this.http.get(this.urlP+'Admin/Pedidos/Pedidos.php');
  }
  GetDetallesPedidos(id:string){
    return this.http.get(this.urlP+'Admin/Pedidos/Pedidos.php?Id='+id );
  }
  ActualisarPedido(idp:string,idEstadop){
    let en={
      id:parseInt(idp),
      idEstado:parseInt(idEstadop)
    }
    return this.http.put(this.urlP+'Admin/Pedidos/Pedidos.php',en );
  }
  getProductos(){
    return this.http.get(this.urlP+'Admin/Productos/Producto.php');
  }
  getProductosId(id){
    return this.http.get(this.urlP+'Admin/Productos/Producto.php?Id='+id);
  }
  getCategorias(){
    return this.http.get(this.urlP+'Admin/Productos/Categoria.php');
  }
  GuardarCategoria(nom){
    let log={
      Id:0,
      Nombre:nom
    }
    return this.http.post<Categoria>(this.urlP+'Admin/Productos/Categoria.php', log);
  }
  GuardarProducto(pro:Producto){
    return this.http.post<Producto>(this.urlP+'Admin/Productos/Producto.php', pro);
  }
  GuardarDetalle(det:Detalle){
    return this.http.post<Detalle>(this.urlP+'Admin/Productos/Detalles.php', det);
  }
  getDetallesd(id){
    return this.http.get(this.urlP+'Admin/Productos/Detalles.php?Id='+id);
  }
  DeleteDetallesd(id){
    return this.http.delete(this.urlP+'Admin/Productos/Detalles.php?Id='+id);
  }
  DeleteProducto(id){
    return this.http.delete(this.urlP+'Admin/Productos/Producto.php?Id='+id);
  }
  ActualizarProducto(pro:Producto){
    return this.http.put<Producto>(this.urlP+'Admin/Productos/Producto.php', pro);
  }
}
