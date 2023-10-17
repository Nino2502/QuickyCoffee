<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">



<style>

    .modal-open .select2-container {

        z-index: 9999 !important;

    }



    .select2-container--bootstrap .select2-results__group {

        z-index: 9999 !important;

        color: #000 !important;

        display: block;

        padding: 6px 12px;

        font-size: 13px;

        line-height: 1.42857143;

        white-space: nowrap;

    }



    .modal {

        padding: 0 !important; 

    }

    .modal .modal-dialog {

        

        width: 100%;

        max-width: none;

        height: 100%;

        margin: 0;

    }

    .modal .modal-content {

        height: 100%;

        border: 0;

        border-radius: 0;

    }

    .modal .modal-body {

        overflow-y: auto;

    }

    

    .modal .modal-confirm {



        color: #636363;

        width: 400px;

        height: auto;

        font-family: 'Varela Round', sans-serif !important;

    }

    .modal .modal-confirm .modal-content {

        padding: 20px;

        border-radius: 5px;

        border: none;

        text-align: center;

        font-size: 14px;

        font-family: 'Varela Round', sans-serif !important;

    }

    .modal .modal-confirm .modal-header {

        border-bottom: none;   

        position: relative;

    }

    .modal .modal-confirm h4 {

        text-align: center;

        font-size: 26px;

        margin: 30px 0 -10px;

    }

    .modal .modal-confirm .close {

        position: absolute;

        top: -5px;

        right: -2px;

    }

    .modal .modal-confirm .modal-body {

        color: #999;

    }

    .modal .modal-confirm .modal-footer {

        border: none;

        text-align: center;		

        border-radius: 5px;

        font-size: 13px;

        padding: 10px 15px 25px;

    }

    .modal .modal-confirm .modal-footer a {

        color: #999;

    }		

    .modal .modal-confirm .icon-box {

        width: 80px;

        height: 80px;

        margin: 0 auto 20px auto;

        border-radius: 50%;

        z-index: 9;

        text-align: center;

        border: 3px solid #418B4F;

    }

    .modal .modal-confirm .icon-box i {

        color: #418B4F;

        font-size: 46px;

        display: inline-block;

        margin-top: 13px;

    }

    .modal .modal-confirm .btn, .modal-confirm .btn:active {

        color: #fff;

        border-radius: 4px;

        background: #60c7c1;

        text-decoration: none;

        transition: all 0.4s;

        line-height: normal;

        min-width: 120px;

        border: none;

        min-height: 40px;

        border-radius: 3px;

        margin: 0 5px;

    }

    .modal .modal-confirm .btn-secondary {

        background: #2a93d5;

    }

    .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {

        background: #a8a8a8;

    }

    .modal .modal-confirm .btn-danger {

        background: #f15e5e;

    }

    .modal .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {

        background: #ee3535;

    }

    .modal .trigger-btn {

        display: inline-block;

        margin: 100px auto;

    }

</style>




<!-- modal eliminar especialidades -->

<div id="modal-reportarPago" class="modal fade" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-confirm mx-auto mt-5">

        <div class="modal-content">

            <div class="modal-header flex-column">

                <div class="icon-box">

					<i class="material-icons">&#xef6e;</i>

				</div>
				
				<div id="tituloReporte">
				
				
				</div>

               

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>

            <div class="modal-body">
				
				
				
				<div id="bodyReportePago"></div>
				
				
				<?php $date = date('d-m-y h:i:s'); echo $date; ?>
				
                
			</div>
		
			
			
			<div class="form-group">

                            <label class="form-control-label" for="descripcion">Escribe la referencia o comentario</label>

                            <textarea type="text" id="comentario-reporte" required="" class="form-control"></textarea>

                        </div>
			
			



            <div class="modal-footer justify-content-center">

				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

				<button id="btn-reporte-enviar" type="button" class="btn btn-secondary" onClick="enviaReporte()">ACEPTAR</button>

			</div>

        </div>

    </div>

</div>

