<?php
header('Content-Type: application/pdf');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


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

    <!-- <p style="font-size: 10px;">Fecha emisión: <?= $ventas->FechaVentaCierre ?></p> -->

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
        <!--Datos de la tabla--->
        <tr>
            <th>Sucursal</th>
            <th style="text-align: center">ID Venta</th>
            <th>Fecha</th>
            <th style="text-align: center">Cliente</th>
            <th style="text-align: center">Forma de pago</th>
            <th style="text-align: center">Factura</th>
            <th style="text-align: center">Vendedor</th>
            <th style="text-align: center">Total</th>
        </tr>
        <?php foreach ($data as $item) { ?>
            <tr>
                <td><?= $item->nombreSuc ? $item->nombreSuc : "Venta En Línea" ?></td>
                <td align="center"><?= $item->idVenta ?> </td>
                <td><?= $item->FechaVentaCierre ?></td>
                <td align="center"><?= $item->NombreCliente ?></td>
                <td align="center"><?= $item->nombreFP ?></td>
                <td align="center"><?= $item->Factura ? $item->Factura : "No hay factura" ?></td>
                <td align="center"><?= $item->nombreEmpleado ?></td>
                <td align="center">$<?= $item->TotalVenta ?></td>
            </tr>
        <?php } ?>
        <!--termina Datos de la tabla--->
    </table>
</body>

</html>