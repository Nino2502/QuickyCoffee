<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona tu sucursal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                        value="favorito">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Sucursal favorita (Queretaro)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                        value="Otro">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Otra sucursal
                    </label>
                </div>
                <select class="form-select otroS" aria-label="Disabled select example" disabled>
                    <option selected>Selecionar sucursal</option>
                    <option value="1">San juan del Rios</option>
                    <option value="2">Queretaro 2</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" data-page='checkout' onclick='return clickgeneral(this)'
                    data-bs-dismiss="modal">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pagarTarjeta" tabindex="-1" aria-labelledby="pagarTarjetaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="pagarTarjetaLabel">Datos de tu tarjeta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Numero de tarjeta</label>
                        <input type="numero" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" aria-label="First name" class="form-control" placeholder="MM/YY">
                            <input type="text" aria-label="Last name" class="form-control" placeholder="CVC">
                            <span class="input-group-text">card</span>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick='pagar()'
                    data-bs-dismiss="modal">Pagar</button>
            </div>
        </div>
    </div>
</div>