import { Component, OnInit } from '@angular/core';
import { APIServisService } from '../../servicios/apiservis.service';
import { Router } from '@angular/router';
import {Producto} from '../../Modelos/Producto';
import { Detalle } from 'src/app/Modelos/Detalle';
@Component({
  selector: 'app-new-producto',
  templateUrl: './new-producto.component.html',
  styleUrls: ['./new-producto.component.css']
})
export class NewProductoComponent implements OnInit {


  constructor(private api: APIServisService, public router: Router) { }
  DetallesSelecionadas: any = [];
  listaCategorias: any = [];
  listaCategoriasAux: any = [];

  idCategoria;
  nomCategoria;
  ids = 0;
  ngOnInit(): void {
    this.cargarCategorias();
  }
  cargarCategorias() {
    this.api.getCategorias().subscribe(
      res => {
        this.listaCategorias = res;
        this.listaCategoriasAux = res;
      },
      err => console.log(err)
    );
  }
  onClickSelCat(idsel, nomsel) {
    this.idCategoria = idsel;
    this.nomCategoria = nomsel;
  }
  confirmar() {

    this.router.navigate(['/productos']);


  }
  checkPinCategorias($event: KeyboardEvent) {

    this.listaCategorias = this.listaCategoriasAux;

    let value = (<HTMLInputElement>event.target).value;
    const result = this.listaCategorias.filter(pedido => pedido.Nombre.toUpperCase().search(value.toUpperCase()) >= 0


    );
    this.listaCategorias = result;

  }
  guardarDetalle() {
    var nombreD = (<HTMLInputElement>document.getElementById("txt_NombreDet")).value;
    var PredioD = (<HTMLInputElement>document.getElementById("txt_PrecioDet")).value;
    let det = {
      Id: this.ids + 1,
      Nombre: nombreD,
      Precio: PredioD
    }
    if (nombreD.length > 0 && PredioD.length > 0) {
      this.DetallesSelecionadas.push(det);
      this.ids++;
      (<HTMLInputElement>document.getElementById("txt_NombreDet")).value='';
   (<HTMLInputElement>document.getElementById("txt_PrecioDet")).value='';
    } else {
      alert('Informacion Incompleta');
    }



  }
  guardarCategoria(){
    var nombreD = (<HTMLInputElement>document.getElementById("txt_NombreCat")).value;
 
    
    if (nombreD.length > 0 ) {
      this.api.GuardarCategoria(nombreD).subscribe(
        res => {
          (<HTMLInputElement>document.getElementById("txt_NombreCat")).value='';
          this.idCategoria = res.Id;
          this.nomCategoria = res.Nombre;
          this.cargarCategorias();
        },
        err => {
          console.log(err);
          alert('No de pudo añadir la nueva categoria');
        }
      );
        

    } else {
      alert('Informacion Incompleta');
    }

  }
  onClickQuitarDetalle(id) {
    for(let i=0;i<this.DetallesSelecionadas.length;i++){
      if(this.DetallesSelecionadas[i].Id==id){
        this.DetallesSelecionadas.splice(i,1);
      }
    }
  }
   //imagen
   base64textStringG = '';
   onUploadChange(evt: any) {
     const file = evt.target.files[0];
 
     if (file) {
       const reader = new FileReader();
 
       reader.onload = this.handleReaderLoaded.bind(this);
       reader.readAsBinaryString(file);
     }
   }
 
   handleReaderLoaded(e) {
     this.base64textStringG = 'data:image/png;base64,' + btoa(e.target.result);
     //console.log(this.base64textStringG);
   }
  onClickGuardar() {
    let pro:Producto={
      Id:'0',
      Nombre:(<HTMLInputElement>document.getElementById("txt_NombreG")).value,
      Foto:this.base64textStringG,
      Id_Categoria:this.idCategoria
    }
    if(this.validarProducto(pro)){
      this.api.GuardarProducto(pro).subscribe(
        res => {
          this.guardarDetalles(res.Id);
          (<HTMLInputElement>document.getElementById("txt_NombreG")).value='';
          this.DetallesSelecionadas=[];
          this.base64textStringG='';
          this.idCategoria='';
          this.nomCategoria='';
          this.ids=0;
        },
        err => {
          console.log(err);
          alert('No de pudo añadir el nuevo Producto');
        }
      );
    } 

  }
  guardarDetalles(id){
    for(let i=0;i<this.DetallesSelecionadas.length;i++){
      let det:Detalle={
        Id:'0',
        Nombre:this.DetallesSelecionadas[i].Nombre,
        Estado:'1',
        Precio:this.DetallesSelecionadas[i].Precio,
        Id_Producto:id
      }
      this.api.GuardarDetalle(det).subscribe(
        res => { },
        err => { }
      );
    }
  }
  validarProducto(p:Producto){
    if(p.Nombre.length==0){
      alert('Añada un nombre de producto');
      return false;
    }
    if(p.Id_Categoria.length==0){
      alert('Seleccione una categoria');
      return false;
    }
    /*
    if(p.Foto.length==0){
      alert('Añada una fotografia');
      return false;
    }
    */
    if(this.DetallesSelecionadas.length==0){
      alert('Añada minumo un detalle');
      return false;
    }

    return true;
  }


}
