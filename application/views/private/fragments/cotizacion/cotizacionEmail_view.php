<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/main.css" />
	<link rel="stylesheet" href="<?= base_url() ?>static/fontawesome-6.2.1-web/css/all.css" />
	<link rel="stylesheet" href="<?= base_url() ?>static/toastr/toastr.min.css" />



    <title>Document</title>
</head>
<body style="margin:0; padding:0; background-color:#f8f8f8; padding-top: 10px;">

    <!--Mailing Start-->
    <div leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="height:auto !important;width:100% !important; font-family: Helvetica,Arial,sans-serif !important; margin-bottom: 40px;">
        <center>
<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="max-width:600px; background-color:#ffffff;border:1px solid #e4e2e2;border-collapse:separate !important; border-radius:4px;border-spacing:0;color:#242128; margin:0;padding:40px;"
                heigth="auto">
                <tbody>
                    <tr>
                        <td align="left" valign="center" style="padding-bottom:40px;border-top:0;height:100% !important;width:100% !important;">
                            <img style="height: 100px" src="<?= base_url('static/publico/img/sdi_logo.png') ?>" />
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;border-top:1px solid #e4e2e2">
                            <h3 style="color:#303030; font-size:18px; line-height: 1.6; font-weight:500;">SDI - Cotización</h3>
                            <p style="color:#8f8f8f; font-size: 14px; padding-bottom: 20px; line-height: 1.4;">
                            Nos complace saber que has elegido nuestros productos/servicios y que has confiado en nosotros para satisfacer tus
                            necesidades. Nos esforzamos continuamente para brindar productos/servicios de la más alta calidad y garantizar tu satisfacción.

                          
                            </p>
                           
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse;">
                                <tbody>
                                    <tr>
                                        <td style="padding:15px 0px;" valign="top" align="center">
                                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate !important;">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" valign="middle" style="padding:13px;">
                                                            <a href="<?= base_url('public/cotizacionExterno/Print_cotizacion/' . $cotizacion) ?>" target="_blank" style="font-size: 14px; line-height: 1.5; font-weight: 700; letter-spacing: 1px; padding: 15px 40px; text-align:center; text-decoration:none; color:#FFFFFF; border-radius: 50px; background-color:#145388;">Descargar PDF</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </div>

</body>
</html>