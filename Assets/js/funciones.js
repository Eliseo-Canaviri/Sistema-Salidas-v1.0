let tblUsuarios,
  tblestudiante,
  tblUsuariosInactivos,
  tblIngreso,
  tblEgresos,
  tblPermisos,
  tblAnotes,
  tblSalidas;
document.addEventListener("DOMContentLoaded", function () {
  $(document).on("click", ".ver-mas", function (e) {
    e.preventDefault();

    let texto = $(this).data("texto");

    Swal.fire({
      title: "Actividad",
      html: texto,
      icon: "info",
      confirmButtonText: "Cerrar",
      width: "600px",
    });
  });

  //inicio de perfil
  $("#perfil_cargo").select2({
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

  $("#perfil_unidad").select2({
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

  //fin perfil

  $("#id_unidad").select2({
    dropdownParent: $("#nuevo_usuario"),
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
  $("#id_cargo").select2({
    dropdownParent: $("#nuevo_usuario"),
    width: "100%",
    placeholder: "Seleccione una Cargo",
    language: {
      noResults: function () {
        return "No se encontraron resultados";
      },
      searching: function () {
        return "Buscando...";
      },
    },
  });
  ///fin de select2 cargos

  $("#id_chofer").select2({
    dropdownParent: $("#modal_salida"),
    width: "100%",
    placeholder: "Seleccione un Chofer",
    language: {
      noResults: function () {
        return "No se encontraron resultados";
      },
      searching: function () {
        return "Buscando...";
      },
    },
  });
  const language = {
    decimal: "",
    emptyTable: "No hay información",
    info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
    infoFiltered: "(Filtrado de _MAX_ total entradas)",
    infoPostFix: "",
    thousands: ",",
    lengthMenu: "Mostrar _MENU_ Entradas",
    loadingRecords: "Cargando...",
    processing: "Procesando...",
    search: "Buscar:",
    zeroRecords: "Sin resultados encontrados",
    paginate: {
      first: "Primero",
      last: "Ultimo",
      next: "Siguiente",
      previous: "Anterior",
    },
  };
  const buttons = [
    {
      //Botón para Excel
      extend: "excel",
      footer: true,
      title: "Archivo",
      filename: "Export_File",

      //Aquí es donde generas el botón personalizado
      text: '<button class="btn btn-success"><i class="fa-regular fa-file-excel"></i></button>',
    },
    //Botón para PDF
    {
      extend: "pdf",
      footer: true,
      title: "Archivo PDF",
      filename: "reporte",
      text: '<button class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i></button>',
    },
    //Botón para print
    {
      extend: "print",
      footer: true,
      title: "Reportes",
      filename: "Export_File_print",
      text: '<button class="btn btn-info"><i class="fa-solid fa-print"></i></button>',
    },
  ];

  tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "Usuarios/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "ci" },
      { data: "nombres" },
      { data: "apellidos" },
      { data: "celular" },
      { data: "id_cargo" },
      { data: "id_unidad" },
      { data: "estado" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    language,
    buttons,
  });

  //fin de la tabla usuario

  tblestudiante = $("#tblestudiante").DataTable({
    ajax: {
      url: base_url + "Estudiante/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "ci" },
      { data: "nombre" },
      { data: "estado" },
      { data: "acciones" },
    ],
  });
  // Do this before you initialize any of your modals

  ///fin de estudinates
  tblIngreso = $("#tblIngreso").DataTable({
    ajax: {
      url: base_url + "Ingresos/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_ingreso" },
      { data: "ingreso" },
      { data: "descripcion" },
      { data: "estado" },
      { data: "acciones" },
    ],
  });
  //fin de  tblIngreso
  tblEgresos = $("#tblEgresos").DataTable({
    ajax: {
      url: base_url + "Egresos/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_egreso" },
      { data: "gasto" },
      { data: "descripcion" },
      { data: "fecha_actual" },
      { data: "estado" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
    language,
    buttons,
    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
  });
  //fin de tblEgresos

  tblPermisos = $("#tblPermisos").DataTable({
    ajax: {
      url: base_url + "Permisos/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_permiso" },
      { data: "permiso" },
      { data: "estado" },
      { data: "acciones" },
    ],
  });
  //fin de tblEgresos

  tblAnotes = $("#tblAnotes").DataTable({
    ajax: {
      url: base_url + "Anotes/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_anote" },
      { data: "titulo" },
      { data: "descripcion" },
      { data: "fecha_actual" },
      { data: "estado" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
  //fin de tblAnotes

  tblSalidas = $("#tblSalidas").DataTable({
    ajax: {
      url: base_url + "Salidas/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_salida" },
      { data: "nombre_usuario" },
      {
        data: "actividad",
        render: function (data, type, row) {
          if (data && data.length > 50) {
            return `
                <span>${data.substring(0,10)}...</span>
                <a href="#" class="ver-mas" data-texto="${data.replace(/"/g, "&quot;")}">
                    Ver más
                </a>
            `;
          }
          return data;
        },
      },
      { data: "lugar" },
      { data: "transporte" },
      { data: "fecha_salida" },
      { data: "hora_salida" },
      { data: "fecha_llegada" },
      { data: "hora_llegada" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
    language,
    buttons,
    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
  });
  //fin de tblSalidas

  tblSalidasInactivas = $("#tblSalidasInactivas").DataTable({
    ajax: {
      url: base_url + "Salidas/inactivos",
      dataSrc: "",
    },
    columns: [
      { data: "id_salida" },
      { data: "nombre_usuario" },
      { data: "actividad" },
      { data: "lugar" },
      { data: "transporte" },
      { data: "fecha_salida" },
      { data: "hora_salida" },
      { data: "hora_llegada" },
      { data: "acciones" },
    ],
  });

  tblcargos = $("#tblcargos").DataTable({
    ajax: {
      url: base_url + "Cargos/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_cargo" },
      { data: "nombre" },
      { data: "estado" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
    language,
    buttons,
    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
  });

  tblunidades = $("#tblunidades").DataTable({
    ajax: {
      url: base_url + "Unidades/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_unidad" },
      { data: "nombre" },
      { data: "estado" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
    language,
    buttons,
    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
  });

  //fin de unidad
  tblchoferes = $("#tblchoferes").DataTable({
    ajax: {
      url: base_url + "Choferes/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_chofer" },
      { data: "nlicencia" },
      { data: "nombres" },
      { data: "categoria" },
      { data: "estado" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
    language,
    buttons,
    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
  });
});

function editarPerfil() {
  document.getElementById("editarPerfil").classList.remove("d-none");
}
function actualizarDatosUsuario(e) {
  e.preventDefault();
  const ci = document.getElementById("ci").value;
  const nombres = document.getElementById("nombres").value;
  const apellidos = document.getElementById("apellidos").value;
  const celular = document.getElementById("celular").value;

  if (nombres == "" || apellidos == "" || ci == "" || celular == "") {
    alertas("Todo los campos son requeridos", "warning");
    return false;
  } else {
    const url = base_url + "Usuarios/actualizarDatosUsuario";
    const frm = document.getElementById("frmDatos");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        setTimeout(() => {
          location.reload();
        }, 3000);
      }
    };
  }
}
function frmInactivos() {}
//fin de las tablas !!!!!-------------------------------------------------------------------------------------

function frmCambiarPass(e) {
  e.preventDefault();
  const actual = document.getElementById("clave_actual").value;
  const nueva = document.getElementById("clave_nueva").value;
  const confirmar = document.getElementById("confirmar_clave").value;
  if (actual == "" || nueva == "" || confirmar == "") {
    alertas("Todos los campos son obligatorio ☺", "warning");
  } else {
    if (nueva != confirmar) {
      alertas("Las contraseñas no conciden ☺", "warning");
    } else {
      const url = base_url + "Usuarios/cambiarPass"; //estamos enviando ala controlador
      const frm = document.getElementById("frmCambiarPass");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          $("#cambiarPass").modal("hide"); //para que se oculte el domal de usuario
          frm.reset();
        }
      };
    }
  }
}
function togglePassword(id) {
  const input = document.getElementById(id);
  const icon = input.nextElementSibling.nextElementSibling.querySelector("i");
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}

function frmUsuario() {
  document.getElementById("title").innerHTML = "Nuevo Usuario";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  //document.getElementById("claves").classList.remove("d-none"); //para mostrar compo de claves
  document.getElementById("frmUsuario").reset();

  $("#nuevo_usuario").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id").value = "";
}

function registrarUser(e) {
  e.preventDefault();

  const ci = document.getElementById("ci");
  const nombres = document.getElementById("nombres");
  const apellidos = document.getElementById("apellidos");
  const celular = document.getElementById("celular");
  const id_cargo = document.getElementById("id_cargo");
  const id_unidad = document.getElementById("id_unidad");

  if (
    nombres.value == "" ||
    apellidos.value == "" ||
    celular.value == "" ||
    id_cargo.value == "" ||
    id_unidad.value == ""
  ) {
    alertas("Todos los campos son obligatorio ☺", "warning");
  } else {
    const url = base_url + "Usuarios/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmUsuario");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);

        $("#nuevo_usuario").modal("hide"); //ocultar modal
        alertas(res.msg, res.icono);
        tblUsuarios.ajax.reload(); //para que se actualise automaticamente la pagina
      }
    };
  }
}

function btnEditarUser(id) {
  document.getElementById("title").innerHTML = "Actulizar Usuario";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Usuarios/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("correo").value = res.correo;
      document.getElementById("usuario").value = res.usuario;

      document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_usuario").modal("show");
    }
  };
}

function btnEliminarUser(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblUsuarios.ajax.reload(); //recargar pagina de usuario
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}
function btnReingresarUser(id) {
  Swal.fire({
    title: "Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          //tblInactivos.ajax.reload(); //recargar pagina de usuario
          alertas(res.msg, res.icono);
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        }
      };
    }
  });
}

//fin de Usaurio !!!!!!--------------------------------------------------------------------------------------

function modificarEmpresa() {
  const frm = document.getElementById("frmConfig");
  const url = base_url + "ConfigAdmin/modificar";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      if (res == "ok") {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Modificado con Exito ☺",
          showConfirmButton: false,
          timer: 2000,
        });
      }
    }
  };

  // body...
}
///fin de empresa

function frmEstudiante() {
  document.getElementById("title").innerHTML = "Nuevo Estudiante";
  document.getElementById("btnAccion").innerHTML = "registrar";
  document.getElementById("frmEstudiante").reset();

  $("#nuevo_estudiante").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id").value = "";
}
function registrarEstudiante(e) {
  e.preventDefault();
  const ci = document.getElementById("ci");
  const nombre = document.getElementById("nombre");

  if (ci.value == "" || nombre.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Estudiante/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmEstudiante");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        $("#nuevo_estudiante").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblestudiante.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
function btnEditarEstudiante(id) {
  document.getElementById("title").innerHTML = "Actulizar Estudiante";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Estudiante/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      document.getElementById("id").value = res.id;
      document.getElementById("ci").value = res.ci;
      document.getElementById("nombre").value = res.nombre;

      //document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_estudiante").modal("show");
    }
  };
}

function btnEliminarEstudiante(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Estudiante/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblestudiante.ajax.reload(); //recargar tabla
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function btnReingresarEstudiante(id) {
  Swal.fire({
    title: "Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Estudiante/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje!", "Usuario Reingresado con exito.", "success");
            tblestudiante.ajax.reload(); //recargar pagina de usuario
          } else {
            Swal.fire("Mensaje!", "res", "error");
          }
        }
      };
    }
  });
}
//Fin de Estudinates

function frmIngreso() {
  document.getElementById("title").innerHTML = "Nuevo Ingreso";
  document.getElementById("btnAccion").innerHTML = "registrar";
  document.getElementById("frmIngreso").reset();

  $("#nuevo_ingreso").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id_ingreso").value = "";
}
function RegistrarIngreso(e) {
  e.preventDefault();
  const ingreso = document.getElementById("ingreso");
  const descripcion = document.getElementById("descripcion");

  if (ingreso.value == "" || descripcion.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Ingresos/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmIngreso");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        $("#nuevo_ingreso").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblIngreso.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
//finde  registro Ingresos
function frmEgresos() {
  document.getElementById("title").innerHTML = "Nuevo Egreso";
  document.getElementById("btnAccion").innerHTML = "registrar";
  document.getElementById("frmEgresos").reset();

  $("#nuevo_egresos").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id_egreso").value = "";
}
function RegistrarEgresos(e) {
  e.preventDefault();
  const gasto = document.getElementById("gasto");
  const descripcion = document.getElementById("descripcion");

  if (gasto.value == "" || descripcion.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Egresos/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmEgresos");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        $("#nuevo_egresos").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblEgresos.ajax.reload(); //para recargar la pagina
      }
    };
  }
}

//fin de Egresos

function frmPermisos() {
  document.getElementById("title").innerHTML = "Nuevo Permiso";
  document.getElementById("btnAccion").innerHTML = "registrar";
  document.getElementById("frmPermisos").reset();

  $("#nuevo_permisos").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id_permiso").value = "";
}
function RegistrarPermiso(e) {
  e.preventDefault();
  const permiso = document.getElementById("permiso");

  if (permiso.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Permisos/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmPermisos");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        $("#nuevo_permisos").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblPermisos.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
function btnEditarPermisos(id) {
  document.getElementById("title").innerHTML = "Actulizar Estudiante";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Estudiante/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      document.getElementById("id").value = res.id;
      document.getElementById("ci").value = res.ci;
      document.getElementById("nombre").value = res.nombre;

      //document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_estudiante").modal("show");
    }
  };
}
function btnEliminarPermisos(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Permisos/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          tblPermisos.ajax.reload(); //recargar tabla
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}
//fin de registro de permisos

function frmAnotes() {
  document.getElementById("title").innerHTML = "Nuevo Anote";
  document.getElementById("btnAccion").innerHTML = "registrar";
  document.getElementById("frmAnotes").reset();

  $("#nuevo_anotes").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id_anote").value = "";
}
function RegistrarAnotes(e) {
  e.preventDefault();
  const titulo = document.getElementById("titulo");
  const descripcion = document.getElementById("descripcion");

  if (titulo.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Anotes/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmAnotes");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        $("#nuevo_anotes").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblAnotes.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
/// fin de anotes

function registrarPermisos(e) {
  e.preventDefault(); //evitamdo que se recargue la pagina
  const url = base_url + "Usuarios/registrarPermisos"; //estamos enviando ala controlador
  const frm = document.getElementById("formulario");
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      if (res != "") {
        alertas(res.msg, res.icono);
      } else {
        alertas("Error no identificado", "error");
      }
    }
  };
}

// ============================================================
// MÓDULO SALIDAS
// ============================================================

function frmSalida() {
  document.getElementById("title_salida").innerHTML =
    '<i class="fa-solid fa-person-walking-arrow-right me-2"></i> Nueva Salida';
  document.getElementById("btnAccionSalida").innerHTML =
    '<i class="fas fa-save"></i> Registrar';
  document.getElementById("frmSalida").reset();
  document.getElementById("id_salida").value = "";

  $("#modal_salida").modal("show");
}

function registrarSalida(e) {
  e.preventDefault();

  const actividad = document.getElementById("actividad").value;
  const lugar = document.getElementById("lugar").value;
  const fecha_salida = document.getElementById("fecha_salida").value;
  const hora_salida = document.getElementById("hora_salida").value;
  const hora_llegada = document.getElementById("hora_llegada").value;

  if (
    actividad == "" ||
    lugar == "" ||
    fecha_salida == "" ||
    hora_salida == ""
  ) {
    alertas("Todos los campos obligatorios deben llenarse ☺", "warning");
  } else {
    const url = base_url + "Salidas/registrar";
    const frm = document.getElementById("frmSalida");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
       console.log(this.responseText);
        const res = JSON.parse(this.responseText);
       // console.log("Respuesta del servidor:", res);
        alertas(res.msg, res.icono);
        // Validar si la respuesta fue exitosa
        if ((res.icono = "success")) {
          // Verificar que existe id_salida antes de generar PDF
          if (res.id_salida) {
            console.log("ID de salida generado:", res.id_salida);
            const ruta =base_url + "Reportes/pdf7/" + res.id_salida;
            // Abrir PDF en nueva pestaña
            // Cerrar modal
            setTimeout(() => {
              window.open(ruta, "_blank");
            }, 3000); // Pequeño delay para mejor UX
            $("#modal_salida").modal("hide");
            tblSalidas.ajax.reload();
            frm.reset();
          } else {
            console.warn("No se recibió id_salida en la respuesta");
          }
        } else {
          console.warn("La operación no fue exitosa:", res.msg);
        }
        // Cerrar modal (solo si fue exitoso)
        if (res.estado === "exito" || res.success) {
          setTimeout(() => {
            $("#nuevo_salida").modal("hide");
          }, 300);
        }
      
      }
    };
  }
}

function btnEditarSalida(id) {
  document.getElementById("title_salida").innerHTML =
    '<i class="fa-solid fa-pen-to-square me-2"></i> Editar Salida';
  document.getElementById("btnAccionSalida").innerHTML =
    '<i class="fas fa-save"></i> Modificar';
  const url = base_url + "Salidas/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id_salida").value = res.id_salida;
      document.getElementById("actividad").value = res.actividad;
      document.getElementById("lugar").value = res.lugar;
      //document.getElementById("id_chofer").value = res.id_chofer;
      $("#id_chofer").val(res.id_chofer).trigger("change");
      document.getElementById("transporte").value = res.transporte;
      document.getElementById("fecha_salida").value = res.fecha_salida;
      document.getElementById("hora_salida").value = res.hora_salida;
      document.getElementById("hora_llegada").value = res.hora_llegada;
      $("#modal_salida").modal("show");
    }
  };
}

function btnEliminarSalida(id) {
  Swal.fire({
    title: "¿Estás seguro de eliminar?",
    text: "La salida pasará al estado inactivo.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Salidas/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblSalidas.ajax.reload();
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function btnReactivarSalida(id) {
  Swal.fire({
    title: "¿Reactivar esta salida?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, reactivar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Salidas/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        }
      };
    }
  });
}
// ============================================================
// FIN MÓDULO SALIDAS
// ============================================================

//Inico de Cargos
function frmCargos() {
  document.getElementById("title").innerHTML = "Nuevo Cargo";
  document.getElementById("btnAccion").innerHTML = "registrar";
  document.getElementById("frmCargos").reset();

  $("#nuevo_cargo").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id").value = "";
}
function registrarCargos(e) {
  e.preventDefault();

  const nombre = document.getElementById("nombre");

  if (nombre.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Cargos/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmCargos");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        $("#nuevo_cargo").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblcargos.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
function btnEditarCargos(id) {
  document.getElementById("title").innerHTML = "Actulizar Cargo";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Cargos/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      document.getElementById("id").value = res.id_cargo;
      document.getElementById("nombre").value = res.nombre;

      //document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_cargo").modal("show");
    }
  };
}

function btnEliminarCargos(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Cargos/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblcargos.ajax.reload(); //recargar tabla
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function btnReingresarCargos(id) {
  Swal.fire({
    title: "Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Cargos/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje!", "Cargo Reingresado con exito.", "success");
            tblcargos.ajax.reload(); //recargar pagina de usuario
          } else {
            Swal.fire("Mensaje!", "res", "error");
          }
        }
      };
    }
  });
}
///fin cargos

function frmUnidades() {
  document.getElementById("title").innerHTML = "Nuevo Unidad";
  document.getElementById("btnAccion").innerHTML = "registrar";
  document.getElementById("frmUnidades").reset();

  $("#nuevo_unidad").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id").value = "";
}
function registrarUnidades(e) {
  e.preventDefault();

  const nombre = document.getElementById("nombre");

  if (nombre.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Unidades/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmUnidades");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        $("#nuevo_unidad").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblunidades.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
function btnEditarUnidades(id) {
  document.getElementById("title").innerHTML = "Actulizar Unidad";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Unidades/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      document.getElementById("id").value = res.id_unidad;
      document.getElementById("nombre").value = res.nombre;

      //document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_unidad").modal("show");
    }
  };
}

function btnEliminarUnidades(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Unidades/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblunidades.ajax.reload(); //recargar tabla
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function btnReingresarUnidades(id) {
  Swal.fire({
    title: "Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Unidades/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje!", "Unidad Reingresada con exito.", "success");
            tblunidades.ajax.reload(); //recargar pagina de usuario
          } else {
            Swal.fire("Mensaje!", "res", "error");
          }
        }
      };
    }
  });
}

//fin de unidades
function frmChoferes() {
  document.getElementById("title").innerHTML = "Nuevo Chofer";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmChoferes").reset();

  $("#nuevo_chofer").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id").value = "";
}
function registrarChoferes(e) {
  e.preventDefault();

  const nlicencia = document.getElementById("nlicencia");
  const nombres = document.getElementById("nombres");
  const categoria = document.getElementById("categoria");

  if (nombres.value == "" || nlicencia.value == "" || categoria.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Choferes/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmChoferes");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        $("#nuevo_chofer").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblchoferes.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
function btnEditarChoferes(id) {
  document.getElementById("title").innerHTML = "Actulizar Chofer";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Choferes/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      document.getElementById("id").value = res.id_chofer;
      document.getElementById("nombres").value = res.nombres;
      document.getElementById("nlicencia").value = res.nlicencia;
      document.getElementById("categoria").value = res.categoria;

      //document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_chofer").modal("show");
    }
  };
}

function btnEliminarChoferes(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Choferes/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblchoferes.ajax.reload(); //recargar tabla
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function btnReingresarChoferes(id) {
  Swal.fire({
    title: "Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Choferes/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje!", "Chofer Reingresado con exito.", "success");
            tblchoferes.ajax.reload(); //recargar pagina de usuario
          } else {
            Swal.fire("Mensaje!", "res", "error");
          }
        }
      };
    }
  });
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
