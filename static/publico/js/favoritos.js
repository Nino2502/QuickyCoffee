$(document).ready(() => {
if ($("#cont_fav") !== null) {
    get_fav();
}
});

function get_fav() {
  $.ajax({
    url: base_url() + "public/Favoritos/get_favoritos",
    dataType: "JSON",
    type: "POST",
  })
    .done((data) => {
      console.log(data);
      let cont_fav = $("#cont_fav");
      cont_fav.empty();
      $.each(data, function (i, o) {
        cont_fav.append(
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
            <ul> <li><a class="tooltip-1" style=" cursor: pointer; "
             data-bs-toggle="tooltip" data-bs-placement="left"
             title="Añadir favoritos" onClick="addFav(` + o.idS + `)"><i class="fa-solid fa-heart-circle-plus"></i><span>Añadir
        favoritos</span></a></li>`
             +
            `</ul>
        </div>
        </div>`
        );
      });
    })
    .fail();
}

function addFav(id) {
  //console.log(id);
  $.ajax({
    url: base_url() + "public/Favoritos/insertar",
    dataType: "JSON",
    type: "POST",
    data: { idS: id },
  })
    .done((data) => {
      console.log(data);
      if (data == true) {
        toastr["success"]("Se ha agregado a favoritos"); 
      } else if (data == "2") {
        toastr["warning"]("Ya se encuentra en favoritos"); 
      } else if (data == false) {
        toastr["danger"]("No se ha podido agregar a favoritos"); 
      }
    })
    .fail();
}
