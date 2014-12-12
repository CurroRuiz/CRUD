{config_load file="test.conf" section="setup"}
{include file="header.tpl" title=foo}

<PRE> 
    <p>     
        <TABLE  ALIGN=CENTER cellpadding=05 cellspacing=35 border=0>
            <thead>
                <tr>
                    <th colspan=5 style=" background-color:#EDEF41;">{$cadenaSuper|UPPER}</th>
                </tr>
               <tr>
                    <th width="10%">N.proyecto</th>
                    <th width="50%">Nombre</th>
                    {if $interfaceTipo == 0}
                        <th width="20%">Jefe proyecto</th>
                    {/if}
                    {if $interfaceTipo == 2}
                        <th width="20%">Cliente</th>
                    {/if}
                    <th width="15%">Estado</th>
                    {if $interfaceTipo != 0}
                        <th width="5%">Editar</th>
                    {/if} 
                </tr>
            </thead>
            <tbody>   
            {section name = tabla loop = $datosTabla} 
                {if $smarty.section.tabla.index % 2 == 0}
                    <tr  onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="white" />
                {/if}
                {if $smarty.section.tabla.index % 2 != 0}
                    <tr class="odd" onmouseOver=this.style.backgroundColor="#E8E6E6" onMouseout=this.style.backgroundColor="#E5EECC" />
                {/if}
                    <td> {$datosTabla[tabla]->getNproyecto()} </td>
                    <td> {$datosTabla[tabla]->getNombre()} </td>
                    {if $interfaceTipo == 0}
                        <td> {$datosTabla[tabla]->getJefeProyecto()} </td>
                    {/if}
                    {if $interfaceTipo == 2}
                        <td> {$datosTabla[tabla]->getCliente()} </td>
                    {/if}                 
                    <td> {$datosTabla[tabla]->getEstado()} </td>
                    {if $interfaceTipo != 0}
                         <td><img title="Editar" alt="Editar" src="img/editar.png" width="30" height="30" onclick="location.href='editar.php?id={$datosTabla[tabla]->getNproyecto()}'"/></td>
                    {/if}     
                </Tr>
            {/section}
            </TBODY>
        </TABLE>
            <form  name="datos1" action="index.php" method="post">
                <input type="submit" value="Salir"/>
            </form>
    </p>
</PRE>