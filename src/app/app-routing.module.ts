import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {ClientesComponent} from './componentes/clientes/clientes.component';
import {PedidosComponent} from './componentes/pedidos/pedidos.component';
import {ProductosComponent} from './componentes/productos/productos.component';


const routes: Routes = [
  {path:'clientes',component:ClientesComponent},
  {path:'pedidos',component:PedidosComponent},
  {path:'productos',component:ProductosComponent}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
export const routingComponents = [ClientesComponent,PedidosComponent,ProductosComponent]