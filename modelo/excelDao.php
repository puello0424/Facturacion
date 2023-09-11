<?php
//include '../vista/plantillaPDF.php';
require 'conexion.php';
require 'Classes/PHPExcel.php';

class ExcelDao extends PHPExcel{

    
    public function crearExcel($id)
    {
        //Se obtienen los datos de la factura
        $stmt = Conexion::conectar()->prepare("SELECT `idFactura`, `firstname`, `lastname`,`phone`, `date`,`total` FROM `informacionfactura` WHERE idFactura=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $factura = $resultado['idFactura'];
        $total = $resultado['total'];
        $fila = 10; //Establecemos en que fila inciara a imprimir los datos

        //$gdImage = imagecreatefrompng('images/logo.png'); //Logotipo

        //Objeto de PHPExcel
        $objPHPExcel  = new PHPExcel();

        //Propiedades de Documento
        $objPHPExcel->getProperties()->setDescription("Informacion Factura $factura");

        //Establecemos la pestaña activa y nombre a la pestaña
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle("Factura$factura");

        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $objDrawing->setName('Logotipo');
        $objDrawing->setDescription('Logotipo');
        //$objDrawing->setImageResource($gdImage);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setHeight(100);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        //Se establece el estilo del titulo
        $estiloTituloReporte = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' => 13
            ),
            'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_NONE
                )
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        //Se establece el estilo del titulo de las columnas
        $estiloTituloColumnas = array(
            'font' => array(
                'name'  => 'Arial',
                'bold'  => true,
                'size' => 10,
                'color' => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '538DD5')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'alignment' =>  array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        //Se establece el estilo de la informacion
        $estiloInformacion = new PHPExcel_Style();
        $estiloInformacion->applyFromArray(array(
            'font' => array(
                'name'  => 'Arial',
                'color' => array(
                    'rgb' => '000000'
                )
            ),
            'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'alignment' =>  array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        ));

        //Se imprimen los datos de la factura
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->setCellValue('A6', 'N°');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->setCellValue('B6', $factura);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->setCellValue('C6', 'FECHA');
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->setCellValue('D6',$resultado['date']);
        //Se imprimen los datos del cliente
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'NOMBRE CLIENTE');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->setCellValue('B7',$resultado['firstname']." ". $resultado['lastname'] );
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->setCellValue('C7', 'TELEFONO');
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->setCellValue('D7', $resultado['phone']);

        //Se asignan los estilos de los titulos
        $objPHPExcel->getActiveSheet()->getStyle('A1:D4')->applyFromArray($estiloTituloReporte);
        $objPHPExcel->getActiveSheet()->getStyle('A9:D9')->applyFromArray($estiloTituloColumnas);
        
        //Se escribe el titulo del PDF
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'INFORMACION DE FACTURA');
        $objPHPExcel->getActiveSheet()->mergeCells('B3:D3');


        //Se imprime el encabezado de los detalles de la factura
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->setCellValue('A9', 'CANT.');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->setCellValue('B9', 'DETALLE');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->setCellValue('C9', 'VR.UNIT.');
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->setCellValue('D9', 'VALOR TOTAL');

        //Se obtienen los detalles de la factura
        $stmt = Conexion::conectar()->prepare("SELECT  `cantidad`, `subtotal`, `name`, `price` FROM `informacionfactura` WHERE idFactura=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();

        //Se imprimen los datos de la factura
        while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $resultado['cantidad']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $resultado['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $resultado['price']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $resultado['subtotal']);
            
            $fila++; //Sumamos 1 para pasar a la siguiente fila
        }
        //Se imprime el total de la factura
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, "TOTAL");
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $total);

        //Se asigna el estilo a la informacion
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A10:D" . $fila);

        //Se crea el Excel
        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        // incluir gráfico
        //$writer->setIncludeCharts(TRUE);

        //Se establece la informacion del Excel
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=factura$factura.xlsx");
        header('Cache-Control: max-age=0');

        
        $stmt = null;
        //Se descarga el EXcel
        $writer->save('php://output');
        

    }

}