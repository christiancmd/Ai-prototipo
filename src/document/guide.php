<?php
declare(strict_types=1);

require('../../fpdf/fpdf.php');


$json_patient = file_get_contents('../controllers/patient.json');
$json_list_aliment = file_get_contents('../controllers/result.json');

// Convertir JSON a objeto PHP
$patient_data = json_decode($json_patient, true);
$list_aliment_data = json_decode($json_list_aliment, true);

extract(array: $patient_data);
if ($list_aliment_data) {
    extract($list_aliment_data);
}



date_default_timezone_set(timezoneId: 'America/Caracas'); ///Ejemplo de zona horaria
$date = date(format: 'd-m-y');



$fpdf = new FPDF();

class PDF extends FPDF
{
    // Cabecera de p�gina
    public function Header()
    {
        // Logo
        if ($this->PageNo() == 1) { //Ajustes en la primera página
            $this->SetFont('Arial', 'B', 20);
            $this->Write(h: 10, txt: 'Nutrimore');
            $y_line = 20; //Ajuste Manual de la linea de la primera página
            $this->SetLineWidth(0.5);
            $this->Line(10, $y_line, 200, $y_line);
            $this->Image('../../public/Logo_pdf_nutrimore.png', $this->GetPageWidth() - 40, y: 3.5, w: 30); //Tamaño y posición del logo de la primera página

        } else if ($this->PageNo() != 1) {
            if ($this->PageNo() != 6) {
                $this->Image('../../public/logo_nutrimore.png', 100, 20, w: 20); //logo
            }
            $this->Ln();
            $this->Line(10, $this->GetY(), x2: 200, y2: $this->GetY());
        }
    }
    // Pie de p�gina
    public function Footer()
    {

        $this->SetY(y: -25);
        $y = $this->GetY();
        $this->Line(10, $y, 200, $y);


        //Logo
        if ($this->PageNo() != 1) {
            $this->Image('../../public/logo_nutrimore.png', 15, 255, 20);
            $this->SetFont('Arial', 'B', 20);
            $this->SetXY(30, 248);
            $this->Cell(100, 30, 'Nutrimore', 0, 0, 'L');
        }

        //Aplicación en todas las páginas (Pie de página)
        $this->SetY(y: -30);
        $this->SetFont('Arial', style: '', size: 10);
        $this->Cell(0, 27, '' . $this->PageNo() . '', 0, 0, 'C'); //Contador en pie de página
    }
}

function convert_string($string): mixed
{
    $converted_string = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $string);
    return $converted_string;
}

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage('P', size: 'letter'); //Estilo Hoja tamaño carta
$pdf->SetMargins(20, 10, right: 20);
$pdf->SetFont('Arial', '', 15);
$pdf->Ln();

// Primera Página
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 10, convert_string("Valoración Nutricional"), 0, 0, 'C');

$wPagina = $pdf->GetPageWidth();



//Tabla de Valoración Nutricional
//Información General
$pdf->Ln(15);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFillColor(186, 232, 296);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(170, 10, convert_string("Información General"), 1, 0, 'C', true);
//Campos
$pdf->Ln(10);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFillColor(186, 232, 236);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100, 10, 'Paciente', 1, 0, 'C', true);
$pdf->Cell(23.3, 10, 'Sexo', 1, 0, 'C', true);
$pdf->Cell(23.3, 10, 'Edad', 1, 0, 'C', true);
$pdf->Cell(23.3, 10, 'Fecha', 1, 1, 'C', true);
//Datos
$pdf->Ln(0);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 10, ucwords(convert_string($name . ' ' . $last_name)), 1, 0, align: 'C');
$pdf->Cell(23.3, 10, $genre, 1, 0, align: 'C');
$pdf->Cell(23.3, 10, $age, 1, 0, 'C');
$pdf->Cell(23.3, 10, $date, 1, 1, align: 'C');
//Campos
$pdf->Ln(0);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFillColor(186, 232, 236);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100, 10, convert_string('Correo Eletrónico'), 1, 0, 'C', true);
$pdf->Cell(35, 10, convert_string('Teléfono'), 1, 0, 'C', true);
$pdf->Cell(35, 10, convert_string('Cédula'), 1, 1, 'C', true);

//Datos
$pdf->Ln(h: 0);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 10, $email, 1, 0, align: 'C');
$pdf->Cell(35, 10, '0' . $number, 1, 0, align: 'C');
$pdf->Cell(35, 10, $id_card_number, 1, 0, 'C');
//Información Médica
$pdf->Ln(10);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFillColor(186, 232, 296);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(170, 10, convert_string('Información Médica'), 1, 0, 'C', true);
//Campos
$pdf->Ln(10);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFillColor(186, 232, 236);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100, 10, convert_string('Observación'), 1, 0, 'C', true);
$pdf->Cell(35, 10, 'Peso', 1, 0, 'C', true);
$pdf->Cell(35, 10, 'Altura', 1, 1, 'C', true);
//Datos
$pdf->Ln(h: 0);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 10 * 3, ucwords(convert_string($pathology)), 1, 0, align: 'C');
$pdf->Cell(35, 10, $weight . "kg", 1, 0, align: 'C');
$pdf->Cell(35, 10, $height . "cm", 1, 1, align: 'C');
//Campos
$pdf->Ln(0);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2 + 100);
$pdf->SetFillColor(186, 232, 236);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 10, convert_string('Diagnóstico (IMC)'), 1, 0, 'C', true);
$pdf->Cell(35, 10, convert_string('Objetivo'), 1, 0, 'C', true);
//Datos
$pdf->Ln(h: 10);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2 + 100);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 10, $nutrients_data["imc"], 1, 0, align: 'C');
$pdf->Cell(35, 10, convert_string($reason), 1, 0, 'C');
//Fin de la Tabla

$pdf->Ln(h: 20);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 0, 'Recomendaciones', 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', '', size: 10);




$respect_time_r = convert_string("      Respetar los horarios de las comidas ayuda a mantener un metabolismo equilibrado y una digestión eficiente. Además, mejora la energía y el rendimiento a lo largo del día, evitando bajones y excesos innecesarios. Siguiendo una rutina alimenticia adecuada, favorecemos la salud y el bienestar general.");
$pdf->MultiCell(0, 8, chr(149) . $respect_time_r, 0, 'J');
$pdf->SetFont('Arial', 'B', size: 10);
$pdf->Write(10, "Horarios:\n");
$pdf->SetFont('Arial', '', size: 10);
$Horarios = "   Desayuno (7:30am - 8:30am)\n    Merienda Matutina (10:00am - 10:30am)\n    Almuerzo (12:30pm - 1:00pm)\n    Merienda Vesperina (3:00pm - 3:30pm)\n    Cena (6:30pm - 7:00pm)";
$pdf->MultiCell(0, 10, $Horarios, 0, 'L');

// Segunda Página
$pdf->AddPage('P', size: 'letter');
$pdf->SetFont('Arial', style: '', size: 10);
$pdf->Ln(5);
$drink_water_r = convert_string("       Beber suficiente agua es esencial para una digestión eficiente y la absorción de nutrientes. Mantener una hidratación adecuada ayuda al cuerpo a eliminar toxinas y a regular la temperatura.  ");
$pdf->MultiCell(0, 8, chr(149) . $drink_water_r, 0, 'J');

$pdf->Ln(5);
$sleep_well_r = convert_string("      Dormir bien es clave para un metabolismo equilibrado, evitando la acumulación de grasa innecesaria y la alteración del apetito. Cuando el descanso es insuficiente, las hormonas del hambre se descontrolan, generando deseos de alimentos poco saludables.");
$pdf->MultiCell(0, 8, chr(149) . $sleep_well_r, 0, 'J');

$pdf->Ln(5);
$do_exercise_r = convert_string("      El ejercicio físico complementa la nutrición al fortalecer el sistema cardiovascular, mejora la circulación y optimiza la digestión, favoreciendo la absorción de nutrientes. También ayuda a reducir el estrés, evitando su impacto en los hábitos alimenticios. Si existen razones médicas que impidan la actividad física, lo mejor es consultar a un especialista para recibir orientación adecuada.");
$pdf->MultiCell(0, 8, chr(149) . $do_exercise_r, 0, 'J');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', size: 10);
$pdf->MultiCell(0, 10, "Seguimiento de la Lista de Intercambio:", 0, 'J');
$pdf->SetFont('Arial', '', size: 10);
$Intercambio = convert_string("    Una lista de intercambios es una herramienta que permite sustituir alimentos dentro de un mismo grupo sin alterar su valor nutricional. Su propósito es ofrecer flexibilidad en la alimentación sin afectar la cantidad de calorías ni nutrientes esenciales. Cada grupo alimenticio, como carbohidratos, proteínas o grasas, contiene opciones equivalentes que pueden intercambiarse. Esta metodología es útil para quienes siguen dietas específicas, como aquellas enfocadas en el control de peso o enfermedades metabólicas. Facilita la personalización de menús sin comprometer el equilibrio nutricional, evitando la monotonía y mejorando la adherencia al plan alimenticio. Es una estrategia comúnmente utilizada por nutricionistas para garantizar una alimentación variada y saludable. Con un buen uso de esta herramienta, es posible disfrutar de la comida de manera equilibrada.");
$pdf->MultiCell(0, 8, $Intercambio, 0, 'J');
$pdf->SetFont('Arial', 'B', size: 10);
$pdf->Ln(5);
$pdf->MultiCell(0, 8, convert_string('   Antes de aplicar cualquier diagnóstico, es fundamental leer por completo la información contenida en esta guía alimentaria. Un análisis incompleto puede llevar a interpretaciones erróneas que afecten la salud del paciente. Para asegurar resultados óptimos, es imprescindible seguir todas las indicaciones y recomendaciones nutricionales establecidas en esta guía.'), 0, 'J');


// Tercera Página
$pdf->AddPage('P', size: 'letter');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', size: 15);
$pdf->Cell(0, 15, 'Lista de Intercambio', 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', style: 'B', size: 10);
$pdf->Write(0, convert_string('Requerimiento Calórico (Según Objetivo): '));
$pdf->SetFont('Arial', style: '', size: 10);
$pdf->Write(0, $nutrients_data["rct_obj"] . "Kcal"); //IMPORTANTE: Aquí debe ir el dato de RCT
//Campo
$pdf->Ln(h: 5);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(186, 232, 236);
$pdf->Cell(56.6, 10, 'TMB', 1, 0, 'C', true);
$pdf->Cell(56.6, 10, 'NAF', 1, 0, 'C', true);
$pdf->Cell(56.6, 10, 'RCT', 1, 1, 'C', true);
//Datos
$pdf->Ln(h: 0);
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(186, 232, 236);
$pdf->Cell(56.6, 10, $nutrients_data["tmb"], 1, 0, 'C');
$pdf->Cell(56.6, 10, $nutrients_data["naf"], 1, 0, 'C');
$pdf->Cell(56.6, 10, $nutrients_data["rct"], 1, 1, 'C');

//Decodificación del Json
//$json_data = file_get_contents("result.json");
//$data = json_decode($json_data, true);

//Tabla de Guía Alimentaria
//Campos
$pdf->Ln();
$wTabla = 170;
$pdf->SetX(($wPagina - $wTabla) / 2);
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(186, 232, 236);
$pdf->Cell(50, 10, 'Grupo', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Alimento', 1, 0, 'C', true);
$pdf->Cell(50, 10, convert_string('Ración'), 1, 1, 'C', true);
//Datos
$maxAlturaPagina = 250; // Tamaño de página
$rowHeight = 10; // altura fija por fila de alimento

if (isset($list_aliment_data) && is_array($list_aliment_data) && !empty($list_aliment_data)) {
    foreach ($list_aliment_data["listaDeIntercambio"] as $grupo) {
        $nombreGrupo = key($grupo);
        $alimentos = $grupo[$nombreGrupo];
        $totalFilas = count($alimentos); // para contar el contenido que habrá en los grupos
        $currentFila = 0;

        while ($currentFila < $totalFilas) {
            $espacioDisponible = $maxAlturaPagina - $pdf->GetY(); // Altura de página menos la altura acutal de la fila
            $filasQueEntran = floor($espacioDisponible / $rowHeight);

            // En caso de no haber espacio
            if ($filasQueEntran <= 0) {
                $pdf->AddPage();
                $pdf->Ln(15);
                $pdf->SetX(($wPagina - $wTabla) / 2);
                $pdf->Cell(50, 10, 'Grupo', 1, 0, 'C', true);
                $pdf->Cell(70, 10, 'Alimento', 1, 0, 'C', true);
                $pdf->Cell(50, 10, 'Ración', 1, 1, 'C', true);
                $espacioDisponible = $maxAlturaPagina - $pdf->GetY();
                $filasQueEntran = floor($espacioDisponible / $rowHeight);
            }

            $filasRestantes = $totalFilas - $currentFila;
            $filasImprimir = min($filasQueEntran, $filasRestantes);
            $alturaBloque = $filasImprimir * $rowHeight;

            for ($i = 0; $i < $filasImprimir; $i++) {
                $pdf->SetX(($wPagina - $wTabla) / 2);
                if ($i == 0) {
                    // Continuación de grupo
                    $textoGrupo = ($currentFila == 0) ? ucfirst($nombreGrupo) : ucfirst($nombreGrupo);
                    // Tamaño de celda de grupo según el contenido restante de alimentos y ración en caso de dividirse la tabla
                    $pdf->Cell(50, $alturaBloque, $textoGrupo, 1, 0, 'C', false);
                } else {
                    $pdf->SetX(($wPagina - $wTabla) / 2 + 50);
                }

                // Impresión de celdas de alimento y ración
                $alimentoActual = $alimentos[$currentFila + $i];
                $nombreAlimento = key($alimentoActual);
                $racionAlimento = $alimentoActual[$nombreAlimento];

                $pdf->Cell(70, $rowHeight, convert_string($nombreAlimento), 1, 0, 'C');
                $pdf->Cell(50, $rowHeight, convert_string($racionAlimento), 1, 1, 'C');
            }

            // Contador de filas impresas en el grupo
            $currentFila += $filasImprimir;
            if ($currentFila < $totalFilas) {
                $pdf->AddPage(orientation: 'P', size: 'letter');
                $pdf->Ln(15);
                $pdf->SetX(($wPagina - $wTabla) / 2);
                $pdf->Cell(50, 10, 'Grupo', 1, 0, 'C', true);
                $pdf->Cell(70, 10, 'Alimento', 1, 0, 'C', true);
                $pdf->Cell(50, 10, convert_string("Ración"), 1, 1, 'C', true);
            }
        } // fin while
    }


}

$pdf->Ln();
$pdf->SetFont('Arial', style: 'B', size: 10);
$pdf->SetTextColor(255, 0, 0);
$warning = "Advertncia: Esta información es de carácter académico e informativo. No reemplaza la valoración médica presencial ni debe utilizarse para autodiagnóstico. Ante cualquier síntoma, consulta siempre con un profesional de salud.";
$pdf->MultiCell(0, 6, convert_string($warning));
//Fin de tabla de Guía Alimentaria
$pdf->Ln();
$pdf->SetTextColor(0, 0, 0);
$espacioDisponible = $maxAlturaPagina - $pdf->GetY(); // Altura de página menos la altura acutal de la ubicación
//if ($espacioDisponible >= 88) {
//    $pdf->MultiCell(0, 8, convert_string('    Seguir una guía alimentaria es clave para mantener un equilibrio en la dieta y garantizar una nutrición adecuada. Estas guías ofrecen recomendaciones basadas en evidencia científica, ayudando a prevenir enfermedades y mejorar la calidad de vida. Una alimentación balanceada fortalece el sistema inmunológico, mejora la energía y optimiza funciones corporales esenciales. También contribuye a un mejor rendimiento físico y mental, promoviendo hábitos saludables desde la infancia. Cumplir con las porciones adecuadas evita déficits nutricionales y el consumo excesivo de calorías. Respetar las guías ayuda a reducir riesgos de enfermedades cardiovasculares, diabetes y obesidad. Además, fomenta el consumo variado de alimentos, asegurando la ingesta de vitaminas y minerales esenciales. Facilita la planificación de comidas equilibradas, adaptadas a necesidades personales y preferencias. Promueve la educación alimentaria, aumentando la conciencia sobre la calidad de los alimentos. En definitiva, seguir una guía alimentaria es una inversión en bienestar y longevidad. '), 0, 'J');
//}
//Nombre de Archivo
$pdf->Output('I', 'V-' . $id_card_number . '-' . $name . '--' . $date . ".pdf", isUTF8: true); //Ejemplo de Nombre del archivo: 30524903 - 22/05/2025
