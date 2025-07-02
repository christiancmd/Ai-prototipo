<?php
declare(strict_types=1);

session_start();


require('../../fpdf/fpdf.php');
include '../controllers/conection.php';

$name_doc = $_SESSION['name_doctor'];
$l_name_doc = $_SESSION['last_doctor'];

$first_name_d = explode(separator: " ", string: $name_doc)[0];
$first_l_name_d = explode(separator: " ", string: $l_name_doc)[0];

$name_doctor = "$first_name_d $first_l_name_d";

//Incluir el archivo de funciones mediante templates
require_once("../templates/functions.php");

$Id_doctor = $_SESSION['id'] ?? null; // Obtener el id del doctor de la sesion
$data_patient = send_total_patient_pdf($conection, $Id_doctor, );

$fpdf = new FPDF();
$fpdf->AddPage(orientation: 'portrait', size: 'letter');   // Add a page

date_default_timezone_set(timezoneId: 'America/Caracas'); ///Ejemplo de zona horaria
$date = date(format: 'Y-m-d');

class pdf extends FPDF
{
    public function header(): void
    {
        /*  $this->SetFont(family: 'Arial', style: 'BI', size: 15);
        $this->Write(h: '5', txt: "Logo");*/
        $this->Image('../../public/Logo_pdf_nutrimore.png', $this->GetPageWidth() - 40, y: 3.5, w: 30); //Tamaño y posición del logo de la primera página

        $this->SetX(x: 20);
        $this->SetFont(family: 'Arial', style: 'BI', size: 25);
        $this->Write(h: '22', txt: "Nutrimore");

        $this->ln(h: 27);
    }

    public function Footer(): void
    {
        $this->SetFont(family: 'Arial', style: 'B', size: 12);
        $this->SetY(y: -15);
        $this->Write(h: '5', txt: "Nutrimore.");

        $this->SetX(x: -25);
        $this->Write(h: '5', txt: $this->PageNo()) . ' / {nb}';
    }
}


function convert_String($string): mixed
{
    $converted_string = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $string);
    return $converted_string;
}

$fpdf = new pdf();
$fpdf->AddPage(orientation: 'portrait', size: 'letter');   // Add a page

$fpdf->SetFont(family: 'Arial', style: 'BIU', size: 22);
$fpdf->Cell(w: 195, h: 15, txt: convert_String(string: 'Reporte de Inscripción de Pacientes'), border: 0, ln: 0, align: 'C', fill: false);  // Add text to the page

$fpdf->Ln(h: 20); //Salto de linea
$fpdf->SetFont(family: 'Arial', style: 'BI', size: 10);

$text = "    El presente reporte de pacientes refleja detalladamente la información sobre cada individuo atendido en el consultorio nutricional, permitiendo un resumen preciso de los pacientes. La visualización organizada de estos datos facilita una mejor comprensión del estado de salud de los pacientes, las estrategias y objetivos para la mejora de su bienestar. Además, este reporte constituye un registro fundamental de la actividad realizada en el consultorio, brindando una base sólida para futuros análisis clínicos y planificación de tratamientos personalizados. Su formalidad y exactitud son esenciales para garantizar la transparencia y confiabilidad de la información presentada al nutricionista, asegurando un monitoreo riguroso del proceso de atención y promoviendo la eficacia de las intervenciones nutricionales.
.";

$fpdf->MultiCell(w: 195, h: 7, txt: convert_String($text), border: 0, align: 'J');

$fpdf->Ln(h: 10);//Salto de linea

$fpdf->SetFont(family: 'Arial', style: 'BI', size: 12);

$fpdf->SetFillColor(54, 186, 153);
$fpdf->Cell(w: 25, h: 15, txt: convert_String(string: 'Cedula'), border: 1, ln: 0, align: 'C', fill: true);
$fpdf->Cell(w: 45, h: 15, txt: convert_String(string: 'Nombre'), border: 1, ln: 0, align: 'C', fill: true);
$fpdf->Cell(w: 39, h: 15, txt: convert_String(string: 'Edad'), border: 1, ln: 0, align: 'C', fill: true);
$fpdf->Cell(w: 41, h: 15, txt: convert_String(string: 'Contacto'), border: 1, ln: 0, align: 'C', fill: true);
$fpdf->Cell(w: 41, h: 15, txt: convert_String(string: 'Registro'), border: 1, ln: 1, align: 'C', fill: true);

$fpdf->SetFont(family: 'Arial', style: 'BI', size: 9);

foreach ($data_patient as $key) {

    $name = $key['name'];
    $l_name = $key['last_name'];

    $first_name = explode(separator: " ", string: $name)[0];
    $first_l_name = explode(separator: " ", string: $l_name)[0];

    $full_name = "$first_name $first_l_name";


    $fpdf->Cell(w: 25, h: 12, txt: $key["id"], border: 1, ln: 0, align: 'C', fill: false);
    $fpdf->Cell(w: 45, h: 12, txt: convert_String($full_name), border: 1, ln: 0, align: 'C', fill: false);
    $fpdf->Cell(w: 39, h: 12, txt: $key["age"], border: 1, ln: 0, align: 'C', fill: false);
    $fpdf->Cell(w: 41, h: 12, txt: $key["contact"], border: 1, ln: 0, align: 'C', fill: false);
    $fpdf->Cell(w: 41, h: 12, txt: $key["date"], border: 1, ln: 1, align: 'C', fill: false);

}

$fpdf->Ln(h: 10);//Salto de linea

$fpdf->Cell(w: 195, h: 15, txt: "___________________________", border: 0, ln: 1, align: 'C', fill: false);
$fpdf->SetFont(family: 'Arial', style: 'BI', size: 12);
$fpdf->Cell(w: 195, h: 0, txt: convert_String(string: 'Firma del Administrador'), border: 0, ln: 1, align: 'C', fill: false);  // Add text to the page
$fpdf->ln(10);
$fpdf->SetFont(family: 'Arial', style: 'BI', size: 10);
$fpdf->Cell(w: 190, h: 0, txt: convert_String($date), border: 0, ln: 0, align: 'C', fill: false);  // Add text to the page



$fpdf->Output(dest: 'I', name: 'Reporte de pacientes registrados Dr.' . $name_doctor . '.pdf', isUTF8: 'UTF-8');  // Save the document
