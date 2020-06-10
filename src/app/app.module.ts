import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { MenuComponent } from './componentes/menu/menu.component';
import { NavComponent } from './componentes/nav/nav.component';
import { ClientesComponent } from './componentes/clientes/clientes.component';
import { ProductosComponent } from './componentes/productos/productos.component';
import { PedidosComponent } from './componentes/pedidos/pedidos.component';

import { HttpClientModule } from '@angular/common/http';
import { NewProductoComponent } from './componentes/new-producto/new-producto.component';
import { EditProductoComponent } from './componentes/edit-producto/edit-producto.component';
@NgModule({
  declarations: [
    AppComponent,
    MenuComponent,
    NavComponent,
    ClientesComponent,
    ProductosComponent,
    PedidosComponent,
    NewProductoComponent,
    EditProductoComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
