{config_load file="test.conf" section="setup"}
{include file="header.tpl" title=foo}

<PRE> 
    <p>
   
    <table>
        <tr>
            <TD colspan="2">
                    <h1>PROYECTO {$datosProyecto->getNproyecto()}</h1> 
                    <b>Nombre del proyecto:</b>{$datosProyecto->getNombre()}</br>
                    <b>Cliente del proyecto:</b>{$datosProyecto->getCliente()}</br>
                    <b>Jefe del proyecto:</b>{$datosProyecto->getJefeProyecto()}</br>
                    <b>Descripcion del proyecto:</b>{$datosProyecto->getDescripcion()}</br>
                     <form  name="cambiaestado" action="editar.php?id={$datosProyecto->getNproyecto()}" method="post">
                            <b>Estado:</b>
                            <select name="estado"  id="estado">
                                {html_options values=$estadosValores selected=$datosProyecto->getEstadoNumerico() output=$estadosCadena}
                            </select>
                           <input type="submit" value="Cambiar estado"/>
                    </form>
            </TD>
        </tr>
        <tr>
            <td>
            <form  name="salida" action="principal.php" method="post">
                <input type="submit" value="Volver"/>
            </form>
            </td>
            <td>

            </td>
        </tr>
    </TABLE>
    {if $interfaceTipo == 2 }{*Solo accedemos a esta parte si somos jefes*}
        {*Tabla de materiales asignados*}
        <TABLE  ALIGN=CENTER cellpadding=05 cellspacing=35 border=0>
            <thead>
                <tr>
                    <th colspan=5 style=" background-color:#3AC234;">Recursos asignados</th>
                </tr>
               <tr>
                    <th width="10%">N.Serie</th>
                    <th width="15%">Tipo</th>
                    <th width="30%">Nombre</th>
                    <th width="20%">Marca</th>
                    <th width="5%">Liberar</th>                   
                </tr>
            </thead>
            <tbody>   
            {section name = tablaMaterialesAsig loop = $materialesAsignados} 
                {if $smarty.section.tablaMaterialesAsig.index % 2 == 0}
                    <tr  onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="white" />
                {/if}
                {if $smarty.section.tablaMaterialesAsig.index % 2 != 0}
                    <tr class="odd" onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="#E5EECC" />
                {/if}
                    <td> {$materialesAsignados[tablaMaterialesAsig]->getNserie()} </td>
                    <td> {$materialesAsignados[tablaMaterialesAsig]->getTipo()} </td>                 
                    <td> {$materialesAsignados[tablaMaterialesAsig]->getNombre()} </td>
                     <td> {$materialesAsignados[tablaMaterialesAsig]->getMarca()} </td>
                    <td><img title="Liberar" alt="Liberar" src="img/cancelar.png" width="30" height="30" onclick="location.href='editar.php?id={$datosProyecto->getNproyecto()}&dasg={$materialesAsignados[tablaMaterialesAsig]->getNserie()}'"/></td>                      
                </Tr>
            {/section}
            </TBODY>
        </TABLE>
        {*Tabla de empleados asignados*}
        <TABLE  ALIGN=CENTER cellpadding=05 cellspacing=35 border=0>
            <thead>
                <tr>
                    <th colspan=3 style=" background-color:#3AC234;">Empleados asignados</th>
                </tr>
               <tr>
                    <th width="10%">Dni</th>
                    <th width="15%">Nombre</th>
                    <th width="5%">Liberar</th>                   
                </tr>
            </thead>
            <tbody>   
            {section name = tablaEmpleadosAsig loop = $empleadosAsignados} 
                {if $smarty.section.tablaEmpleadosAsig.index % 2 == 0}
                    <tr  onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="white" />
                {/if}
                {if $smarty.section.tablaEmpleadosAsig.index % 2 != 0}
                    <tr class="odd" onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="#E5EECC" />
                {/if}
                    <td> {$empleadosAsignados[tablaEmpleadosAsig]->getDni()} </td>
                    <td> {$empleadosAsignados[tablaEmpleadosAsig]->getNombre()} </td>                 
                    <td><img title="Liberar" alt="Liberar" src="img/cancelar.png" width="30" height="30" onclick="location.href='editar.php?id={$datosProyecto->getNproyecto()}&dasgEmpl={$empleadosAsignados[tablaEmpleadosAsig]->getDni()}'"/></td>                      
                </Tr>
            {/section}
            </TBODY>
        </TABLE>
        {*Tabla de materiales disponibles*}
        <TABLE  ALIGN=CENTER cellpadding=05 cellspacing=35 border=0>
            <thead>
                <tr>
                    <th colspan=5 style=" background-color:#EDEF41;">Recursos disponibles</th>
                </tr>
               <tr>
                    <th width="10%">N.Serie</th>
                    <th width="15%">Tipo</th>
                    <th width="30%">Nombre</th>
                    <th width="20%">Marca</th>
                    <th width="5%">Asignar</th>                  
                </tr>
            </thead>
            <tbody>   
            {section name = tablaMateriales loop = $datosMateriales} 
                {if $smarty.section.tablaMateriales.index % 2 == 0}
                    <tr  onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="white" />
                {/if}
                {if $smarty.section.tablaMateriales.index % 2 != 0}
                    <tr class="odd" onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="#E5EECC" />
                {/if}
                    <td> {$datosMateriales[tablaMateriales]->getNserie()} </td>
                    <td> {$datosMateriales[tablaMateriales]->getTipo()} </td>                 
                    <td> {$datosMateriales[tablaMateriales]->getNombre()} </td>
                    <td> {$datosMateriales[tablaMateriales]->getMarca()} </td>
                    <td><img title="Asignar" alt="Asignar" src="img/aceptar.png" width="30" height="30" onclick="location.href='editar.php?id={$datosProyecto->getNproyecto()}&asg={$datosMateriales[tablaMateriales]->getNserie()}'"/></td>                    
                </Tr>
            {/section}
            </TBODY>
        </TABLE>
        {*Tabla de empleados disponibles*}
        <TABLE  ALIGN=CENTER cellpadding=05 cellspacing=35 border=0>
            <thead>
                <tr>
                    <th colspan=3 style=" background-color:#EDEF41;">Empleados disponibles</th>
                </tr>
               <tr>
                    <th width="10%">Dni</th>
                    <th width="15%">Nombre</th>
                    <th width="5%">Asignar</th>                  
                </tr>
            </thead>
            <tbody>   
            {section name = tablaEmpleados loop = $datosEmpleados} 
                {if $smarty.section.tablaEmpleados.index % 2 == 0}
                    <tr  onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="white" />
                {/if}
                {if $smarty.section.tablaEmpleados.index % 2 != 0}
                    <tr class="odd" onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="#E5EECC" />
                {/if}
                    <td> {$datosEmpleados[tablaEmpleados]->getDni()} </td>
                    <td> {$datosEmpleados[tablaEmpleados]->getNombre()} </td>                 
                    <td><img title="Asignar" alt="Asignar" src="img/aceptar.png" width="30" height="30" onclick="location.href='editar.php?id={$datosProyecto->getNproyecto()}&asgEmpl={$datosEmpleados[tablaEmpleados]->getDni()}'"/></td>                    
                </Tr>
            {/section}
            </TBODY>
        </TABLE>
    {/if}
    </p>
</PRE>