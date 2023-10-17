<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs " role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false" onclick="Clientes()">
                    <h3>Clientes</h3>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">
                    <div id="title">
                        <h3 ></h3>
                    </div>
                </a>
            </li>

        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">

            <!-- inicia el primer tab-->
            <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <!-- <button type="button" class="btn btn-primary mr-3 mb-4" onclick="agregar()" >
                                + Agregar
                            </button> -->


                <div class="row mb-4">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body" id="despliegueTabla"></div>
                        </div>
                    </div>
                </div>

            </div>

            <!--termina aqui, inicia segundo tab-->



        </div>
    </div>
    <!--termina cardBody-->
</div>