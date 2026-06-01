



document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".text-uppercase-input").forEach((input) => {
    input.addEventListener("input", function () {
      this.value = this.value.toUpperCase();
    });
  });

  $("#id_cargore").select2({
    width: "100%",
    placeholder: "Seleccione un Cargo",
    language: {
      noResults: function () {
        return "No se encontraron resultados";
      },
      searching: function () {
        return "Buscando...";
      },
    },
  });

  $("#id_unidadre").select2({
    width: "100%",
    placeholder: "Seleccione una Unidad",
    language: {
      noResults: function () {
        return "No se encontraron resultados";
      },
      searching: function () {
        return "Buscando...";
      },
    },
  });
});

function registrarUserPrinciapal(e) {
  e.preventDefault();
  const ci = document.getElementById("ci");
  const nombres = document.getElementById("nombres");
  const apellidos = document.getElementById("apellidos");
  const celular = document.getElementById("celular");
  const cargo = document.getElementById("cargo");
  const unidad = document.getElementById("unidad");

  if (
    nombres.value == "" ||
    apellidos.value == "" ||
    celular.value == "" ||
    cargo.value == "" ||
    unidad.value == ""
  ) {
    alertas("Todos los campos son obligatorio ☺", "warning");
  } else {
    const url = base_url + "Usuarios/registroPrincipal"; //estamos enviando ala controlador
    const frm = document.getElementById("frmUsuario");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        alertasre(res.msg, res.icono);
      }
    };
  }
}
  function alertas(mensaje, icono) {
    Swal.fire({
      position: "top-end",
      icon: icono,
      title: mensaje,
      showConfirmButton: false,
      timer: 2000,
    });
  }

  function alertasre(mensaje, icono) {
    Swal.fire({
      html: mensaje,
      icon: icono,
      draggable: true,
      confirmButtonText: "OK", // Asegura que el botón diga OK
    }).then((result) => {
      /* Esta sección se ejecuta SOLO cuando el usuario interactúa con la alerta */
      if (icono === "success") {
        window.location.href = "index";
      }
    });
  }

