let idS = $("#id_ser").val();
let imagenes = $("#car_img");
let nombre = $("#nombre_p");
let descripcion = $("#descripcion_p");
let sku = $("#sku_p");


$(document).ready(() => {
    get_info();
  });

  function get_info() {
    $.ajax({
        url: base_url() + "public/Descripcion/get_informacion",
        dataType: "JSON",
        type: "POST",
        data: { idS: idS },
        })
        .done((data) => {
            console.log(data);
            nombre.empty();
            nombre.append(data[0].nombreS);
            descripcion.empty();
            descripcion.append(data[0].desS);
            sku.empty();
            sku.append('SKU: ' + data[0].skuS);
            imagenes.empty();
            $.each(data, function (i, o) {
                imagenes.append(
                    `<div style="background-image: url(` +
                    base_url() + `static/imgServicios/` + o.image_url + `);" class="item-box"></div>`
                );
            }
            );
        })
        .fail();

  }

//   <div style="background-image: url(img/products/shoes/1.jpg);" class="item-box"></div>