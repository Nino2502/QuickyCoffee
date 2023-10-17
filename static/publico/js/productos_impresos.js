let contenedor = $("#tipo_cat");
let contenedor2 = $("#con_ser");
let Regresar = $("#regresar");

$(document).ready(() => {
  get_cat();
});

function get_cat() {
  contenedor2.empty();
  Regresar.empty();
  $.ajax({
    url: base_url() + "public/Produc_imp/obtenerTipoCat",
    dataType: "JSON",
    type: "POST",
  })
    .done((data) => {
      contenedor.empty();
      $.each(data, function (i, o) {
        contenedor.append(
          `<a href="#" onclick="get_serv(` +
            o.idCS +
            `)" class="col-6 col-md-4 col-xl-3 mb-4">
                  <div class="card">
                      <img src="` +
            base_url() +
            `static/img/categoriasServ/` +
            o.imagen +
            `" class="card-img-top" alt="imagen">
                      <div class="card-body">
                          <p class="card-text d-block">` +
            o.nombreCS +
            `</p>
                      </div>
                  </div>
              </a>`
        );
      });
    })
    .fail();
}

function get_serv(idCat) {
  contenedor.empty();
  Regresar.append(
    `<button type="button" class="btn btn-secondary m-5" onclick="get_cat()"> <i class="fa-solid fa-arrow-left"></i> Regresar</button>`
  );
  $.ajax({
    url: base_url() + "public/Produc_imp/obtener_Servicios",
    dataType: "JSON",
    type: "POST",
    data: { idCat: idCat },
  })
    .done((data) => {
      $.each(data, function (i, o) {
        contenedor2.append(
          `<div class="col-6 col-md-4 col-xl-3">
          <div class="grid_item">
          <figure>
          <a href="#" onClick="location.href='` +
            base_url() +
            `public/Descripcion/vista/` +
            o.idS +
            `';">
          <img class="img-fluid lazy" src="` +
            base_url() +
            `static/imgServicios/` +
            o.image_url +
            `" data-src="` +
            base_url() +
            `static/imgServicios/` +
            o.image_url +
            `" alt="..." style="height: 100%;">
            <img class="img-fluid lazy" src="` +
            base_url() +
            `static/imgServicios/` +
            o.image_url +
            `" data-src="` +
            base_url() +
            `static/imgServicios/` +
            o.image_url +
            `" alt="..." style="height: 100%;">
            </a>
            </figure>
            <a href="#" onClick="location.href='` +
            base_url() +
            `public/Descripcion/vista/` +
            o.idS +
            `';">
            <h3 class="card-title">` +
            o.nombreS +
            `</h3>
            </a>
            <ul>` +
            (id_U != 0 && Tok != null ? `<li><a class="tooltip-1" style=" cursor: pointer; "
             data-bs-toggle="tooltip" data-bs-placement="left"
             title="Añadir favoritos" onClick="addFav(` + o.idS + `)"><i class="fa-solid fa-heart-circle-plus"></i><span>Añadir
        favoritos</span></a></li>` : "")
             +
            `</ul>
        </div>
        </div>`
        );
      });
    })
    .fail();
}


