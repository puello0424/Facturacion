<?php
//include '../vista/plantillaPDF.php';
require 'conexion.php';
require 'fpdf/fpdf.php';

class PDFDao extends FPDF{

    
    public function crearPDF($id)
    {

        //Se traen los datos de la factura
        $stmt = Conexion::conectar()->prepare("SELECT `idFactura`, `firstname`, `lastname`,`phone`, `date`,`total` FROM `informacionfactura` WHERE idFactura=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        //Se crea un nuevo PDF
        $pdf = new PDFDao();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $factura = $resultado['idFactura'];
        $total = $resultado['total'];

        //Cell(ancho, alto, texto, borde, siguientelinea(0,1,2), alineacion(l,c,r),coloreado,link);
        //Se agregan los datos del cliente al PDF
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 12);
        //Se agregan los datos de la factura al PDF
        $pdf->Cell(50, 6, utf8_decode('FACTURA N°'), 'LTB', 0, 'C', 1);
        $pdf->Cell(50, 6, $resultado['idFactura'], 'RTB', 0, 'L');
        $pdf->Cell(45, 6, 'FECHA', 'LTB', 0, 'C', 1);
        $pdf->Cell(45, 6, $resultado['date'], 'TBR', 1, 'C');
        //Se agregan los datos del cliente al PDF
        $pdf->Cell(50, 6, 'Informacion Cliente', 'LTB', 0, 'C', 1);
        $pdf->Cell(50, 6, utf8_decode( $resultado['firstname'] . " " . $resultado['lastname']), 'TB', 0, 'C');
        $pdf->Cell(45, 6, 'Telefono', 'LTB', 0, 'C', 1);
        $pdf->Cell(45, 6, $resultado['phone'], 'TBR', 1, 'C');
        $pdf->Cell(50, 6, " ", 0, 1, 'C', 0);

        //Encabezado para los detalles de los productos
        $pdf->Cell(20, 6, 'CANT', 1, 0, 'C', 1);
        $pdf->Cell(100, 6, 'DETALLE', 1, 0, 'C', 1);
        $pdf->Cell(35, 6, 'VR.UNIT.', 1, 0, 'C', 1);
        $pdf->Cell(35, 6, 'VALOR TOTAL', 1, 1, 'C', 1);
        
        $pdf->SetFont('Arial', '', 10);

        //Se obtienen la informacion de los detalles de la factura al PDF
        $stmt = Conexion::conectar()->prepare("SELECT  `cantidad`, `subtotal`, `name`, `price` FROM `informacionfactura` WHERE idFactura=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();

        //Se agragan los datos de los detalles al PDF
        while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pdf->Cell(20, 6, $resultado['cantidad'], 1, 0, 'C');
            $pdf->Cell(100, 6, utf8_decode($resultado['name']), 1, 0, 'C');
            $pdf->Cell(35, 6, $resultado['price'], 1, 0, 'C');
            $pdf->Cell(35, 6, $resultado['subtotal'], 1, 1, 'C');
        }
        
        //Se carga el total de la factura
        $pdf->Cell(155, 6, utf8_decode('TOTAL $'), 1, 0, 'R', 1);
        $pdf->Cell(35, 6, $total, 1, 1, 'C');
        $stmt = null;
        //Se asigna el nombre del PDF y se muestra
        $pdf->Output('I',"factura$factura.pdf",TRUE); 

    }

    function Header()
    {
        //Cabecera del PDF
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(30);
        $this->Cell(120, 10, 'Informacion de Factura', 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer()
    {
        //Pie de pagina del PDF
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}