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
        $pdf->SetMargins(20, 20,10);
        $pdf->SetAutoPageBreak(TRUE, 20);

        // Añadir página única
        $pdf->AddPage();

        // Paleta de Colores Institucionales
        $primaryColor = [11, 44, 82];    // Azul de Gobierno Profundo
        $textColor = [40, 40, 40];       // Gris Oscuro para legibilidad premium
        $lineColor = [180, 180, 180];    // Gris de división suave
        $bgColor = [245, 247, 250];      // Fondo tenue para celdas de control

        // Ancho útil disponible (Carta = 215.9mm - 40mm de márgenes = 175.9mm, aproximado a 176mm)
        $txtWidth = 185;

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
        $pdf->SetFont('helvetica', 'B', 9.5);
        $pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->SetX(24);
        $pdf->Cell(0, 4, 'CUANDO UTILICE VEHÍCULO INSTITUCIONAL', 0, 1, 'L');

        $pdf->SetFont('helvetica', '', 7.5);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetX(24);
        $pdf->Cell(32, 6, 'VEHÍCULO /MÓVIL:', 0, 0, 'L');
        $pdf->Cell(58, 6, $salida['transporte'] ? $salida['transporte'] : 'N/A', 'B', 0, 'L');

        $pdf->SetX(118);
        $pdf->Cell(32, 6, 'CHOFER AUTORIZADO :', 0, 0, 'L');
        $pdf->Cell(46, 6, $salida['nombre_chofer'] ?? 'N/A', 'B', 1, 'L');

        $pdf->SetY($boxY + 18);
        $pdf->Ln(6);


        // --- SECCIÓN 4: INFORME RESUMIDO DE LA ACTIVIDAD ---
        $pdf->Ln(3);

        // Título
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
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
    public function buscarFuncionarios()
    {
        if (isset($_GET['pro'])) {
            $data = $this->model->buscarFuncionario($_GET['pro']);
            $datos = array();
            foreach ($data as $row) {
                $data['id'] = $row['id'];
                $data['label'] = $row['ci'] . '-' . $row['nombres'];
                $data['value'] = $row['ci'] . '-' . $row['nombres'];
                array_push($datos, $data);
            }
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            die();
        }
    }



public function FechaFuncionarioPdf()
{
    $id_usuario  = $_POST['id_usuario'] ?? '';
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin    = $_POST['fecha_fin'] ?? '';

    if (empty($id_usuario) || empty($fecha_inicio) || empty($fecha_fin)) {
        echo "Parámetros incompletos.";
        return;
    }

                    date_default_timezone_set('America/La_Paz');
                  
    $data = $this->model->getReporteSalidasTC($id_usuario, $fecha_inicio, $fecha_fin);

    $salida=$data[0];
    if (empty($data)) {
        echo "No se encontraron datos para los criterios seleccionados.";
        return;
    }
    
    require_once dirname(__DIR__) . '/vendor/autoload.php';

    // 1. Instanciar TCPDF en Tamaño CARTA
    $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

    // 2. Configuración del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('GAMP');
    $pdf->SetTitle('Reporte de Salidas de Personal');
    
    // Quitar cabecera y pie de página por defecto para hacer uno personalizado y moderno
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(true); // Dejar activo para el número de página abajo
    
    // Margen: Izquierda(15), Arriba(15), Derecha(15)
    $pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(TRUE, 20); // Margen inferior

    // Añadir la primera página
    $pdf->AddPage();
    
    // Clonar tipografía limpia (Helvetica/Arial)
    $pdf->SetFont('helvetica', '', 10);

    // Intentar obtener el nombre del usuario si tu consulta trae datos de la tabla usuarios
    // Si tu consulta SELECT actual no tiene el campo del nombre, te sugiero agregarlo en el modelo (ej: us.nombre)
    $nombre_usuario = $data[0]['nombres'].' '.$salida['apellidos'] ?? 'Funcionario ID: ' . $id_usuario; 

    // 3. Estructura HTML con estilo moderno (CSS)
    $html = '
    <table cellpadding="5" cellspacing="0" style="width:100%; border-bottom: 2px solid #2B6CB0; padding-bottom: 10px;">
        <tr>
            <td style="width: 60%;">
                <span style="font-size: 18px; font-weight: bold; color: #1A365D;">REPORTE DE SALIDAS</span><br>
                <span style="font-size: 11px; color: #4A5568;">Gobierno Autónomo Municipal (GAMP)</span>
            </td>
            <td style="width: 40%; text-align: right; font-size: 10px; color: #4A5568;">
                <strong>Fecha Emisión:</strong> ' . date('d/m/Y') . '<br>
                <strong>Período:</strong> ' . date('d/m/Y', strtotime($fecha_inicio)) . ' al ' . date('d/m/Y', strtotime($fecha_fin)) . '
            </td>
        </tr>
    </table>

    <br><br>

    <div style="background-color: #F7FAFC; padding: 12px; border-left: 4px solid #4299E1; margin-bottom: 20px;">
        <table cellpadding="3" cellspacing="0" style="width:100%;">
            <tr>
                <td style="font-size: 11px; color: #2D3748;">
                    <strong>Funcionario:</strong> ' . htmlspecialchars($nombre_usuario) . ' <br>
                    <strong>Cargo:</strong> ' . htmlspecialchars($salida['nombre_cargo']) . '
                </td>
                <td style="font-size: 11px; color: #2D3748; text-align: right;">
                    <strong>Total Registros:</strong> ' . count($data) . ' salidas
                </td>
            </tr>
        </table>
    </div>

    <br><br>

    <table cellpadding="8" cellspacing="0" style="width:100%; font-size: 9px; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #1A365D; color: #FFFFFF; font-weight: bold; text-align: center;">
                <th style="width: 8%; border: 1px solid #1A365D;">ID</th>
                <th style="width: 25%; border: 1px solid #1A365D; text-align: left;">Actividad</th>
                <th style="width: 22%; border: 1px solid #1A365D; text-align: left;">Lugar de Destino</th>
                <th style="width: 15%; border: 1px solid #1A365D;">Medio Transp.</th>
                <th style="width: 15%; border: 1px solid #1A365D;">Salida (Fecha/Hora)</th>
                <th style="width: 15%; border: 1px solid #1A365D;">Retorno (Fecha/Hora)</th>
            </tr>
        </thead>
        <tbody>';
        $i=1;       
        // Ciclo para rellenar las filas dinámicamente
        $background_color = '#FFFFFF';
        foreach ($data as $row) {
            // Alternar colores de filas para mejorar legibilidad
            $background_color = ($background_color == '#FFFFFF') ? '#F7FAFC' : '#FFFFFF';
            
            // Formatear fechas de YYYY-MM-DD a DD/MM/YYYY
            $f_salida = date('d/m/Y', strtotime($row['fecha_salida']));
            $f_llegada = date('d/m/Y', strtotime($row['fecha_llegada']));
            
            // Recortar horas por si tienen segundos (00:00:00 -> 00:00)
            $h_salida = substr($row['hora_salida'], 0, 5);
            $h_llegada = substr($row['hora_llegada'], 0, 5);

            $html .= '
            <tr style="background-color: ' . $background_color . '; color: #2D3748;">
                <td style="border: 1px solid #E2E8F0; text-align: center; font-weight: bold;">' . $i++ . '</td>
                <td style="border: 1px solid #E2E8F0;">' . htmlspecialchars($row['actividad']) . '</td>
                <td style="border: 1px solid #E2E8F0;">' . htmlspecialchars($row['lugar']) . '</td>
                <td style="border: 1px solid #E2E8F0; text-align: center;">' . htmlspecialchars($row['transporte']) . '</td>
                <td style="border: 1px solid #E2E8F0; text-align: center;">' . $f_salida . '<br><span style="color:#718096;">' . $h_salida . '</span></td>
                <td style="border: 1px solid #E2E8F0; text-align: center;">' . $f_llegada . '<br><span style="color:#718096;">' . $h_llegada . '</span></td>
            </tr>';
        }

    $html .= '
        </tbody>
    </table>';

    // 4. Renderizar el HTML en el PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // 5. Salida del archivo PDF en el navegador
    $pdf->Output('Reporte_Salidas_' . $id_usuario . '.pdf', 'I');
}









}
?>