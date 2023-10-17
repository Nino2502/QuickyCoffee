<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Endroid\QrCode\QrCode;

class QRController extends CI_Controller {

    public function generateQR() {
        // Cargar la biblioteca de QRCode (asegúrate de que la ruta sea correcta)
        require APPPATH . 'libraries/qr-code/autoload.php';

        // URL para la que quieres generar el código QR
        $url = 'https://www.ejemplo.com';

        // Crea una instancia de QrCode
        $qrCode = new QrCode($url);

        // Establece el tamaño del código QR (opcional)
        $qrCode->setSize(300);

        // Puedes personalizar el código QR si lo deseas (colores, estilo, etc.)
        // Consulta la documentación de la biblioteca para más opciones de personalización.

        // Mostrar el código QR directamente en el navegador
        header('Content-Type: ' . $qrCode->getContentType());
        echo $qrCode->writeString();
    }
}