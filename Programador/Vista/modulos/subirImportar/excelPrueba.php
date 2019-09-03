<?php 
 $nomfile = $_GET['ente'];
 //DATOS PARA REGISTRO DE AMBIENTES
 $nombresDeProgramas = $_GET['NombreAmbientesCOD'];
 $IDDeProgramas = $_GET['IDAmbientesCOD'];
 $DECODnombresDeProgramas = json_decode($nombresDeProgramas);
 $DECODIDDeProgramas = json_decode($IDDeProgramas);
 $cantidadProgramas = sizeof($DECODnombresDeProgramas);
 //DATOS PARA REGISTROS DE PROGRAMAS
 $nombresDeCoordinacion = $_GET['NombreCoordinacionCod'];
 $IDDeCoordinacion = $_GET['IDCoordinacionCOD'];
 $Responsable = $_GET['ResponsableCoordinacionCod'];
 $DECODnombresDeCoordinacion = json_decode($nombresDeCoordinacion);
 $DECODIDDeCoordinacion = json_decode($IDDeCoordinacion);
 $DECODResponsable = json_decode($Responsable);
 $cantidadCoordinacion = sizeof($DECODnombresDeCoordinacion);
//DATOS AMBIENTES 
 $nombreAmbietesCOD = $_GET['CodAmbiente'];
 $idAmbieteCOD = $_GET['CodIdAmbiente'];
 $nombreAmbientes = json_decode($nombreAmbietesCOD);
 $IdAmbientes = json_decode($idAmbieteCOD);
//INSTRUCTORES
 $nombreInstructoresCOD = $_GET['CodInstructor'];
 $IdInstructorCOD = $_GET['CodIdInstructor'];
 $nombreInstructores = json_decode($nombreInstructoresCOD);
 $IdInstructor = json_decode($IdInstructorCOD);
 //echo $cantidadProgramas;exit();
//include ("..\..\..\Public\lib\PHPExcel\PHPExcel.php");
require_once __DIR__ . "/PHPExcel/PHPExcel.php";
$objPHPExcel = new PHPExcel();
/*         * **************************** ESTILOS DE LA HOJA   ************************************** */
        $default_style = array(
            'font' => array(
                'name' => 'Verdana',
                'color' => array('rgb' => '000000'),
                'size' => 11
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'AAAAAA')
                )
            )
        );


        $odd_row_style = array(
            'font' => array(
                'name' => 'Verdana',
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'size' => 12
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'CCCCCC')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '444444')
                )
            )
        );


// Establecer propiedades
if ($nomfile == 'Ambiente'){
	 $objhoja1 = $objPHPExcel->createSheet();
	$objPHPExcel->getProperties()
	->setCreator("Ambientes")
	->setLastModifiedBy("Ambientes")
	->setTitle("Documento Excel")
	->setSubject("Documento Excel")
	->setDescription("crear archivos de Excel desde PHP.")
	->setKeywords("Excel Office 2007 php")
	->setCategory("Pruebas de Excel");

	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Nombre')
	->setCellValue('B1', 'Programa');


     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);

	$objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);

     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');

    //AMBIENTES//
            $cont = 3;
            $cantf = sizeof($DECODnombresDeProgramas);


            for ($i = 0; $i < $cantf; $i++) {

                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('L' . $cont, $DECODnombresDeProgramas[$i])
                        ->setCellValue('M' . $cont, $DECODIDDeProgramas[$i]);
                $cont++;
            }
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'ambiente');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setCollapsed(TRUE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);

            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
     	$objPHPExcel->getActiveSheet(0)
                        ->getCell('B' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$L$3:$L$'.($cantidadProgramas+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Z' . $i, '=IFERROR(VLOOKUP(B' . $i . ',Datos!L:M,2,FALSE),"")');
     }
	// indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');

}else if($nomfile == 'Aprendiz'){

		$objhoja1 = $objPHPExcel->createSheet();

    $objPHPExcel->getProperties()
    ->setCreator("Aprendiz")
    ->setLastModifiedBy("Aprendiz")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel")
    ->setDescription("Subir masivo Aprendiz")
    ->setKeywords("Excel Office 2007 php")
    ->setCategory("Pruebas de Excel");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Tipo de documento')
    ->setCellValue('B1', 'Numero de documento')
    ->setCellValue('C1', 'Nombres')
    ->setCellValue('D1', 'Apellidos')
    ->setCellValue('E1', 'Correo')
    ->setCellValue('F1', 'Telefono');


     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);
            $as->getStyle('C1')->applyFromArray($odd_row_style);
            $as->getStyle('D1')->applyFromArray($odd_row_style);
            $as->getStyle('E1')->applyFromArray($odd_row_style);
            $as->getStyle('F1')->applyFromArray($odd_row_style);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setAutoSize(true);

     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');
     $objPHPExcel->getActiveSheet(1)
                    ->setCellValue('A1', 'Tipo de documento')
                    ->setCellValue('A2', 'Cedula ciudadania')
                    ->setCellValue('A3', 'Tarjeta de Identidad')
                    ->setCellValue('A4', 'Cedula extranjeria')
                    ->setCellValue('A5', 'Numero ciego SENA')
                    ->setCellValue('A6', 'Pasaporte')
                    ->setCellValue('A7', 'Documento Nacional De Identificacion')
                    ->setCellValue('A8', 'Numero De Identificacion Tributaria');
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);
    //AMBIENTES//

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'aprendiz');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);

                     /*             * *************** OCULTAMOS LA HOJA DE LOS DATOS   ************************************* */

            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);

            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$A$1:$A$8');

     }

    // indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');

}else if($nomfile == 'Instructor'){

        $objhoja1 = $objPHPExcel->createSheet();

    $objPHPExcel->getProperties()
    ->setCreator("Instructor")
    ->setLastModifiedBy("Instructor")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel")
    ->setDescription("Subir masivo Instructor")
    ->setKeywords("Excel Office 2007 php")
    ->setCategory("Pruebas de Excel");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Tipo de documento')
    ->setCellValue('B1', 'Numero de documento')
    ->setCellValue('C1', 'Nombres')
    ->setCellValue('D1', 'Apellidos')
    ->setCellValue('E1', 'Correo')
    ->setCellValue('F1', 'Telefono');


     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);
            $as->getStyle('C1')->applyFromArray($odd_row_style);
            $as->getStyle('D1')->applyFromArray($odd_row_style);
            $as->getStyle('E1')->applyFromArray($odd_row_style);
            $as->getStyle('F1')->applyFromArray($odd_row_style);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setAutoSize(true);

     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');
     $objPHPExcel->getActiveSheet(1)
                    ->setCellValue('A1', 'Tipo de documento')
                    ->setCellValue('A2', 'Cedula ciudadania')
                    ->setCellValue('A3', 'Tarjeta de Identidad')
                    ->setCellValue('A4', 'Cedula extranjeria')
                    ->setCellValue('A5', 'Numero ciego SENA')
                    ->setCellValue('A6', 'Pasaporte')
                    ->setCellValue('A7', 'Documento Nacional De Identificacion')
                    ->setCellValue('A8', 'Numero De Identificacion Tributaria');
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);
    //AMBIENTES//

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'instructor');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);
            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$A$1:$A$8');

     }

    // indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');

}else if($nomfile == 'Coordinador'){

        $objhoja1 = $objPHPExcel->createSheet();

    $objPHPExcel->getProperties()
    ->setCreator("Coordinador")
    ->setLastModifiedBy("Coordinador")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel")
    ->setDescription("Subir masivo Coordinador")
    ->setKeywords("Excel Office 2007 php")
    ->setCategory("Pruebas de Excel");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Tipo de documento')
    ->setCellValue('B1', 'Numero de documento')
    ->setCellValue('C1', 'Nombres')
    ->setCellValue('D1', 'Apellidos')
    ->setCellValue('E1', 'Correo')
    ->setCellValue('F1', 'Telefono');


     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);
            $as->getStyle('C1')->applyFromArray($odd_row_style);
            $as->getStyle('D1')->applyFromArray($odd_row_style);
            $as->getStyle('E1')->applyFromArray($odd_row_style);
            $as->getStyle('F1')->applyFromArray($odd_row_style);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setAutoSize(true);

     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');
     $objPHPExcel->getActiveSheet(1)
                    ->setCellValue('A1', 'Tipo de documento')
                    ->setCellValue('A2', 'Cedula ciudadania')
                    ->setCellValue('A3', 'Tarjeta de Identidad')
                    ->setCellValue('A4', 'Cedula extranjeria')
                    ->setCellValue('A5', 'Numero ciego SENA')
                    ->setCellValue('A6', 'Pasaporte')
                    ->setCellValue('A7', 'Documento Nacional De Identificacion')
                    ->setCellValue('A8', 'Numero De Identificacion Tributaria');
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);
    //AMBIENTES//

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'Coordinador');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);
            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$A$1:$A$8');

     }

    // indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
}else if($nomfile == 'Programa'){
    $objhoja1 = $objPHPExcel->createSheet();

    $objPHPExcel->getProperties()
    ->setCreator("Programa")
    ->setLastModifiedBy("Programa")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel")
    ->setDescription("crear archivos de Excel desde PHP.")
    ->setKeywords("Excel Office 2007 php")
    ->setCategory("Pruebas de Excel");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Nombre')
    ->setCellValue('B1', 'Coordinacion');


     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);

     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');

    //Programa//
            $cont = 3;
            $cantf = sizeof($DECODnombresDeCoordinacion);
            //$nombreMostrar = "".$DECODnombresDeCoordinacion[$i]." - ".$DECODResponsable[$i];

            for ($i = 0; $i < $cantf; $i++) {
                $nombreMostrar = "".$DECODnombresDeCoordinacion[$i]." - ".$DECODResponsable[$i];
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('L' . $cont, $nombreMostrar)
                        ->setCellValue('M' . $cont, $DECODIDDeCoordinacion[$i]);
                $cont++;
            }
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'Programa');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setCollapsed(TRUE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);
            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('B' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$L$3:$L$'.($cantidadCoordinacion+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Z' . $i, '=IFERROR(VLOOKUP(B' . $i . ',Datos!L:M,2,FALSE),"")');
     }

    // indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');

}else if($nomfile == 'Tic'){
$objhoja1 = $objPHPExcel->createSheet();

    $objPHPExcel->getProperties()
    ->setCreator("Tic")
    ->setLastModifiedBy("Tic")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel")
    ->setDescription("crear archivos de Excel desde PHP.")
    ->setKeywords("Excel Office 2007 php")
    ->setCategory("Pruebas de Excel");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Responsable del elemento')
    ->setCellValue('B1', 'Nombre')
    ->setCellValue('C1', 'Descripcion')
    ->setCellValue('D1', 'Placa')
    ->setCellValue('E1', 'Ambiente')
    ->setCellValue('F1', 'Serial')
    ->setCellValue('G1', 'Precio')
    ->setCellValue('H1', 'Ram')
    ->setCellValue('I1', 'Procesador')
    ->setCellValue('J1', 'Almacenamiento');


     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);
            $as->getStyle('C1')->applyFromArray($odd_row_style);
            $as->getStyle('D1')->applyFromArray($odd_row_style);
            $as->getStyle('E1')->applyFromArray($odd_row_style);
            $as->getStyle('F1')->applyFromArray($odd_row_style);
            $as->getStyle('G1')->applyFromArray($odd_row_style);
            $as->getStyle('H1')->applyFromArray($odd_row_style);
            $as->getStyle('I1')->applyFromArray($odd_row_style);
            $as->getStyle('J1')->applyFromArray($odd_row_style);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setAutoSize(true);
   $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('I')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('J')
                    ->setAutoSize(true);

     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');

    //Tic//
            $cont = 3;
            $contA = 3;
            $cantf = sizeof($nombreInstructores);
            $cantfA = sizeof($nombreAmbientes);
            //$nombreMostrar = "".$DECODnombresDeCoordinacion[$i]." - ".$DECODResponsable[$i];

            for ($i = 0; $i < $cantf; $i++) {
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('L' . $cont, $nombreInstructores[$i])
                        ->setCellValue('M' . $cont, $IdInstructor[$i]);
                $cont++;
            }

            for ($i = 0; $i < $cantfA; $i++) {
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('H' . $contA, $nombreAmbientes[$i])
                        ->setCellValue('I' . $contA, $IdAmbientes[$i]);
                $contA++;
            }
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'Tic');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setCollapsed(TRUE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);
            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$L$3:$L$'.($cantf+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Z' . $i, '=IFERROR(VLOOKUP(A' . $i . ',Datos!L:M,2,FALSE),"")');
     }

     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('E' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$H$3:$H$'.($cantfA+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Y' . $i, '=IFERROR(VLOOKUP(E' . $i . ',Datos!H:I,2,FALSE),"")');
     }

    // indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
}else if($nomfile == 'Herramientas'){
    $objhoja1 = $objPHPExcel->createSheet();

    $objPHPExcel->getProperties()
    ->setCreator("Herramienta")
    ->setLastModifiedBy("Herramienta")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel")
    ->setDescription("crear archivos de Excel desde PHP.")
    ->setKeywords("Excel Office 2007 php")
    ->setCategory("Pruebas de Excel");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Responsable del elemento')
    ->setCellValue('B1', 'Nombre')
    ->setCellValue('C1', 'Descripcion')
    ->setCellValue('D1', 'Placa')
    ->setCellValue('E1', 'Ambiente')
    ->setCellValue('F1', 'Serial')
    ->setCellValue('G1', 'Precio');



     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);
            $as->getStyle('C1')->applyFromArray($odd_row_style);
            $as->getStyle('D1')->applyFromArray($odd_row_style);
            $as->getStyle('E1')->applyFromArray($odd_row_style);
            $as->getStyle('F1')->applyFromArray($odd_row_style);
            $as->getStyle('G1')->applyFromArray($odd_row_style);


    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setAutoSize(true);
   $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setAutoSize(true);


     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');

    //Herramienta//
            $cont = 3;
            $contA = 3;
            $cantf = sizeof($nombreInstructores);
            $cantfA = sizeof($nombreAmbientes);
            //$nombreMostrar = "".$DECODnombresDeCoordinacion[$i]." - ".$DECODResponsable[$i];

            for ($i = 0; $i < $cantf; $i++) {
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('L' . $cont, $nombreInstructores[$i])
                        ->setCellValue('M' . $cont, $IdInstructor[$i]);
                $cont++;
            }

            for ($i = 0; $i < $cantfA; $i++) {
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('H' . $contA, $nombreAmbientes[$i])
                        ->setCellValue('I' . $contA, $IdAmbientes[$i]);
                $contA++;
            }
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'Herramienta');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setCollapsed(TRUE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);
            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$L$3:$L$'.($cantf+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Z' . $i, '=IFERROR(VLOOKUP(A' . $i . ',Datos!L:M,2,FALSE),"")');
     }

     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('E' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$H$3:$H$'.($cantfA+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Y' . $i, '=IFERROR(VLOOKUP(E' . $i . ',Datos!H:I,2,FALSE),"")');
     }

    // indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
}else if($nomfile == 'Equipos de laboratorio'){
$objhoja1 = $objPHPExcel->createSheet();

    $objPHPExcel->getProperties()
    ->setCreator("Laboratorio")
    ->setLastModifiedBy("Laboratorio")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel")
    ->setDescription("crear archivos de Excel desde PHP.")
    ->setKeywords("Excel Office 2007 php")
    ->setCategory("Pruebas de Excel");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Responsable del elemento')
    ->setCellValue('B1', 'Nombre')
    ->setCellValue('C1', 'Descripcion')
    ->setCellValue('D1', 'Placa')
    ->setCellValue('E1', 'Ambiente')
    ->setCellValue('F1', 'Serial')
    ->setCellValue('G1', 'Precio');



     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);
            $as->getStyle('C1')->applyFromArray($odd_row_style);
            $as->getStyle('D1')->applyFromArray($odd_row_style);
            $as->getStyle('E1')->applyFromArray($odd_row_style);
            $as->getStyle('F1')->applyFromArray($odd_row_style);
            $as->getStyle('G1')->applyFromArray($odd_row_style);


    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setAutoSize(true);
   $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setAutoSize(true);


     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');

    //Laboratorio//
            $cont = 3;
            $contA = 3;
            $cantf = sizeof($nombreInstructores);
            $cantfA = sizeof($nombreAmbientes);
            //$nombreMostrar = "".$DECODnombresDeCoordinacion[$i]." - ".$DECODResponsable[$i];

            for ($i = 0; $i < $cantf; $i++) {
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('L' . $cont, $nombreInstructores[$i])
                        ->setCellValue('M' . $cont, $IdInstructor[$i]);
                $cont++;
            }

            for ($i = 0; $i < $cantfA; $i++) {
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('H' . $contA, $nombreAmbientes[$i])
                        ->setCellValue('I' . $contA, $IdAmbientes[$i]);
                $contA++;
            }
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'Laboratorio');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setCollapsed(TRUE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);
            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$L$3:$L$'.($cantf+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Z' . $i, '=IFERROR(VLOOKUP(A' . $i . ',Datos!L:M,2,FALSE),"")');
     }

     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('E' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$H$3:$H$'.($cantfA+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Y' . $i, '=IFERROR(VLOOKUP(E' . $i . ',Datos!H:I,2,FALSE),"")');
     }

    // indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
}else if($nomfile == 'Muebles'){
    $objhoja1 = $objPHPExcel->createSheet();

    $objPHPExcel->getProperties()
    ->setCreator("Muebles")
    ->setLastModifiedBy("Muebles")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel")
    ->setDescription("crear archivos de Excel desde PHP.")
    ->setKeywords("Excel Office 2007 php")
    ->setCategory("Pruebas de Excel");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Responsable del elemento')
    ->setCellValue('B1', 'Nombre')
    ->setCellValue('C1', 'Descripcion')
    ->setCellValue('D1', 'Placa')
    ->setCellValue('E1', 'Ambiente')
    ->setCellValue('F1', 'Serial')
    ->setCellValue('G1', 'Precio')
    ->setCellValue('H1', 'Peso')
    ->setCellValue('I1', 'Ancho')
    ->setCellValue('J1', 'Alto')
    ->setCellValue('K1', 'Largo');


     $as = $objPHPExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('B1')->applyFromArray($odd_row_style);
            $as->getStyle('C1')->applyFromArray($odd_row_style);
            $as->getStyle('D1')->applyFromArray($odd_row_style);
            $as->getStyle('E1')->applyFromArray($odd_row_style);
            $as->getStyle('F1')->applyFromArray($odd_row_style);
            $as->getStyle('G1')->applyFromArray($odd_row_style);
            $as->getStyle('H1')->applyFromArray($odd_row_style);
            $as->getStyle('I1')->applyFromArray($odd_row_style);
            $as->getStyle('J1')->applyFromArray($odd_row_style);
            $as->getStyle('K1')->applyFromArray($odd_row_style);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);

    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setAutoSize(true);
   $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('I')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('J')
                    ->setAutoSize(true);
    $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('K')
                    ->setAutoSize(true);

     $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Formato');

     $objPHPExcel->setActiveSheetIndex(1);
     $objPHPExcel->getActiveSheet()->setTitle('Datos');

    //Muebles//
            $cont = 3;
            $contA = 3;
            $cantf = sizeof($nombreInstructores);
            $cantfA = sizeof($nombreAmbientes);
            //$nombreMostrar = "".$DECODnombresDeCoordinacion[$i]." - ".$DECODResponsable[$i];

            for ($i = 0; $i < $cantf; $i++) {
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('L' . $cont, $nombreInstructores[$i])
                        ->setCellValue('M' . $cont, $IdInstructor[$i]);
                $cont++;
            }

            for ($i = 0; $i < $cantfA; $i++) {
                $objPHPExcel->getActiveSheet(1)
                        ->setCellValue('H' . $contA, $nombreAmbientes[$i])
                        ->setCellValue('I' . $contA, $IdAmbientes[$i]);
                $contA++;
            }
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'Muebles');
            // OCULTAMOS LAS CELDAS NECESARIAS
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setCollapsed(TRUE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);
            $objPHPExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
            // FIN DE OCULTO
     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$L$3:$L$'.($cantf+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Z' . $i, '=IFERROR(VLOOKUP(A' . $i . ',Datos!L:M,2,FALSE),"")');
     }

     for ($i = 2; $i <= 250; $i++) {
        $objPHPExcel->getActiveSheet(0)
                        ->getCell('E' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$H$3:$H$'.($cantfA+2).'');
                        //ambiente
                $objPHPExcel->getActiveSheet(0)
                        ->setCellValue('Y' . $i, '=IFERROR(VLOOKUP(E' . $i . ',Datos!H:I,2,FALSE),"")');
     }

    // indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nomfile.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
}else{

}

 ?>