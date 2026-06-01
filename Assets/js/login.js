

function togglePassword(id, element) {
    const input = document.getElementById(id);
    const icon = element.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function frmLogin(e) {
    e.preventDefault();

    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");

    if (usuario.value == "") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    } else if (clave.value == "") {
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();

    } else {
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
                const res = JSON.parse(this.responseText);

                //si lavista es ok que nos muestre la tabla de usuario
                if (res == "ok") {
                    window.location = base_url+"Administracion/home";
                }else{
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML=res;

                }
            }
        }
    }
}