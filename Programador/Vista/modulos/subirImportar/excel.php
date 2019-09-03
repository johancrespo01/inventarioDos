<?php

if ($_GET['ente']) {
     $nomfile = $_GET['ente'];
     $ruta = '..\..\..\Public\lib\PHPExcel\PHPExcel.php';
    // $nombresE = $_GET['NombreE'];
    // $IDEm = $_GET['IDEm'];
    // $nombresN = $_GET['nombreNivel'];
    // $idNiveles = $_GET['idNivel'];
    // $nomEmCode = json_decode($nombresE);
    // $idEmCode = json_decode($IDEm);
    // $nomNiveles = json_decode($nombresN);
    // $idNiveles = json_decode($idNiveles);
    if (is_readable($ruta)) {
        // Create new PHPExcel object
        require_once $ruta;
        $objPhpExcel = new PHPExcel(); // aqui se intancia la libreria de excel
        /*         * ***********************CREACION DE HOJAS*************************** */



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








        /*         * *******************  Aprendiz  ***************************** */
        if ($nomfile == 'Ambiente') {

            /*             * *******************PROPIEDADES***************************** */
            //la hoja con index 0 se crea por defecto
            $objhoja1 = $objPhpExcel->createSheet();
            //$objPhpExcel->setActiveSheetIndex(1);
            //asignando Propiedades al libro de Excel
            $objPhpExcel->getProperties()->setCreator("Inventario Sena") //Nombre del autor
                    ->setLastModifiedBy("Inventario Sena")//ultimo usuario que modifico el libro
                    ->setTitle("Formato subir Masivo"); //titulo del libro

            $tituloColumnas = array('Nombre', 'Programa');
            /*             * ************************************************************* */



            /*             * **********************ATRIBUTOS DE LA HOJA 1 ************************ */
            //primero creamos esta hoja que va a contener el combo

            $objPhpExcel->setActiveSheetIndex(1);
            $objPhpExcel->getActiveSheet()->setTitle('Datos');
            $objPhpExcel->getActiveSheet(1)
                    ->setCellValue('A1', 'Datos Aprendiz')
                    ->setCellValue('A2', 'Tipo de documento')
                    ->setCellValue('A3', 'Cedula ciudadania')
                    ->setCellValue('A4', 'Tarjeta de Identidad')
                    ->setCellValue('A5', 'Cedula extranjeria')
                    ->setCellValue('A6', 'Numero ciego SENA')
                    ->setCellValue('A7', 'Pasaporte')
                    ->setCellValue('A8', 'Documento Nacional De Identificacion')
                    ->setCellValue('A9', 'Numero De Identificacion Tributaria')
                    ->setCellValue('H2', 'Nombre Empresa')
                    ->mergeCells('L1:M1')
                    ->setCellValue('L1', 'Datos Nivel')
                    ->setCellValue('L2', 'Nombre Nivel')
                    ->setCellValue('M2', 'Id Nivel')
                    ->setCellValue('I2', 'ID Empresa')
                    ->mergeCells('H1:I1')
                    ->setCellValue('H1', 'Datos Empresa');
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setAutoSize(true);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('I')
                    ->setAutoSize(true);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('L')
                    ->setAutoSize(true);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('M')
                    ->setAutoSize(true);


            $as = $objPhpExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);
            $as->getStyle('A2')->applyFromArray($odd_row_style);
            $as->getStyle('H2')->applyFromArray($odd_row_style);
            $as->getStyle('I2')->applyFromArray($odd_row_style);
            $as->getStyle('H1')->applyFromArray($odd_row_style);
            $as->getStyle('L1')->applyFromArray($odd_row_style);
            $as->getStyle('L2')->applyFromArray($odd_row_style);
            $as->getStyle('M2')->applyFromArray($odd_row_style);
            $c = 3;
            $cantf = sizeof($nomEmCode);

            for ($i = 0; $i < $cantf; $i++) {

                //print_r($nomEmCode[$i]);
                //echo $nomEmCode[$i];

                $objPhpExcel->getActiveSheet(1)
                        ->setCellValue('H' . $c, '$nomEmCode[$i]')
                        ->setCellValue('I' . $c, '$idEmCode[$i]');
                $c++;
            }

            //NIVELES//

            $cont = 3;
            $cantf = sizeof($nomNiveles);

            for ($i = 0; $i < $cantf; $i++) {

                $objPhpExcel->getActiveSheet(1)
                        ->setCellValue('L' . $cont, '$nomNiveles[$i]')
                        ->setCellValue('M' . $cont, '$idNiveles[$i]');
                $cont++;
            }

            //  exit();
            //INTENTANDO HACER LA VALIDACION DE TIPO LIST

            /*             * ******************************* OCULTAMOS LA HOJA DE LOS DATOS   ************************************* */
           $objPhpExcel->getSheetByName('Datos') 
                ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN); 
            /*             * **********************ATRIBUTOS DE LA HOJA 0************************ */
            $objPhpExcel->setActiveSheetIndex(0);
            $objPhpExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'aprendiz');
            $titulo = 0;
            for ($i = 'A'; $i <= 'H'; $i++) {
                $objPhpExcel->getActiveSheet(0) // se indica que hoja se va activar
                        ->setCellValue($i . '1', $tituloColumnas[$titulo]); //asignacion del valor de la celda
                $objPhpExcel->getActiveSheet()
                        ->getColumnDimension($i)
                        ->setAutoSize(true);
                $as = $objPhpExcel->getActiveSheet();
                $as->setShowGridlines(true);
                $as->getDefaultStyle()->applyFromArray($default_style);
                $as->getStyle('A1:H1')->applyFromArray($odd_row_style);
                $titulo++;
            }
            /* $objPhpExcel->getActiveSheet()
              ->getColumnDimension('H')->setOutlineLevel(1); */
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setVisible(FALSE);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('Z')->setCollapsed(TRUE);
            /*             * *************************** */
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);

            /**********************/
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('AB')->setVisible(FALSE);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('AB')->setCollapsed(TRUE);
            //se le asigna el nombre a la hoja
            $objPhpExcel->getActiveSheet()->setTitle('FormatoAprendiz');
            /*             * ******************************************************************** */

            for ($i = 2; $i <= 250; $i++) {
                $objPhpExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$A$3:$A$9');

                //lista empresas
                $objPhpExcel->getActiveSheet(0)
                        ->getCell('G' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$H$3:$H$1004');

                //lista Niveles
                $objPhpExcel->getActiveSheet(0)
                        ->getCell('H' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$L$3:$L$1004');

                //empresa
                $objPhpExcel->getActiveSheet(0)
                        ->setCellValue('Z' . $i, '=IFERROR(VLOOKUP(G' . $i . ',Datos!H:I,2,FALSE),"")');
                //nivel
                 $objPhpExcel->getActiveSheet(0)
                        ->setCellValue('AB' . $i, '=IFERROR(VLOOKUP(H' . $i . ',Datos!L:M,2,FALSE),"")');
            }

            //se activa la hoja para que se muestre al abrir el documento
            $objPhpExcel->setActiveSheetIndex(0);
            /*             * ****************ESTABLECIENDO ENCABEZADO0S Y GENERANDO LA DESCARGA************* */
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="' . $nomfile . '.xlsx"');
            header('Cache-Control: max-age=0');
            //$objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
            //$objWriter->save('php://output');

            $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2006');
            $objWriter->setIncludeCharts(TRUE);
            $objWriter->setPreCalculateFormulas(FALSE);
            $objWriter->save('php://output');

            exit;




            /*             * **********************************  INSTRUCTOR  ********************************** */
        } else if ($nomfile == 'Instructor') {

            $objPhpExcel->getProperties()->setCreator("Welcome BAQ") //Nombre del autor
                    ->setLastModifiedBy("Welcome BAQ")//ultimo usuario que modifico el libro
                    ->setTitle("Formato subir Masivo"); //titulo del libro

            $tituloColumnas = array('Tipo de Documento', 'Numero de Documento', 'Nombre', 'Apellido', 'Correo', 'Telefono');

            $objhoja1 = $objPhpExcel->createSheet();

            /*             * **********************ATRIBUTOS DE LA HOJA 1 ************************ */
            //primero creamos esta hoja que va a contener el combo
            $objPhpExcel->setActiveSheetIndex(1);
            $objPhpExcel->getActiveSheet()->setTitle('Datos');
            $objPhpExcel->getActiveSheet(1)
                    ->setCellValue('A1', 'Tipo de documento')
                    ->setCellValue('A2', 'Cedula ciudadania')
                    ->setCellValue('A3', 'Tarjeta de Identidad')
                    ->setCellValue('A4', 'Cedula extranjeria')
                    ->setCellValue('A5', 'Numero ciego SENA')
                    ->setCellValue('A6', 'Pasaporte')
                    ->setCellValue('A7', 'Documento Nacional De Identificacion')
                    ->setCellValue('A8', 'Numero De Identificacion Tributaria');

            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setAutoSize(true);


            $as = $objPhpExcel->getActiveSheet();
            $as->setShowGridlines(true);
            $as->getDefaultStyle()->applyFromArray($default_style);
            $as->getStyle('A1')->applyFromArray($odd_row_style);

            /*             * *************** OCULTAMOS LA HOJA DE LOS DATOS   ************************************* */

            $objPhpExcel->getSheetByName('Datos')
                    ->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);


            /*             * ************************************************************************ */

            $objPhpExcel->setActiveSheetIndex(0);
            $titulo = 0;

            $objPhpExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'instructor');

            for ($i = 'A'; $i <= 'F'; $i++) {
                $objPhpExcel->getActiveSheet(0) // se indica que hoja se va activar
                        ->setCellValue($i . '1', $tituloColumnas[$titulo]); //asignacion del valor de la celda
                $objPhpExcel->getActiveSheet()
                        ->getColumnDimension($i)
                        ->setAutoSize(true);
                $as = $objPhpExcel->getActiveSheet();
                $as->setShowGridlines(true);
                $as->getDefaultStyle()->applyFromArray($default_style);
                $as->getStyle('A1:F1')->applyFromArray($odd_row_style);
                $titulo++;
            }
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);


            $objPhpExcel->getActiveSheet()->setTitle('FormatoInstructor');

            for ($i = 2; $i <= 250; $i++) {
                $objPhpExcel->getActiveSheet(0)
                        ->getCell('A' . $i)->getDataValidation()
                        ->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowDropDown(true)
                        ->setPromptTitle('-----')
                        ->setErrorTitle('Input error')
                        ->setError('Valor No esta en la lista')
                        ->setFormula1('=Datos!$A$3:$A$9');
            }


            /*             * ****************ESTABLECIENDO ENCABEZADO0S Y GENERANDO LA DESCARGA************* */
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="' . $nomfile . '.xlsx"');
            header('Cache-Control: max-age=0');
            //$objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
            //$objWriter->save('php://output');

            $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
            $objWriter->setIncludeCharts(TRUE);
            $objWriter->setPreCalculateFormulas(FALSE);
            $objWriter->save('php://output');
            exit;



            /*             * ********************************    EMPRESA  ************************************ */
        } else if ($nomfile == 'Empresa') {

            //asignando Propiedades al libro de Excel
            $objPhpExcel->getProperties()->setCreator("Welcome BAQ") //Nombre del autor
                    ->setLastModifiedBy("Welcome BAQ")//ultimo usuario que modifico el libro
                    ->setTitle("Formato subir Masivo"); //titulo del libro

            $tituloColumnas = array('Nombre', 'Direccion', 'Nombre Contacto', 'Apellido Contacto', 'Correo Contacto', 'Telefono Contacto');

            $titulo = 0;
            $objPhpExcel->getActiveSheet(0)
                    ->setCellValue('AA1', 'empresa');
            for ($i = 'A'; $i <= 'F'; $i++) {
                $objPhpExcel->getActiveSheet(0) // se indica que hoja se va activar
                        ->setCellValue($i . '1', $tituloColumnas[$titulo]); //asignacion del valor de la celda
                $objPhpExcel->getActiveSheet()
                        ->getColumnDimension($i)
                        ->setAutoSize(true);
                $as = $objPhpExcel->getActiveSheet();
                $as->setShowGridlines(true);
                $as->getDefaultStyle()->applyFromArray($default_style);
                $as->getStyle('A1:F1')->applyFromArray($odd_row_style);

                $titulo++;
            }
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setVisible(FALSE);
            $objPhpExcel->getActiveSheet()
                    ->getColumnDimension('AA')->setCollapsed(TRUE);

            $objPhpExcel->getActiveSheet()->setTitle('FormatoEmpresa');
            /*             * ****************ESTABLECIENDO ENCABEZADO0S Y GENERANDO LA DESCARGA************* */
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="' . $nomfile . '.xlsx"');
            header('Cache-Control: max-age=0');
            //$objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
            //$objWriter->save('php://output');

            $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
            $objWriter->setIncludeCharts(TRUE);
            $objWriter->setPreCalculateFormulas(FALSE);
            $objWriter->save('php://output');
            exit;
        } else {
            echo "<script>alert('Error al descargar archivo');</script>";
        }
    }
}