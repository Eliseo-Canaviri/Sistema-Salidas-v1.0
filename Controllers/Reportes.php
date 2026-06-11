<?php
class Reportes extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }

    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'cargos');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "index");
        } else {
            header('Location:' . base_url . 'Errors/permisos');
        }


    }
    public function listar()
    {
        //vamos mandar por json a funciones.js
        //print_r($this->model->getUsuarios());
        //  die();

        $data = $this->model->getCargos();

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
                $data[$i]['acciones'] = '<div>
        <button class ="btn btn-primary" type="button"onclick="btnEditarCargos(' . $data[$i]['id_cargo'] . ');"><i class="fas fa-edit"></i></button>
        <button class ="btn btn-danger" type="button"onclick="btnEliminarCargos(' . $data[$i]['id_cargo'] . ');" ><i class="fas fa-trash-alt"></i></button>
      
        <div/>';

            } else {
                $data[$i]['estado'] = '<spam class="badge badge-danger">Inactivo</spam';
                $data[$i]['acciones'] = '<div>
       
        <button class ="btn btn-success" type="button"onclick="btnReingresarCargos(' . $data[$i]['id_cargo'] . ');" ><i class="fas fa-undo"></i></button>
        <div/>';
            }



        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {


        $nombre = $_POST['nombre'];
        $id = $_POST['id'];


        if (empty($nombre)) {
            $msg = array('msg' => 'Todo los campos son obligatorios ☻', 'icono' => 'warning');

        } else {
            if ($id == "") {
                $data = $this->model->registrarCargo($nombre);

                if ($data == "ok") {
                    $msg = array('msg' => 'Cargo registrado ☻', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al registrar ☻', 'icono' => 'error');
                }

            } else {
                $data = $this->model->modificarCargo($nombre, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Cargo modificado con exito ☻', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar ☻', 'icono' => 'error');
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function editar(int $id)
    {
        $data = $this->model->editarCargo($id);

        // print_r($data);
        //  die();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {

        $data = $this->model->accionCargo(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Cargo eliminado con exito ☻', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar Cargo ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionCargo(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = array('msg' => 'Error al eliminar Cargo ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarCargo()
    {
        if (isset($_GET['est'])) {
            $valor = $_GET['est'];
            $data = $this->model->buscarCargo($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }




    public function pdf7($id)
    {

        // 1. Obtener los datos del modelo
        $data = $this->model->getSalidasPdf($id);
        $salida = $data[0];
        date_default_timezone_set('America/La_Paz');
        $fecha_actual = date('d/m/Y');

        // 2. Cargar TCPDF (Composer recomendado)
        require_once 'vendor/autoload.php';

        // 3. Crear instancia en Tamaño CARTA (LETTER)
        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Metadata opcional
        $pdf->SetCreator('Sistema Administrativo');
        $pdf->SetAuthor('GAM Pocoata');
        $pdf->SetTitle('Hoja de Salida - ' . $fecha_actual);

        // Limpiar cabeceras y pies por defecto
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Márgenes generosos para llenar la página completa de forma elegante
        // Izquierdo: 20, Superior: 20, Derecho: 20
        $pdf->SetMargins(20, 20, 20);
        $pdf->SetAutoPageBreak(TRUE, 20);

        // Añadir página única
        $pdf->AddPage();

        // Paleta de Colores Institucionales
        $primaryColor = [11, 44, 82];    // Azul de Gobierno Profundo
        $textColor = [40, 40, 40];       // Gris Oscuro para legibilidad premium
        $lineColor = [180, 180, 180];    // Gris de división suave
        $bgColor = [245, 247, 250];      // Fondo tenue para celdas de control

        // Ancho útil disponible (Carta = 215.9mm - 40mm de márgenes = 175.9mm, aproximado a 176mm)
        $txtWidth = 176;

        // --- ENCABEZADO PRINCIPAL (LLENADO COMPLETO) ---
        // Logo institucional (X=20mm, Y=18mm, Ancho=26mm)
        if (file_exists('Assets/img/logo.jpg')) {
            $pdf->Image('Assets/img/logo.jpg', 20, 12, 26, 31);
        }

        $pdf->SetX(50);
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->Cell(0, 6, 'GOBIERNO AUTÓNOMO MUNICIPAL DE POCOATA', 0, 1, 'L');

        $pdf->SetX(50);
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(0, 5, 'SISTEMA DE CONTROL DE PERSONAL — GESTIÓN 2026', 0, 1, 'L');

        $pdf->Ln(6);
        $pdf->SetFont('helvetica', 'B', 13);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        // Título centralizado con doble línea inferior estilizada
        $pdf->Cell($txtWidth, 8, 'HOJA DE SALIDA DE PERSONAL', 'B', 1, 'C');
        $pdf->Ln(6);

        // --- SECCIÓN 1: DATOS GENERALES DEL PERSONAL ---
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetDrawColor($lineColor[0], $lineColor[1], $lineColor[2]);
        $pdf->SetLineWidth(0.3);

        // Servidor Público
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'SERVIDOR PÚBLICO:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10.5);
        $pdf->Cell($txtWidth - 42, 8, $salida['nombre_usuario'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Cargo del Funcionario
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'CARGO :', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10.5);
        $pdf->Cell($txtWidth - 42, 8, $salida['nombre_cargo'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Motivo / Actividad principal (Utiliza MultiCell para soportar múltiples párrafos o textos largos)
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'LUGAR DE DESTINO:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10.5);
        $pdf->MultiCell($txtWidth - 42, 8, $salida['lugar'], 'B', 'L', false, 1);
        $pdf->Ln(6);


        // --- SECCIÓN 2: CONTROL DE TIEMPOS Y HORARIOS (TABLA MAXIMIZADA) ---
        $w = [36, 45, 45, 50]; // Distribución exacta para sumar 176mm

        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);

        // Ancho útil de la página
        $anchoUtil = $pdf->getPageWidth()
            - $pdf->getMargins()['left']
            - $pdf->getMargins()['right'];

        $w = [
            $anchoUtil * 0.35, // Movimiento
            $anchoUtil * 0.35, // Fecha
            $anchoUtil * 0.30  // Hora
        ];

        // Encabezado
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetTextColor(50, 50, 50);

        $pdf->Cell($w[0], 8, 'MOVIMIENTO', 0, 0, 'L');
        $pdf->Cell($w[1], 8, 'FECHA', 0, 0, 'C');
        $pdf->Cell($w[2], 8, 'HORA', 0, 1, 'R');

        // Línea horizontal elegante
        $pdf->SetDrawColor(180, 180, 180);
        $pdf->Line(
            $pdf->GetMargins()['left'],
            $pdf->GetY(),
            $pdf->getPageWidth() - $pdf->GetMargins()['right'],
            $pdf->GetY()
        );

        $pdf->Ln(2);

        // Datos
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetTextColor(80, 80, 80);

        // SALIDA
        $pdf->Cell($w[0], 8, 'SALIDA', 0, 0, 'L');
        $pdf->Cell($w[1], 8, $salida['fecha_salida'], 0, 0, 'C');
        $pdf->Cell($w[2], 8, $salida['hora_salida'], 0, 1, 'R');

        // Línea separadora suave
        $pdf->SetDrawColor(230, 230, 230);
        $pdf->Line(
            $pdf->GetMargins()['left'],
            $pdf->GetY(),
            $pdf->getPageWidth() - $pdf->GetMargins()['right'],
            $pdf->GetY()
        );

        $pdf->Ln(2);

        // RETORNO
        $pdf->Cell($w[0], 8, 'RETORNO', 0, 0, 'L');
        $pdf->Cell($w[1], 8, $salida['fecha_llegada'] ?? $salida['fecha_salida'], 0, 0, 'C');
        $pdf->Cell($w[2], 8, $salida['hora_llegada'], 0, 1, 'R');

        // Línea final
        $pdf->SetDrawColor(180, 180, 180);
        $pdf->Line(
            $pdf->GetMargins()['left'],
            $pdf->GetY(),
            $pdf->getPageWidth() - $pdf->GetMargins()['right'],
            $pdf->GetY()
        );

        $pdf->Ln(5);
        $pdf->Ln(6);


        // --- SECCIÓN 3: VEHÍCULO INSTITUCIONAL (RECUADRO EXPANDIDO) ---
        $boxY = $pdf->GetY();
        $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
        $pdf->SetDrawColor(210, 215, 223);
        $pdf->Rect(20, $boxY, $txtWidth, 18, 'DF'); // Altura ajustada a 18mm para presencia visual

        $pdf->SetY($boxY + 2);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->SetX(24);
        $pdf->Cell(0, 4, 'CUANDO UTILICE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');

        $pdf->SetFont('helvetica', '', 9.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetX(24);
        $pdf->Cell(32, 6, 'Vehículo / Móvil:', 0, 0, 'L');
        $pdf->Cell(58, 6, $salida['transporte'] ? $salida['transporte'] : 'N/A', 'B', 0, 'L');

        $pdf->SetX(118);
        $pdf->Cell(32, 6, 'Chofer Autorizado:', 0, 0, 'L');
        $pdf->Cell(46, 6, $salida['nombre_chofer'] ?? 'N/A', 'B', 1, 'L');

        $pdf->SetY($boxY + 18);
        $pdf->Ln(6);


        // --- SECCIÓN 4: INFORME RESUMIDO DE LA ACTIVIDAD ---
        $pdf->Ln(3);

        // Título
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetTextColor(41, 128, 185);
        $pdf->Cell(0, 8, 'INFORME RESUMIDO DE LA ACTIVIDAD REALIZADA', 0, 1, 'L');

        $pdf->Ln(2);

        // Texto
        $textoActividad = $salida['actividad'] ?? 'Sin información registrada';

        // Posición inicial
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $altoCuadro = 40;

        // Fondo suave
        $pdf->SetFillColor(248, 249, 250);

        // Borde moderno
        $pdf->SetDrawColor(220, 220, 220);
        $pdf->SetLineWidth(0.4);

        // Rectángulo principal
        $pdf->RoundedRect($x, $y, $txtWidth, $altoCuadro, 2.5, '1111', 'DF');

        // Barra lateral decorativa
        $pdf->SetFillColor(41, 128, 185);
        $pdf->Rect($x, $y, 3, $altoCuadro, 'F');

        // Texto interno
        $pdf->SetXY($x + 6, $y + 4);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetTextColor(60, 60, 60);
        $pdf->setCellHeightRatio(1.25);

        $pdf->MultiCell(
            $txtWidth - 10,
            5,
            $textoActividad,
            0,
            'L',
            false,
            1
        );

        // Posicionar debajo del cuadro
        $pdf->SetY($y + $altoCuadro + 30);
        
        // --- SECCIÓN 5: RECUADRO DE VALIDACIÓN (DESTINO) Y FIRMAS ---
        $yFirmas = $pdf->GetY();

        // 5.1 Sello del Lugar de Destino (Bloque Izquierdo Grande)
        $style_dashed = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => '3,3', 'color' => array(140, 140, 140));
        $pdf->Rect(20, $yFirmas, 60, 26, 'D', array('all' => $style_dashed));

        $pdf->SetXY(20, $yFirmas + 15);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->Cell(60, 4, 'SELLO Y FIRMA DE DESTINO', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 7);
        $pdf->Cell(60, 3, '(Lugar donde realizó la actividad)', 0, 0, 'C');

        // 5.2 Firma del Servidor Público (Centro-Derecha)
        $pdf->SetXY(92, $yFirmas + 20);
        $pdf->SetDrawColor(120, 120, 120);
        $pdf->Cell(48, 0, '', 'T', 1, 'C');
        $pdf->SetX(92);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->Cell(48, 4, 'FIRMA DEL SERVIDOR', 0, 0, 'C');

        // 5.3 Firma de Autorización RR.HH. (Derecha Extrema)
        $pdf->SetXY(148, $yFirmas + 20);
        $pdf->Cell(48, 0, '', 'T', 1, 'C');
        $pdf->SetX(148);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->Cell(48, 4, 'AUTORIZADO POR: RR.HH.', 0, 0, 'C');

        // 4. Salida del archivo PDF directo en el navegador de forma limpia
        $pdf->Output('Hoja_de_Salida_Completa_GAMP.pdf', 'I');
        
    }



    public function pdf6()
    {
        // 1. Obtener los datos del modelo
        $data = $this->model->getSalidasPdf(1);
        $salida = $data[0];
        $fecha_actual = date('d/m/Y');

        // 2. Cargar TCPDF (Composer recomendado)
        require_once 'vendor/autoload.php';

        // 3. Crear instancia en Tamaño CARTA (LETTER)
        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Metadata opcional
        $pdf->SetCreator('Sistema Administrativo');
        $pdf->SetAuthor('GAM Pocoata');
        $pdf->SetTitle('Hoja de Salida - ' . $fecha_actual);

        // Limpiar cabeceras y pies por defecto
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Márgenes generosos para llenar la página completa de forma elegante
        // Izquierdo: 20, Superior: 20, Derecho: 20
        $pdf->SetMargins(20, 20, 20);
        $pdf->SetAutoPageBreak(TRUE, 20);

        // Añadir página única
        $pdf->AddPage();

        // Paleta de Colores Institucionales
        $primaryColor = [11, 44, 82];    // Azul de Gobierno Profundo
        $textColor = [40, 40, 40];       // Gris Oscuro para legibilidad premium
        $lineColor = [180, 180, 180];    // Gris de división suave
        $bgColor = [245, 247, 250];      // Fondo tenue para celdas de control

        // Ancho útil disponible (Carta = 215.9mm - 40mm de márgenes = 175.9mm, aproximado a 176mm)
        $txtWidth = 176;

        // --- ENCABEZADO PRINCIPAL (LLENADO COMPLETO) ---
        // Logo institucional (X=20mm, Y=18mm, Ancho=26mm)
        if (file_exists('Assets/img/logo.jpg')) {
            $pdf->Image('Assets/img/logo.jpg', 20, 12, 26, 31);
        }

        $pdf->SetX(50);
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->Cell(0, 6, 'GOBIERNO AUTÓNOMO MUNICIPAL DE POCOATA', 0, 1, 'L');

        $pdf->SetX(50);
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(0, 5, 'SISTEMA DE CONTROL DE PERSONAL — GESTIÓN 2026', 0, 1, 'L');

        $pdf->Ln(6);
        $pdf->SetFont('helvetica', 'B', 13);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        // Título centralizado con doble línea inferior estilizada
        $pdf->Cell($txtWidth, 8, 'HOJA DE SALIDA DE PERSONAL', 'B', 1, 'C');
        $pdf->Ln(6);

        // --- SECCIÓN 1: DATOS GENERALES DEL PERSONAL ---
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetDrawColor($lineColor[0], $lineColor[1], $lineColor[2]);
        $pdf->SetLineWidth(0.3);

        // Servidor Público
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'SERVIDOR PÚBLICO:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10.5);
        $pdf->Cell($txtWidth - 42, 8, $salida['id_usuario'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Cargo del Funcionario
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'CARGO :', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10.5);
        $pdf->Cell($txtWidth - 42, 8, $salida['id_cargo'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Motivo / Actividad principal (Utiliza MultiCell para soportar múltiples párrafos o textos largos)
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'MOTIVO / ACTIVIDAD:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10.5);
        $pdf->MultiCell($txtWidth - 42, 8, $salida['actividad'], 'B', 'L', false, 1);
        $pdf->Ln(6);


        // --- SECCIÓN 2: CONTROL DE TIEMPOS Y HORARIOS (TABLA MAXIMIZADA) ---
        $w = [36, 45, 45, 50]; // Distribución exacta para sumar 176mm

        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);

        // Ancho útil de la página
        $anchoPagina = $pdf->getPageWidth();
        $margenIzq = $pdf->getMargins()['left'];
        $margenDer = $pdf->getMargins()['right'];

        $anchoUtil = $anchoPagina - $margenIzq - $margenDer;

        // Distribución de columnas
        $w = [
            $anchoUtil * 0.25, // MOVIMIENTO
            $anchoUtil * 0.40, // FECHA
            $anchoUtil * 0.35  // HORA
        ];


        // Encabezados de Tabla
        $pdf->Cell($w[0], 8, 'MOVIMIENTO', 1, 0, 'C', true);
        $pdf->Cell($w[1], 8, 'FECHA (DD/MM/AAAA)', 1, 0, 'C', true);
        $pdf->Cell($w[2], 8, 'HORA REGISTRADA', 1, 1, 'C', true);

        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetFont('helvetica', '', 10);

        // Fila: Salida
        $pdf->Cell($w[0], 9, 'SALIDA', 1, 0, 'C', true);
        $pdf->Cell($w[1], 9, $salida['fecha_salida'], 1, 0, 'C');
        $pdf->Cell($w[2], 9, $salida['hora_salida'] . ' Hrs.', 1, 1, 'C');


        // Fila: Retorno
        $pdf->Cell($w[0], 9, 'RETORNO', 1, 0, 'C', true);
        $pdf->Cell($w[1], 9, isset($salida['fecha_llegada']) ? $salida['fecha_llegada'] : $salida['fecha_salida'], 1, 0, 'C');
        $pdf->Cell($w[2], 9, $salida['hora_llegada'] . ' Hrs.', 1, 1, 'C');

        $pdf->Ln(6);


        // --- SECCIÓN 3: VEHÍCULO INSTITUCIONAL (RECUADRO EXPANDIDO) ---
        $boxY = $pdf->GetY();
        $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
        $pdf->SetDrawColor(210, 215, 223);
        $pdf->Rect(20, $boxY, $txtWidth, 18, 'DF'); // Altura ajustada a 18mm para presencia visual

        $pdf->SetY($boxY + 2);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->SetX(24);
        $pdf->Cell(0, 4, 'CUANDO UTILICE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');

        $pdf->SetFont('helvetica', '', 9.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetX(24);
        $pdf->Cell(32, 6, 'Vehículo / Móvil:', 0, 0, 'L');
        $pdf->Cell(58, 6, $salida['transporte'] ? $salida['transporte'] : 'N/A', 'B', 0, 'L');

        $pdf->SetX(118);
        $pdf->Cell(32, 6, 'Chofer Autorizado:', 0, 0, 'L');
        $pdf->Cell(46, 6, '', 'B', 1, 'L');

        $pdf->SetY($boxY + 18);
        $pdf->Ln(6);


        // --- SECCIÓN 4: INFORME RESUMIDO DE LA ACTIVIDAD (OCUPA EL CENTRO DE LA HOJA) ---
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->Cell($txtWidth, 6, 'INFORME RESUMIDO DE LA ACTIVIDAD REALIZADA', 0, 1, 'L');
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->Ln(2);

        // Renglones limpios con altura extendida para escritura cómoda a mano o reporte físico
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Ln(12); // Separación óptima previa al bloque inferior de firmas


        // --- SECCIÓN 5: RECUADRO DE VALIDACIÓN (DESTINO) Y FIRMAS ---
        $yFirmas = $pdf->GetY();

        // 5.1 Sello del Lugar de Destino (Bloque Izquierdo Grande)
        $style_dashed = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => '3,3', 'color' => array(140, 140, 140));
        $pdf->Rect(20, $yFirmas, 60, 26, 'D', array('all' => $style_dashed));

        $pdf->SetXY(20, $yFirmas + 15);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->Cell(60, 4, 'SELLO Y FIRMA DE DESTINO', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 7);
        $pdf->Cell(60, 3, '(Lugar donde realizó la actividad)', 0, 0, 'C');

        // 5.2 Firma del Servidor Público (Centro-Derecha)
        $pdf->SetXY(92, $yFirmas + 20);
        $pdf->SetDrawColor(120, 120, 120);
        $pdf->Cell(48, 0, '', 'T', 1, 'C');
        $pdf->SetX(92);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->Cell(48, 4, 'FIRMA DEL SERVIDOR', 0, 0, 'C');

        // 5.3 Firma de Autorización RR.HH. (Derecha Extrema)
        $pdf->SetXY(148, $yFirmas + 20);
        $pdf->Cell(48, 0, '', 'T', 1, 'C');
        $pdf->SetX(148);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->Cell(48, 4, 'AUTORIZADO POR: RR.HH.', 0, 0, 'C');

        // 4. Salida del archivo PDF directo en el navegador de forma limpia
        $pdf->Output('Hoja_de_Salida_Completa_GAMP.pdf', 'I');
    }




    public function pdf5()
    {
        // 1. Obtener los datos del modelo
        $data = $this->model->getSalidasPdf(1);
        $salida = $data[0];
        $fecha_actual = date('d/m/Y');

        // 2. Cargar TCPDF (Composer recomendado)
        require_once 'vendor/autoload.php';

        // 3. Crear instancia en Tamaño CARTA (LETTER)
        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Metadata opcional
        $pdf->SetCreator('Sistema Administrativo');
        $pdf->SetAuthor('GAM Pocoata');
        $pdf->SetTitle('Hoja de Salida - ' . $fecha_actual);

        // Limpiar cabeceras y pies por defecto
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Márgenes generosos para llenar la página completa de forma elegante
        // Izquierdo: 20, Superior: 20, Derecho: 20
        $pdf->SetMargins(20, 20, 20);
        $pdf->SetAutoPageBreak(TRUE, 20);

        // Añadir página única
        $pdf->AddPage();

        // Paleta de Colores Institucionales
        $primaryColor = [11, 44, 82];    // Azul de Gobierno Profundo
        $textColor = [40, 40, 40];       // Gris Oscuro para legibilidad premium
        $lineColor = [180, 180, 180];    // Gris de división suave
        $bgColor = [245, 247, 250];      // Fondo tenue para celdas de control

        // Ancho útil disponible (Carta = 215.9mm - 40mm de márgenes = 175.9mm, aproximado a 176mm)
        $txtWidth = 176;

        // --- ENCABEZADO PRINCIPAL (LLENADO COMPLETO) ---
        // Logo institucional (X=20mm, Y=18mm, Ancho=26mm)
        if (file_exists('Assets/img/logo.jpg')) {
            $pdf->Image('Assets/img/logo.jpg', 20, 12, 26, 31);
        }

        $pdf->SetX(50);
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->Cell(0, 6, 'GOBIERNO AUTÓNOMO MUNICIPAL DE POCOATA', 0, 1, 'L');

        $pdf->SetX(50);
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(0, 5, 'SISTEMA DE CONTROL DE PERSONAL — GESTIÓN 2026', 0, 1, 'L');

        $pdf->Ln(6);
        $pdf->SetFont('helvetica', 'B', 13);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        // Título centralizado con doble línea inferior estilizada
        $pdf->Cell($txtWidth, 8, 'HOJA DE SALIDA DE PERSONAL', 'B', 1, 'C');
        $pdf->Ln(6);

        // --- SECCIÓN 1: DATOS GENERALES DEL PERSONAL ---
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetDrawColor($lineColor[0], $lineColor[1], $lineColor[2]);
        $pdf->SetLineWidth(0.3);

        // Servidor Público
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'SERVIDOR PÚBLICO:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10.5);
        $pdf->Cell($txtWidth - 42, 8, $salida['id_usuario'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Cargo del Funcionario
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'CARGO INSTITUCIONAL:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10.5);
        $pdf->Cell($txtWidth - 42, 8, $salida['id_cargo'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Motivo / Actividad principal (Utiliza MultiCell para soportar múltiples párrafos o textos largos)
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(42, 8, 'MOTIVO / ACTIVIDAD:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->MultiCell($txtWidth - 42, 8, $salida['actividad'], 'B', 'L', false, 1);
        $pdf->Ln(6);


        // --- SECCIÓN 2: CONTROL DE TIEMPOS Y HORARIOS (TABLA MAXIMIZADA) ---
        $w = [36, 45, 45, 50]; // Distribución exacta para sumar 176mm

        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);

        // Encabezados de Tabla
        $pdf->Cell($w[0], 8, 'MOVIMIENTO', 1, 0, 'C', true);
        $pdf->Cell($w[1], 8, 'FECHA (DD/MM/AAAA)', 1, 0, 'C', true);
        $pdf->Cell($w[2], 8, 'HORA REGISTRADA', 1, 0, 'C', true);
        $pdf->Cell($w[3], 8, 'FIRMA CONTROL DE RETORNO', 1, 1, 'C', true);

        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetFont('helvetica', '', 10);

        // Fila: Salida
        $pdf->Cell($w[0], 9, 'SALIDA', 1, 0, 'C', true);
        $pdf->Cell($w[1], 9, $salida['fecha_salida'], 1, 0, 'C');
        $pdf->Cell($w[2], 9, $salida['hora_salida'] . ' Hrs.', 1, 0, 'C');
        $pdf->Cell($w[3], 9, '', 1, 1, 'C');

        // Fila: Retorno
        $pdf->Cell($w[0], 9, 'RETORNO', 1, 0, 'C', true);
        $pdf->Cell($w[1], 9, isset($salida['fecha_llegada']) ? $salida['fecha_llegada'] : $salida['fecha_salida'], 1, 0, 'C');
        $pdf->Cell($w[2], 9, $salida['hora_llegada'] . ' Hrs.', 1, 0, 'C');
        $pdf->Cell($w[3], 9, '', 1, 1, 'C');
        $pdf->Ln(6);


        // --- SECCIÓN 3: VEHÍCULO INSTITUCIONAL (RECUADRO EXPANDIDO) ---
        $boxY = $pdf->GetY();
        $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
        $pdf->SetDrawColor(210, 215, 223);
        $pdf->Rect(20, $boxY, $txtWidth, 18, 'DF'); // Altura ajustada a 18mm para presencia visual

        $pdf->SetY($boxY + 2);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->SetX(24);
        $pdf->Cell(0, 4, 'CUANDO UTILICE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');

        $pdf->SetFont('helvetica', '', 9.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetX(24);
        $pdf->Cell(32, 6, 'Vehículo / Móvil:', 0, 0, 'L');
        $pdf->Cell(58, 6, $salida['transporte'] ? $salida['transporte'] : 'N/A', 'B', 0, 'L');

        $pdf->SetX(118);
        $pdf->Cell(32, 6, 'Chofer Autorizado:', 0, 0, 'L');
        $pdf->Cell(46, 6, '', 'B', 1, 'L');

        $pdf->SetY($boxY + 18);
        $pdf->Ln(6);


        // --- SECCIÓN 4: INFORME RESUMIDO DE LA ACTIVIDAD (OCUPA EL CENTRO DE LA HOJA) ---
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->Cell($txtWidth, 6, 'INFORME RESUMIDO DE LA ACTIVIDAD REALIZADA', 0, 1, 'L');
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->Ln(2);

        // Renglones limpios con altura extendida para escritura cómoda a mano o reporte físico
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Cell($txtWidth, 7, '', 'B', 1, 'L');
        $pdf->Ln(12); // Separación óptima previa al bloque inferior de firmas


        // --- SECCIÓN 5: RECUADRO DE VALIDACIÓN (DESTINO) Y FIRMAS ---
        $yFirmas = $pdf->GetY();

        // 5.1 Sello del Lugar de Destino (Bloque Izquierdo Grande)
        $style_dashed = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => '3,3', 'color' => array(140, 140, 140));
        $pdf->Rect(20, $yFirmas, 60, 26, 'D', array('all' => $style_dashed));

        $pdf->SetXY(20, $yFirmas + 15);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->Cell(60, 4, 'SELLO Y FIRMA DE DESTINO', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 7);
        $pdf->Cell(60, 3, '(Lugar donde realizó la actividad)', 0, 0, 'C');

        // 5.2 Firma del Servidor Público (Centro-Derecha)
        $pdf->SetXY(92, $yFirmas + 20);
        $pdf->SetDrawColor(120, 120, 120);
        $pdf->Cell(48, 0, '', 'T', 1, 'C');
        $pdf->SetX(92);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->Cell(48, 4, 'FIRMA DEL SERVIDOR', 0, 0, 'C');

        // 5.3 Firma de Autorización RR.HH. (Derecha Extrema)
        $pdf->SetXY(148, $yFirmas + 20);
        $pdf->Cell(48, 0, '', 'T', 1, 'C');
        $pdf->SetX(148);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->Cell(48, 4, 'AUTORIZADO POR: RR.HH.', 0, 0, 'C');

        // 4. Salida del archivo PDF directo en el navegador de forma limpia
        $pdf->Output('Hoja_de_Salida_Completa_GAMP.pdf', 'I');
    }

    public function pdf4()
    {

        // 1. Obtener los datos del modelo
        $data = $this->model->getSalidasPdf(1);
        $salida = $data[0];
        date_default_timezone_set('America/La_Paz');
        $fecha_actual = date('d/m/Y');

        // 2. Cargar TCPDF
        require_once 'vendor/autoload.php';

        // 3. Crear instancia en Tamaño CARTA (LETTER)
        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Metadata Institucional
        $pdf->SetCreator('Sistema Administrativo');
        $pdf->SetAuthor('GAM Pocoata');
        $pdf->SetTitle('Hoja de Salida - ' . $fecha_actual);

        // Desactivar cabeceras y pies por defecto
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Márgenes amplios y profesionales para un solo documento por página
        $pdf->SetMargins(18, 18, 18);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        // Paleta de Colores Corporativos (RGB)
        $primaryColor = [11, 44, 82];    // Azul Institucional Profundo
        $textColor = [44, 62, 80];       // Gris Carbón Ejecutivo
        $lineColor = [189, 195, 199];    // Gris Suave para líneas
        $bgColor = [248, 249, 250];      // Fondo tenue para cabeceras de tablas

        // --- ENCABEZADO CON LOGO ---
        if (file_exists('Assets/img/logo.jpg')) {
            $pdf->Image('Assets/img/logo.jpg', 18, 16, 24, 24);
        }

        // Bloque de Título Principal
        $pdf->SetX(46);
        $pdf->SetFont('helvetica', 'B', 13);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->Cell(0, 6, 'GOBIERNO AUTÓNOMO MUNICIPAL DE POCOATA', 0, 1, 'L');

        $pdf->SetX(46);
        $pdf->SetFont('helvetica', 'B', 10.5);
        $pdf->SetTextColor(85, 85, 85);
        $pdf->Cell(0, 5, 'HOJA DE SALIDA DEL PERSONAL DEL G.A.M.P — GESTIÓN 2026', 0, 1, 'L');

        // Línea divisoria elegante de la cabecera
        $pdf->Ln(4);
        $pdf->SetDrawColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->SetLineWidth(0.5);
        $pdf->Line(18, $pdf->GetY(), 198, $pdf->GetY());
        $pdf->Ln(6);

        // --- SECCIÓN 1: DATOS DEL PERSONAL ---
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetDrawColor($lineColor[0], $lineColor[1], $lineColor[2]);
        $pdf->SetLineWidth(0.25);

        // Fila 1: Servidor Público
        $pdf->SetFont('helvetica', 'B', 9.5);
        $pdf->Cell(40, 7, 'SERVIDOR PÚBLICO:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(140, 7, $salida['id_usuario'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Fila 2: Cargo
        $pdf->SetFont('helvetica', 'B', 9.5);
        $pdf->Cell(40, 7, 'CARGO:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(140, 7, $salida['id_cargo'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Fila 3: Motivo / Actividad (Con MultiCell para soportar textos largos con salto de línea)
        $pdf->SetFont('helvetica', 'B', 9.5);
        $pdf->Cell(40, 7, 'MOTIVO / ACTIVIDAD:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 9.5);
        $pdf->MultiCell(140, 7, $salida['actividad'], 'B', 'L', false, 1);
        $pdf->Ln(6);

        // --- SECCIÓN 2: TIEMPOS Y MOVIMIENTOS ---
        $w = [35, 48, 47, 50]; // Distribución horizontal equilibrada (Total 180mm útil)
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);

        // Encabezados de la Tabla
        $pdf->Cell($w[0], 7, 'MOVIMIENTO', 1, 0, 'C', true);
        $pdf->Cell($w[1], 7, 'FECHA (DD/MM/AAAA)', 1, 0, 'C', true);
        $pdf->Cell($w[2], 7, 'HORA REGISTRADA', 1, 0, 'C', true);
        $pdf->Cell($w[3], 7, 'FIRMA CONTROL RETORNO', 1, 1, 'C', true);

        $pdf->SetFont('helvetica', '', 9.5);
        // Registro de Salida
        $pdf->Cell($w[0], 7.5, 'SALIDA', 1, 0, 'C', true);
        $pdf->Cell($w[1], 7.5, $salida['fecha_salida'], 1, 0, 'C');
        $pdf->Cell($w[2], 7.5, $salida['hora_salida'] . ' Hrs.', 1, 0, 'C');
        $pdf->Cell($w[3], 7.5, '', 1, 1, 'C');

        // Registro de Retorno
        $pdf->Cell($w[0], 7.5, 'RETORNO', 1, 0, 'C', true);
        $pdf->Cell($w[1], 7.5, isset($salida['fecha_llegada']) ? $salida['fecha_llegada'] : $salida['fecha_salida'], 1, 0, 'C');
        $pdf->Cell($w[2], 7.5, $salida['hora_llegada'] . ' Hrs.', 1, 0, 'C');
        $pdf->Cell($w[3], 7.5, '', 1, 1, 'C');
        $pdf->Ln(6);

        // --- SECCIÓN 3: VEHÍCULO INSTITUCIONAL ---
        $boxY = $pdf->GetY();
        $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
        $pdf->SetDrawColor(220, 221, 225);
        $pdf->Rect(18, $boxY, 180, 15, 'DF');

        $pdf->SetY($boxY + 1.5);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->SetX(22);
        $pdf->Cell(0, 4, 'USO DE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');

        $pdf->SetFont('helvetica', '', 9.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetX(22);
        $pdf->Cell(30, 5, 'Vehículo / Móvil:', 0, 0, 'L');
        $pdf->Cell(60, 5, $salida['transporte'] ? $salida['transporte'] : 'N/A', 'B', 0, 'L');

        $pdf->SetX(120);
        $pdf->Cell(32, 5, 'Chofer Autorizado:', 0, 0, 'L');
        $pdf->Cell(46, 5, '', 'B', 1, 'L');

        $pdf->SetY($boxY + 15);
        $pdf->Ln(12); // Espacio simétrico antes del bloque de firmas físicas

        // --- SECCIÓN 4: VALIDACIÓN EXTERNA Y FIRMAS (ALINEACIÓN HORIZONTAL) ---
        $yFirmas = $pdf->GetY();

        // 4.1 Sello de Destino (Izquierda)
        $style_dashed = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2,2', 'color' => array(127, 140, 141));
        $pdf->Rect(18, $yFirmas, 62, 24, 'D', array('all' => $style_dashed));

        $pdf->SetXY(18, $yFirmas + 13);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor(127, 140, 141);
        $pdf->Cell(62, 4, 'SELLO Y FIRMA DE DESTINO', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 7);
        $pdf->Cell(62, 3, '(Lugar donde realizó la actividad)', 0, 0, 'C');

        // 4.2 Firma del Servidor (Centro)
        $pdf->SetXY(92, $yFirmas + 18);
        $pdf->SetDrawColor(127, 140, 141);
        $pdf->Cell(48, 0, '', 'T', 1, 'C');
        $pdf->SetX(92);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->Cell(48, 4, 'FIRMA DEL SERVIDOR', 0, 0, 'C');

        // 4.3 Autorizado por RR.HH. (Derecha)
        $pdf->SetXY(150, $yFirmas + 18);
        $pdf->Cell(48, 0, '', 'T', 1, 'C');
        $pdf->SetX(150);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->Cell(48, 4, 'AUTORIZADO POR: RR.HH.', 0, 0, 'C');

        // 4. Salida limpia al navegador
        $pdf->Output('Hoja_de_Salida_GAMP.pdf', 'I');
    }



    public function pdf3()
    {
        // 1. Obtener los datos del modelo
        $data = $this->model->getSalidasPdf(1);
        $salida = $data[0];
        $fecha_actual = date('d/m/Y');

        // 2. Cargar TCPDF (Composer recomendado)
        require_once 'vendor/autoload.php';

        // 3. Crear instancia en Tamaño CARTA (LETTER)
        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Metadata Institucional
        $pdf->SetCreator('Sistema Administrativo');
        $pdf->SetAuthor('GAM Pocoata');
        $pdf->SetTitle('Hoja de Salida - ' . $fecha_actual);

        // Desactivar cabeceras y pies de página por defecto para control absoluto del espacio
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Márgenes perimetrales optimizados para tamaño Carta (215.9mm x 279.4mm)
        $pdf->SetMargins(15, 10, 15);
        $pdf->SetAutoPageBreak(FALSE); // Desactivado para forzar que quepa estrictamente en una página
        $pdf->AddPage();

        // Paleta de Colores Corporativos (RGB)
        $primaryColor = [11, 44, 82];    // Azul Institucional Profundo
        $textColor = [44, 62, 80];       // Gris Carbón Ejecutivo
        $lineColor = [189, 195, 199];    // Gris Suave para líneas
        $bgColor = [248, 249, 250];      // Fondo tenue para cabeceras de tablas

        // =========================================================================
        // FUNCIÓN INTERNA REUTILIZABLE PARA GARANTIZAR IDENTIDAD SIMÉTRICA
        // =========================================================================
        $renderBoleta = function ($tipoBoleta) use ($pdf, $salida, $primaryColor, $textColor, $lineColor, $bgColor) {
            $startY = $pdf->GetY();

            // --- ENCABEZADO CON LOGO ---
            if (file_exists('Assets/img/logo.jpg')) {
                $pdf->Image('Assets/img/logo.jpg', 15, $startY, 22, 22);
            }

            // Bloque de Título Principal
            $pdf->SetX(40);
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
            $pdf->Cell(120, 5, 'GOBIERNO AUTÓNOMO MUNICIPAL DE POCOATA', 0, 0, 'L');

            // Etiqueta Tipo de Copia (Badge)
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->SetTextColor(85, 85, 85);
            $pdf->SetFillColor(240, 244, 248);
            $pdf->Cell(36, 5, strtoupper($tipoBoleta), 1, 1, 'C', true);

            $pdf->SetX(40);
            $pdf->SetFont('helvetica', 'B', 9.5);
            $pdf->SetTextColor(85, 85, 85);
            $pdf->Cell(0, 5, 'HOJA DE SALIDA DEL PERSONAL — GESTIÓN 2026', 0, 1, 'L');

            // Línea divisoria elegante
            $pdf->Ln(2);
            $pdf->SetDrawColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
            $pdf->SetLineWidth(0.4);
            $pdf->Line(15, $pdf->GetY(), 201, $pdf->GetY());
            $pdf->Ln(3);

            // --- SECCIÓN 1: DATOS DEL PERSONAL ---
            $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
            $pdf->SetDrawColor($lineColor[0], $lineColor[1], $lineColor[2]);
            $pdf->SetLineWidth(0.2);

            // Fila 1: Servidor
            $pdf->SetFont('helvetica', 'B', 8.5);
            $pdf->Cell(35, 5.5, 'SERVIDOR PÚBLICO:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(151, 5.5, $salida['id_usuario'], 'B', 1, 'L');
            $pdf->Ln(1);

            // Fila 2: Cargo
            $pdf->SetFont('helvetica', 'B', 8.5);
            $pdf->Cell(35, 5.5, 'CARGO:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(151, 5.5, $salida['id_cargo'], 'B', 1, 'L');
            $pdf->Ln(1);

            // Fila 3: Actividad (MultiCell adaptada para evitar desbordes si el texto es largo)
            $pdf->SetFont('helvetica', 'B', 8.5);
            $pdf->Cell(35, 5.5, 'MOTIVO / ACTIVIDAD:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 8.5);
            $pdf->MultiCell(151, 5.5, $salida['actividad'], 'B', 'L', false, 1);
            $pdf->Ln(3);

            // --- SECCIÓN 2: TIEMPOS (TABLA ESTRUCTURADA) ---
            $w = [35, 51, 50, 50]; // Distribución exacta (Total 186mm)
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);

            // Encabezados
            $pdf->Cell($w[0], 5, 'MOVIMIENTO', 1, 0, 'C', true);
            $pdf->Cell($w[1], 5, 'FECHA (DD/MM/AAAA)', 1, 0, 'C', true);
            $pdf->Cell($w[2], 5, 'HORA REGISTRADA', 1, 0, 'C', true);
            $pdf->Cell($w[3], 5, 'FIRMA CONTROL RETORNO', 1, 1, 'C', true);

            $pdf->SetFont('helvetica', '', 8.5);
            // Registro Salida
            $pdf->Cell($w[0], 5.5, 'SALIDA', 1, 0, 'C', true);
            $pdf->Cell($w[1], 5.5, $salida['fecha_salida'], 1, 0, 'C');
            $pdf->Cell($w[2], 5.5, $salida['hora_salida'] . ' Hrs.', 1, 0, 'C');
            $pdf->Cell($w[3], 5.5, '', 1, 1, 'C');

            // Registro Retorno
            $pdf->Cell($w[0], 5.5, 'RETORNO', 1, 0, 'C', true);
            $pdf->Cell($w[1], 5.5, isset($salida['fecha_llegada']) ? $salida['fecha_llegada'] : $salida['fecha_salida'], 1, 0, 'C');
            $pdf->Cell($w[2], 5.5, $salida['hora_llegada'] . ' Hrs.', 1, 0, 'C');
            $pdf->Cell($w[3], 5.5, '', 1, 1, 'C');
            $pdf->Ln(3);

            // --- SECCIÓN 3: VEHÍCULO INSTITUCIONAL ---
            $boxY = $pdf->GetY();
            $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
            $pdf->SetDrawColor(220, 221, 225);
            $pdf->Rect(15, $boxY, 186, 12, 'DF'); // Altura compactada para optimizar espacio

            $pdf->SetY($boxY + 1);
            $pdf->SetFont('helvetica', 'B', 7.5);
            $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
            $pdf->SetX(18);
            $pdf->Cell(0, 3, 'USO DE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');

            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
            $pdf->SetX(18);
            $pdf->Cell(25, 4.5, 'Vehículo / Móvil:', 0, 0, 'L');
            $pdf->Cell(65, 4.5, $salida['transporte'] ? $salida['transporte'] : 'N/A', 'B', 0, 'L');

            $pdf->SetX(115);
            $pdf->Cell(28, 4.5, 'Chofer Autorizado:', 0, 0, 'L');
            $pdf->Cell(55, 4.5, '', 'B', 1, 'L');

            $pdf->SetY($boxY + 12);
            $pdf->Ln(5); // Espaciado controlado hacia las firmas

            // --- SECCIÓN 4: RECUADRO DE VALIDACIÓN EXTERNA Y FIRMAS ---
            $yFirmas = $pdf->GetY();

            // 4.1 Sello de Destino (Lado Izquierdo)
            $style_dashed = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2,2', 'color' => array(127, 140, 141));
            $pdf->Rect(15, $yFirmas, 65, 20, 'D', array('all' => $style_dashed));

            $pdf->SetXY(15, $yFirmas + 10);
            $pdf->SetFont('helvetica', 'B', 7.5);
            $pdf->SetTextColor(127, 140, 141);
            $pdf->Cell(65, 4, 'SELLO Y FIRMA DE DESTINO', 0, 1, 'C');
            $pdf->SetFont('helvetica', '', 6.5);
            $pdf->Cell(65, 3, '(Lugar donde realizó la actividad)', 0, 0, 'C');

            // 4.2 Línea de Firma Servidor (Centro)
            $pdf->SetXY(90, $yFirmas + 14);
            $pdf->SetDrawColor(127, 140, 141);
            $pdf->Cell(50, 0, '', 'T', 1, 'C');
            $pdf->SetX(90);
            $pdf->SetFont('helvetica', 'B', 7.5);
            $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
            $pdf->Cell(50, 4, 'FIRMA DEL SERVIDOR', 0, 0, 'C');

            // 4.3 Línea de Firma Autorización RRHH (Derecha Extrema)
            $pdf->SetXY(151, $yFirmas + 14);
            $pdf->Cell(50, 0, '', 'T', 1, 'C');
            $pdf->SetX(151);
            $pdf->SetFont('helvetica', 'B', 7.5);
            $pdf->Cell(50, 4, 'AUTORIZADO POR: RR.HH.', 0, 0, 'C');
        };

        // =========================================================================
        // RENDERIZADO SIMÉTRICO DE AMBOS TALONES EN TAMAÑO CARTA
        // =========================================================================

        // 1. Render de la primera boleta (Original) en la mitad superior
        $renderBoleta('Original Destino');

        // 2. Línea de corte central exacta
        $pdf->SetY(134);
        $style_cut = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => '3,3', 'color' => array(149, 165, 166));
        $pdf->Line(10, 136, 206, 136, $style_cut);

        // 3. Posicionar el puntero en la mitad inferior para la segunda boleta (Copia)
        $pdf->SetY(143);

        // 4. Render de la segunda boleta (Copia) en la mitad inferior
        $renderBoleta('Copia Archivo');

        // 5. Envío del archivo al navegador de manera limpia
        $pdf->Output('Hoja_de_Salida_GAMP.pdf', 'I');
    }
    public function pdf2()
    {
        // 1. Obtener los datos del modelo
        $data = $this->model->getSalidasPdf(1);
        $salida = $data[0];
        $fecha_actual = date('d/m/Y');

        // 2. Cargar TCPDF via Composer
        require_once 'vendor/autoload.php';

        // 3. Crear instancia en Tamaño CARTA
        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Metadata
        $pdf->SetCreator('Sistema Administrativo');
        $pdf->SetAuthor('GAM Pocoata');
        $pdf->SetTitle('Hoja de Salida - ' . $fecha_actual);

        // Desactivar cabeceras y pies por defecto (Manejo manual para control total)
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Márgenes perimetrales limpios
        $pdf->SetMargins(15, 12, 15);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();

        // Paleta de Colores Corporativa (RGB)
        $primaryColor = [11, 44, 82];    // Azul Institucional Profundo
        $textColor = [40, 40, 40];       // Gris Oscuro para lectura suave
        $lineColor = [180, 180, 180];    // Gris Claro para separadores
        $bgColor = [248, 249, 250];      // Fondo Gris Tenue para bloques

        // =========================================================================
        // CREAMOS UNA FUNCIÓN INTERNA PARA DIBUJAR LA BOLETA
        // Esto permite generar "ORIGINAL" y "COPIA" exactamente iguales sin repetir código
        // =========================================================================
        $renderBoleta = function ($tipoCopias) use ($pdf, $salida, $primaryColor, $textColor, $lineColor, $bgColor) {

            $startY = $pdf->GetY();

            // --- ENCABEZADO MINIMALISTA ---
            // Logo (X=15, Y=actual, Ancho=22)
            if (file_exists('Assets/img/logo.jpg')) {
                $pdf->Image('Assets/img/logo.jpg', 15, $startY - 2, 22, 22);
            }

            // Títulos en bloque derecho
            $pdf->SetX(40);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
            $pdf->Cell(115, 5, 'GOBIERNO AUTÓNOMO MUNICIPAL DE POCOATA', 0, 0, 'L');

            // Indicador de Copia/Original
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetTextColor(120, 120, 120);
            $pdf->Cell(31, 5, strtoupper($tipoCopias), 1, 1, 'C');

            $pdf->SetX(40);
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetTextColor(80, 80, 80);
            $pdf->Cell(0, 5, 'HOJA DE SALIDA DEL PERSONAL — GESTIÓN 2026', 0, 1, 'L');

            // Línea divisoria elegante
            $pdf->Ln(4);
            $pdf->SetDrawColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
            $pdf->SetLineWidth(0.5);
            $pdf->Line(15, $pdf->GetY(), 201, $pdf->GetY());
            $pdf->Ln(4);

            // --- SECCIÓN 1: DATOS DEL PERSONAL ---
            $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
            $pdf->SetDrawColor($lineColor[0], $lineColor[1], $lineColor[2]);
            $pdf->SetLineWidth(0.2);

            // Fila 1: Nombre
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(35, 6, 'SERVIDOR PÚBLICO:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(151, 6, $salida['id_usuario'], 'B', 1, 'L');
            $pdf->Ln(1.5);

            // Fila 2: Cargo
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(35, 6, 'CARGO:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(151, 6, $salida['id_cargo'], 'B', 1, 'L');
            $pdf->Ln(1.5);

            // Fila 3: Motivo
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(35, 6, 'MOTIVO / ACTIVIDAD:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(151, 6, $salida['actividad'], 'B', 1, 'L');
            $pdf->Ln(4);

            // --- SECCIÓN 2: TIEMPOS (TABLA SIMÉTRICA) ---
            $w = [35, 51, 50, 50]; // Anchos de columnas balanceados para sumar 186mm

            $pdf->SetFont('helvetica', 'B', 8.5);
            $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);

            // Encabezados de tiempos
            $pdf->Cell($w[0], 5, 'MOVIMIENTO', 1, 0, 'C', true);
            $pdf->Cell($w[1], 5, 'FECHA (DD/MM/AAAA)', 1, 0, 'C', true);
            $pdf->Cell($w[2], 5, 'HORA', 1, 0, 'C', true);
            $pdf->Cell($w[3], 5, 'FIRMA/CONTROL retorno', 1, 1, 'C', true);

            $pdf->SetFont('helvetica', '', 9);
            // Registro Salida
            $pdf->Cell($w[0], 6, 'SALIDA', 1, 0, 'C');
            $pdf->Cell($w[1], 6, $salida['fecha_salida'], 1, 0, 'C');
            $pdf->Cell($w[2], 6, $salida['hora_salida'] . ' Hrs.', 1, 0, 'C');
            $pdf->Cell($w[3], 6, '', 1, 1, 'C');

            // Registro Retorno
            $pdf->Cell($w[0], 6, 'RETORNO', 1, 0, 'C');
            $pdf->Cell($w[1], 6, isset($salida['fecha_llegada']) ? $salida['fecha_llegada'] : $salida['fecha_salida'], 1, 0, 'C');
            $pdf->Cell($w[2], 6, $salida['hora_llegada'] . ' Hrs.', 1, 0, 'C');
            $pdf->Cell($w[3], 6, '', 1, 1, 'C');
            $pdf->Ln(4);

            // --- SECCIÓN 3: VEHÍCULO INSTITUCIONAL (CUADRO LIMPIO) ---
            $currentY = $pdf->GetY();
            $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
            $pdf->Rect(15, $currentY, 186, 15, 'DF'); // Caja contenedora controlada sin saltos de línea bruscos

            $pdf->SetY($currentY + 1.5);
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
            $pdf->SetX(18);
            $pdf->Cell(0, 4, 'USO DE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');

            $pdf->SetFont('helvetica', '', 8.5);
            $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
            $pdf->SetX(18);
            $pdf->Cell(30, 5, 'Vehículo / Movil:', 0, 0, 'L');
            $pdf->Cell(60, 5, $salida['transporte'] ? $salida['transporte'] : 'N/A', 'B', 0, 'L');

            $pdf->SetX(115);
            $pdf->Cell(30, 5, 'Chofer Autorizado:', 0, 0, 'L');
            $pdf->Cell(50, 5, '', 'B', 1, 'L');

            $pdf->SetY($currentY + 15); // Devolver el cursor abajo de la caja de manera segura
            $pdf->Ln(12); // Espacio controlado para firmas

            // --- SECCIÓN 4: RECUADRO DE VALIDACIÓN EXTERNA (LADO IZQUIERDO) y FIRMAS (LADO DERECHO) ---
            // Se rediseñó para que convivan horizontalmente y ahorrar espacio vertical
            $yFirmas = $pdf->GetY();

            // 4.1 Sello de Destino (Izquierda)
            $style_dashed = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2,2', 'color' => array(120, 120, 120));
            $pdf->Rect(15, $yFirmas, 65, 24, 'D', array('all' => $style_dashed));

            $pdf->SetXY(15, $yFirmas + 15);
            $pdf->SetFont('helvetica', 'B', 7.5);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(65, 4, 'SELLO Y FIRMA DE DESTINO', 0, 1, 'C');
            $pdf->SetFont('helvetica', '', 7);
            $pdf->Cell(65, 3, '(Lugar donde realizó la actividad)', 0, 0, 'C');

            // 4.2 Firma Servidor (Centro-Derecha)
            $pdf->SetXY(90, $yFirmas + 16);
            $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
            $pdf->Cell(50, 0, '', 'T', 1, 'C');
            $pdf->SetX(90);
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->Cell(50, 4, 'FIRMA DEL SERVIDOR', 0, 0, 'C');

            // 4.3 Firma Autorización RRHH (Derecha Extrema)
            $pdf->SetXY(151, $yFirmas + 16);
            $pdf->Cell(50, 0, '', 'T', 1, 'C');
            $pdf->SetX(151);
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->Cell(50, 4, 'AUTORIZADO POR: RR.HH.', 0, 0, 'C');
        };

        // =========================================================================
        // EJECUCIÓN DE LAS COPIAS
        // =========================================================================

        // Render de la primera boleta (Original)
        $renderBoleta('Original (Destino)');

        // Dibujar línea de corte media página
        $pdf->SetY(135);
        $style_cut = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => '4,3', 'color' => array(160, 160, 160));
        $pdf->Line(10, 137, 206, 137, $style_cut);

        // Posicionar el cursor abajo de la línea de corte para la segunda boleta
        $pdf->SetY(144);

        // Render de la segunda boleta (Copia)
        $renderBoleta('Copia (Archivo RR.HH.)');

        // 4. Salida del archivo PDF en el navegador
        $pdf->Output('Hoja_de_Salida_GAMP.pdf', 'I');
    }


    public function pdf1()
    {
        // 1. Obtener los datos del modelo
        $data = $this->model->getSalidasPdf(1);

        // Datos generales
        $salida = $data[0];


        // Sacar fecha actual
        $fecha_actual = date('Y-m-d');

        // 2. Cargar TCPDF (Composer recomendado)
        require_once 'vendor/autoload.php';
        // 3. Crear instancia en Tamaño CARTA (LETTER)
        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Metadata opcional
        $pdf->SetCreator('Sistema Administrativo');
        $pdf->SetAuthor('GAM Pocoata');
        $pdf->SetTitle('Hoja de Salida - ' . $fecha_actual);

        // Limpiar cabeceras por defecto
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Márgenes profesionales (Izquierdo: 15, Superior: 15, Derecho: 15)
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(TRUE, 15);

        // Añadir página
        $pdf->AddPage();

        // --- TITULARES ---
        // Logo a la izquierda (X=15mm, Y=10mm, Ancho=20mm)
        $pdf->Image('Assets/img/logo.jpg', 15, 3, 25, 25);
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 7, 'GOBIERNO AUTÓNOMO MUNICIPAL DE POCOATA', 0, 1, 'C');

        $pdf->SetFont('helvetica', 'B', 13);
        // Línea inferior del título para emular el estilo del diseño
        $pdf->Cell(0, 7, 'HOJA DE SALIDA DEL PERSONAL DEL G.A.M.P — GESTIÓN 2026', 'B', 1, 'C');
        $pdf->Ln(8);

        // --- DATOS DEL PERSONAL ---
        $pdf->SetFont('helvetica', '', 11);

        // Fila: Nombre
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(40, 7, 'Nombre y apellidos:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 7, $salida['id_usuario'], 'B', 1, 'L'); // Cambiar por el nombre completo si tu $data lo tiene
        $pdf->Ln(2);

        // Fila: Cargo
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(40, 7, 'Cargo:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 7, $salida['id_cargo'], 'B', 1, 'L');
        $pdf->Ln(2);

        // Fila: Motivo
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(40, 7, 'Motivo / Actividad:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 7, $salida['actividad'], 'B', 1, 'L');
        $pdf->Ln(5);

        // --- BLOQUE DE FECHAS Y HORAS ---
        // Procesar fechas básicas (puedes separar el string si necesitas mapear día por separado)
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(45, 7, 'Fecha y hora Salida:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(60, 7, 'Día: ' . $salida['fecha_salida'], 'B', 0, 'L');
        $pdf->Cell(40, 7, 'Hrs: ' . $salida['hora_salida'], 'B', 0, 'L');
        $pdf->Cell(0, 7, 'Año: 2026', 'B', 1, 'L');
        $pdf->Ln(2);

        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(45, 7, 'Fecha y hora Llegada:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(60, 7, 'Día: ' . $salida['hora_llegada'], 'B', 0, 'L'); // Ajustar si tienes fecha_llegada independiente
        $pdf->Cell(40, 7, 'Hrs: ' . $salida['hora_llegada'], 'B', 0, 'L');
        $pdf->Cell(0, 7, 'Año: 2026', 'B', 1, 'L');
        $pdf->Ln(8);

        // --- SECCIÓN VEHÍCULO (RECUADRO ESTILIZADO) ---
        // Dibujamos un fondo gris muy tenue para la tarjeta de vehículo
        $pdf->SetFillColor(250, 250, 250);
        $pdf->SetDrawColor(200, 200, 200);
        // Caja contenedora (Ancho, Alto, X, Y, tipo borde, etc.)
        $pdf->Cell(0, 28, '', 1, 1, 'L', true);

        // Volvemos a posicionar el cursor arriba de la caja armada para escribir los textos internos
        $pdf->SetY($pdf->GetY() - 26);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetTextColor(11, 44, 82); // Azul institucional
        $pdf->Cell(0, 5, 'CUANDO UTILICE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');
        $pdf->Ln(2);

        // Casillas de verificación
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('helvetica', '', 10);

        // Fila: Nombre

        $pdf->Cell(0, 7, $salida['transporte'], 'B', 1, 'L'); // Cambiar por el nombre completo si tu $data lo tiene
        $pdf->Ln(2);

        $pdf->Ln(3);

        // Chofer Autorizado dentro del recuadro
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(35, 5, 'Chofer Autorizado:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 5, '', 'B', 1, 'L'); // Espacio en blanco o variable si la tienes

        $pdf->Ln(12); // Separación para salir del recuadro de vehículo

        // --- FIRMAS DE AUTORIZACIÓN ---
        $pdf->SetDrawColor(119, 119, 119); // Líneas de firma gris medio
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetTextColor(68, 68, 68);

        // Guardamos posición Y para alinear ambas firmas a la misma altura
        $y_firmas = $pdf->GetY();

        // Columna Izquierda: Servidor
        $pdf->SetXY(25, $y_firmas + 15);
        $pdf->Cell(65, 0, '', 'T', 1, 'C'); // Línea horizontal superior
        $pdf->SetX(25);
        $pdf->Cell(65, 5, 'FIRMA DEL SERVIDOR', 0, 0, 'C');

        // Columna Derecha: RRHH
        $pdf->SetXY(125, $y_firmas + 15);
        $pdf->Cell(65, 0, '', 'T', 1, 'C'); // Línea horizontal superior
        $pdf->SetX(125);
        $pdf->Cell(65, 5, 'AUTORIZADO POR: RR.HH.', 0, 0, 'C');

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(15, $y_firmas + 28);

        // --- INFORME RESUMIDO ---
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetTextColor(11, 44, 82);
        $pdf->Cell(0, 6, 'INFORME RESUMIDO DE LA ACTIVIDAD REALIZADA', 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(2);

        // Líneas de informe (Simulación de renglones para escritura manual si se requiere)
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Ln(8);

        // --- RECUADRO DE VALIDACIÓN EXTERNA (FIRMA Y SELLO DE DESTINO) ---
        $pdf->SetDrawColor(136, 136, 136);
        // Definir estilo de línea discontinua (puntos/guiones) para el sello de destino
        $style_dashed = array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => '3,3', 'color' => array(136, 136, 136));

        $current_x = $pdf->GetX();
        $current_y = $pdf->GetY();

        // Dibujamos el rectángulo exterior con líneas discontinuas
        $pdf->Rect($current_x, $current_y, 186, 30, 'D', array('all' => $style_dashed));

        // Texto inferior derecho interno en el recuadro
        $pdf->SetXY($current_x, $current_y + 16);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor(85, 85, 85);
        $pdf->Cell(0, 4, 'FIRMA Y SELLO', 0, 1, 'R');
        $pdf->Cell(0, 4, 'LUGAR DONDE REALIZÓ LA ACTIVIDAD  ', 0, 1, 'R');

        // 4. Salida del archivo PDF en el navegador
        $pdf->Output('Hoja_de_Salida_GAMP.pdf', 'I');
    }

    public function pdfHojadeRuta()
    {
        // 1. Obtener los datos del modelo
        $data = $this->model->getSalidasPdf(1);

        // Extraer variables de forma segura con valores por defecto si vienen vacíos
        $actividad = !empty($data['actividad']) ? $data['actividad'] : '';
        $lugar = !empty($data['lugar']) ? $data['lugar'] : '';
        $transporte = !empty($data['transporte']) ? strtolower($data['transporte']) : '';
        $fecha_salida = !empty($data['fecha_salida']) ? $data['fecha_salida'] : '';
        $hora_salida = !empty($data['hora_salida']) ? $data['hora_salida'] : '';
        $hora_llegada = !empty($data['hora_llegada']) ? $data['hora_llegada'] : '';
        $usuario = !empty($data['id_usuario']) ? $data['id_usuario'] : ''; // Puedes cambiar por el nombre si lo tienes
        $cargo = !empty($data['cargo']) ? $data['cargo'] : ''; // Si tu consulta trae el cargo

        // 2. Cargar TCPDF de forma segura (subiendo de nivel desde Controllers/)
        require_once dirname(__DIR__) . '/vendor/autoload.php';

        // 3. Crear instancia en Tamaño CARTA (LETTER)
        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Metadata opcional
        $pdf->SetCreator('Sistema Administrativo');
        $pdf->SetAuthor('GAM Pocoata');
        $pdf->SetTitle('Hoja de Salida - ' . $usuario);

        // Limpiar cabeceras por defecto
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Márgenes profesionales (Izquierdo: 15, Superior: 15, Derecho: 15)
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(TRUE, 15);

        // Añadir página
        $pdf->AddPage();

        // --- TITULARES ---
        $pdf->SetFont('helvetica', 'B', 15);
        $pdf->Cell(0, 7, 'GOBIERNO AUTÓNOMO MUNICIPAL DE POCOATA', 0, 1, 'C');

        $pdf->SetFont('helvetica', 'B', 12);
        // Línea inferior del título para emular el estilo del diseño
        $pdf->Cell(0, 7, 'HOJA DE SALIDA DEL PERSONAL DEL G.A.M.P — GESTIÓN 2026', 'B', 1, 'C');
        $pdf->Ln(8);

        // --- DATOS DEL PERSONAL ---
        $pdf->SetFont('helvetica', '', 11);

        // Fila: Nombre
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(40, 7, 'Nombre y apellidos:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 7, $usuario, 'B', 1, 'L'); // Cambiar por el nombre completo si tu $data lo tiene
        $pdf->Ln(2);

        // Fila: Cargo
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(40, 7, 'Cargo:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 7, $cargo, 'B', 1, 'L');
        $pdf->Ln(2);

        // Fila: Motivo
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(40, 7, 'Motivo / Actividad:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 7, $actividad, 'B', 1, 'L');
        $pdf->Ln(5);

        // --- BLOQUE DE FECHAS Y HORAS ---
        // Procesar fechas básicas (puedes separar el string si necesitas mapear día por separado)
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(45, 7, 'Fecha y hora Salida:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(60, 7, 'Día: ' . $fecha_salida, 'B', 0, 'L');
        $pdf->Cell(40, 7, 'Hrs: ' . $hora_salida, 'B', 0, 'L');
        $pdf->Cell(0, 7, 'Año: 2026', 'B', 1, 'L');
        $pdf->Ln(2);

        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(45, 7, 'Fecha y hora Llegada:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(60, 7, 'Día: ' . $fecha_salida, 'B', 0, 'L'); // Ajustar si tienes fecha_llegada independiente
        $pdf->Cell(40, 7, 'Hrs: ' . $hora_llegada, 'B', 0, 'L');
        $pdf->Cell(0, 7, 'Año: 2026', 'B', 1, 'L');
        $pdf->Ln(8);

        // --- SECCIÓN VEHÍCULO (RECUADRO ESTILIZADO) ---
        // Dibujamos un fondo gris muy tenue para la tarjeta de vehículo
        $pdf->SetFillColor(250, 250, 250);
        $pdf->SetDrawColor(200, 200, 200);
        // Caja contenedora (Ancho, Alto, X, Y, tipo borde, etc.)
        $pdf->Cell(0, 28, '', 1, 1, 'L', true);

        // Volvemos a posicionar el cursor arriba de la caja armada para escribir los textos internos
        $pdf->SetY($pdf->GetY() - 26);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetTextColor(11, 44, 82); // Azul institucional
        $pdf->Cell(0, 5, 'CUANDO UTILICE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');
        $pdf->Ln(2);

        // Casillas de verificación
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('helvetica', '', 10);

        // Checkboxes lógicos basados en el campo $transporte de tu base de datos
        $chk_vagoneta = ($transporte == 'vagoneta') ? '[ X ]' : '[   ]';
        $chk_camioneta = ($transporte == 'camioneta') ? '[ X ]' : '[   ]';
        $chk_motocicleta = ($transporte == 'motocicleta' || $transporte == 'moto') ? '[ X ]' : '[   ]';

        $pdf->Cell(60, 5, $chk_vagoneta . ' Vagoneta', 0, 0, 'L');
        $pdf->Cell(60, 5, $chk_camioneta . ' Camioneta', 0, 0, 'L');
        $pdf->Cell(0, 5, $chk_motocicleta . ' Motocicleta', 0, 1, 'L');
        $pdf->Ln(3);

        // Chofer Autorizado dentro del recuadro
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(35, 5, 'Chofer Autorizado:', 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 5, '', 'B', 1, 'L'); // Espacio en blanco o variable si la tienes

        $pdf->Ln(12); // Separación para salir del recuadro de vehículo

        // --- FIRMAS DE AUTORIZACIÓN ---
        $pdf->SetDrawColor(119, 119, 119); // Líneas de firma gris medio
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetTextColor(68, 68, 68);

        // Guardamos posición Y para alinear ambas firmas a la misma altura
        $y_firmas = $pdf->GetY();

        // Columna Izquierda: Servidor
        $pdf->SetXY(25, $y_firmas + 15);
        $pdf->Cell(65, 0, '', 'T', 1, 'C'); // Línea horizontal superior
        $pdf->SetX(25);
        $pdf->Cell(65, 5, 'FIRMA DEL SERVIDOR', 0, 0, 'C');

        // Columna Derecha: RRHH
        $pdf->SetXY(125, $y_firmas + 15);
        $pdf->Cell(65, 0, '', 'T', 1, 'C'); // Línea horizontal superior
        $pdf->SetX(125);
        $pdf->Cell(65, 5, 'AUTORIZADO POR: RR.HH.', 0, 0, 'C');

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(15, $y_firmas + 28);

        // --- INFORME RESUMIDO ---
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetTextColor(11, 44, 82);
        $pdf->Cell(0, 6, 'INFORME RESUMIDO DE LA ACTIVIDAD REALIZADA', 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(2);

        // Líneas de informe (Simulación de renglones para escritura manual si se requiere)
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Cell(0, 6, '', 'B', 1, 'L');
        $pdf->Ln(8);

        // --- RECUADRO DE VALIDACIÓN EXTERNA (FIRMA Y SELLO DE DESTINO) ---
        $pdf->SetDrawColor(136, 136, 136);
        // Definir estilo de línea discontinua (puntos/guiones) para el sello de destino
        $style_dashed = array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => '3,3', 'color' => array(136, 136, 136));

        $current_x = $pdf->GetX();
        $current_y = $pdf->GetY();

        // Dibujamos el rectángulo exterior con líneas discontinuas
        $pdf->Rect($current_x, $current_y, 186, 30, 'D', array('all' => $style_dashed));

        // Texto inferior derecho interno en el recuadro
        $pdf->SetXY($current_x, $current_y + 16);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor(85, 85, 85);
        $pdf->Cell(0, 4, 'FIRMA Y SELLO', 0, 1, 'R');
        $pdf->Cell(0, 4, 'LUGAR DONDE REALIZÓ LA ACTIVIDAD  ', 0, 1, 'R');

        // 4. Salida del archivo PDF en el navegador
        $pdf->Output('Hoja_de_Salida_GAMP.pdf', 'I');
    }









}
?>