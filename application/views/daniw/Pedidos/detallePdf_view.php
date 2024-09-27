<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido</title>

    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #2196F3;
            color: white;
        }
    </style>

</head>

<body>

    <!-- <p style="font-size: 10px;">Fecha emisión: </p> -->

    <table id="customers">

        <tr>
            <td style="text-align: center;" rowspan="3"><img style="width: 100; height: 70; text-align: center;" src="http://localhost/sdi_web/static/publico/img/sdi_logo.png"></td>
        </tr>

        <!--termina logo empresa-->
        <tr>
            <th colspan="4">Empresa</th>
            <th colspan="3">Sucursal</th>
        </tr>
        <tr>
            <td colspan="4">Servicios Digitales en Impresión</td>
            <td colspan="3"><?= $nombreSucursal ?></td>
        </tr>

    </table>
    
    <table id="customers">
        <tr>
            <th style="text-align: center">No. Pedido</th>
            <th>Nombre del cliente</th>
            <th>Token</th>
            <th>Fecha del pedido</th>
        </tr>
        <tr>
            <td align="center"> <?= $Venta[0]->idVenta ?></td> 
            <td> <?= $Venta[0]->nombreU." ".$Venta[0]->apellidos ?></td>
            <td> <?= $Venta[0]->tokenVenta ?></td>
            <td> <?= $Venta[0]->FechaVentaCierre ?></td>
        </tr>
    </table>

    <table id="customers">
        <!--Datos de la tabla--->
        <tr>
            <th>Producto</th>
            <th style="text-align: center">Imagen</th>
            <th>Detalle</th>
            <th style="text-align: center">Cantidad</th>
            <th style="text-align: center">P. Unitario</th>
            <th style="text-align: center">Subtotal</th>
        </tr>
        <?php foreach ($Detalle as $item) { ?>
            <tr>
                <td><?php echo $item->nombreS ?></td>
                <td align="center"><img alt="Profile Picture" src="<?= "http://localhost/sdi_web/static/imgServicios/" . $item->image_url ?>" style="height: 20px;"/></td>
                <td><?php echo $item->ProductoComentario ? $item->ProductoComentario : "Sin detalle" ?></td>
                <td align="center"><?php echo $item->Cantidad ?></td>
                <td align="center">$<?php echo $item->PrecioUnitario ?></td>
                <td align="center"><?php echo $item->subtotal ? "$".$item->subtotal : "No tiene subtotal" ?></td>  
            </tr>
        <?php } ?>
        <!--termina Datos de la tabla--->
    </table>
    <h1 align="right" class="mt-3"><strong>Total: <?= $Venta[0]->TotalVenta ?></strong></h1> 
</body>