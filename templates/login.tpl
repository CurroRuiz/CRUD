{config_load file="test.conf" section="setup"}
{include file="header.tpl" title=foo}

<PRE> 
    <p>     
        <TABLE  ALIGN=CENTER cellpadding=05 cellspacing=35 border=0>
            <TR>
                <Td STYLE="font-size:18px; color:black; text-align: center"> 
                    <p>Bienvenido a Proyectos CRUD</p>
                    Login</br>
                    Introduzca sus datos de identificacion
                    <form  name="datos1" action="index.php" method="post">
                       Usuario <input style="width:177px;text-align: center" color="black" type="text" name="usuario" id="usuario" maxlength=25 class="param"></br>
                       Contrase&ntilde;a&nbsp;<input style="width:150px" color="black" type="text" name="pswrd" id="pswrd" maxlength=10 class="param"></br>     
                       <input type="submit" value="ACCEDER"/>
                    </form>
                    <b>{$CadenaError|upper}</b>
                    <b>{$Cadena|upper}</b>
                </Td>
            </tr>
        </TABLE> 
    </p>
</PRE>