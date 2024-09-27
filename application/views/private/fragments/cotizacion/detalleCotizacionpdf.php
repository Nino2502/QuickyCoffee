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
            <th colspan="4" style="text-align: center"></th>
            <th colspan="3" style="text-align: center"></th>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center">PizzOptimize</td>
            <td colspan="3" style="text-align: center">PO</td>
            <!-- <?= ($nombreSucursal->nombreSuc) ?> -->
        </tr>

    </table>
    
    <table style="text-align: center" id="customers">
        <tr>
            <th style="text-align: center">#cotizacion</th>
            <th style="text-align: center">Nombre del cliente</th>
            
            <th style="text-align: center">Fecha cotización</th>
        </tr>
        <tr>
            <td style="text-align: center" align="center"> <?= $contenido->idCotizacion ?></td> 
            <td style="text-align: center"> <?= $DatosCliente->nombreU." ".$DatosCliente->apellidos ?></td>
            
            <td style="text-align: center"> <?= $contenido->fechaCotizacion ?></td>
        </tr>
    </table>

    <table style="text-align: center" id="customers">
        <!--Datos de la tabla--->
        <tr>
            <th style="text-align: center">Producto</th>
            <th style="text-align: center">Imagen</th>
            <th style="text-align: center">Descripción</th>
            <th style="text-align: center">Cantidad</th>
            <th style="text-align: center">P. Unitario</th>
            <th style="text-align: center">Subtotal</th>
        </tr>
        <p>
        
        </p>
        <?php foreach ($Servicios as $item) { ?>
            <tr>
        <td style="text-align: center;"><b>Servicio:</b> <?= $item['idServicio'] ?></td>
        <td align="center"><img alt="Profile Picture" src="<?= "http://localhost/sdi_web/static/imgServicios/" . $item['image_url'] ?>" style="height: 20px;"/></td>
        <td><?= $item['desS'] ? $item['desS'] : "Sin detalle" ?></td>
        <td align="center"><?= $item['Cantidad'] ?></td>
        <td align="center">$<?= $item['PrecioUnitario'] ?></td>
        <td align="center"><?= $item['subtotal'] ? "$" . $item['subtotal']. " MXN" : "No tiene subtotal" ?></td>  
            </tr>
        <?php } ?>

        <!--termina Datos de la tabla--->
    </table>
        <hr>
    <?php
        $total = 0; // Variable para almacenar el total

        foreach ($Servicios as $item) {
            // Resto del código para mostrar los detalles de cada servicio

            // Sumar el subtotal al total
            $subtotal = isset($item['subtotal']) ? $item['subtotal'] : 0;
            $total += $subtotal;
        }
    ?>

 <h1 align="right" class="mt-3"><strong>Total: <?= $total; ?> MXN</strong></h1> 
   
</body>