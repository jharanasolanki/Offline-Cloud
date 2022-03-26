<?php
require_once "Classes/PHPExcel.php";
require('fpdf.php');

        $excelReader = PHPExcel_IOFactory::createReaderForFile($_FILES['file']['tmp_name']);
        $excelObj = $excelReader->load($_FILES['file']['tmp_name']);
      //  $path=$_POST['directory'];
	$month=$_POST['foldername'];
        $worksheet = $excelObj->getSheet(3);
        $lastRow = $worksheet->getHighestRow();
       /* $pdf = new FPDF("L","mm","A3"); 
        $pdf->AddPage('L',"A3");
        $pdf->SetXY(25, 25); 
        $pdf->SetFontSize(1);
        $pdf->SetFont('Arial','',1);*/
class ConductPDF extends FPDF {
function vcell($c_width,$c_height,$x_axis,$text){
$w_w=$c_height/3;
$w_w_1=$w_w+2;
$w_w1=$w_w+$w_w+$w_w+3;
$len=strlen($text);// check the length of the cell and splits the text into 7 character each and saves in a array 

$lengthToSplit = 9;
if($len>$lengthToSplit){
$w_text=str_split($text,$lengthToSplit);
$this->SetX($x_axis);
$this->Cell($c_width,$w_w_1,$w_text[0],'','','');
if(isset($w_text[1])) {
    $this->SetX($x_axis);
    $this->Cell($c_width,$w_w1,$w_text[1],'','','');
}
if(isset($w_text[2])) {
    $this->SetX($x_axis);
    $this->Cell($c_width,$w_w1+8,$w_text[2],'','','');
}
$this->SetX($x_axis);
$this->Cell($c_width,$c_height,'','LTRB',0,'L',0);
}
else{
    $this->SetX($x_axis);
    $this->Cell($c_width,$c_height,$text,'LTRB',0,'L',0);}
    }
 }
		mkdir("D:\\IRSS\\COM DO\\commission statement\\$month");
		echo "Your file is saved in D:\\IRSS\\COM DO\\commission statement\\$month";

echo "<table>";
        for ($row = 8; $row <= $lastRow; $row++) {
            $pdf = new ConductPDF();
            $pdf->SetXY(15, 15);
            $pdf->AddPage('L',"A3");
	    //$pdf->AddPage('L');
            $pdf->SetFontSize(12);
            $pdf->SetFont('Arial','',12);
            $p=1;$ans=0;
		$name="";
            if($worksheet->getCell('A'.$row)->getValue()!=null)
            {
                $name=$worksheet->getCell('A'.$row)->getValue();
            }
            else
               {
                $tp=$row+1; 
                }
                $pdf->Write(10,"Agent Name:".$name);
                $pdf->Ln();
		$pdf->Write(10,"Month:".$month);
                $pdf->Ln();
            $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,"Agent",1);
            $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,"Insurance Co.",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,"Product",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,"THE INSURED",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(15,15,$x_axis,"OD",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(15,15,$x_axis,"TP",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,"Net Premium",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,"ST",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,"Total",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,"AGENT Name",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,"Policy_no",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,"Agents pay",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,"agents tds",1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,"agents netpay",1);
             $x_axis=$pdf->getx();
             $pdf->Ln();
             $x_axis=$pdf->getx();
            $pdf->vcell(32,15,$x_axis,$worksheet->getCell('A'.$row)->getValue(),1);
            $x_axis=$pdf->getx();
            $pdf->vcell(32,15,$x_axis,$worksheet->getCell('B'.$row)->getValue());
            $x_axis=$pdf->getx();
            $pdf->vcell(32,15,$x_axis,$worksheet->getCell('E'.$row)->getValue());
            $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,$worksheet->getCell('F'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(15,15,$x_axis,$worksheet->getCell('G'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(15,15,$x_axis,$worksheet->getCell('H'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,$worksheet->getCell('I'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,$worksheet->getCell('J'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,$worksheet->getCell('K'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,$worksheet->getCell('A'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,$worksheet->getCell('L'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,$worksheet->getCell('M'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
              $pdf->vcell(20,15,$x_axis,$worksheet->getCell('N'.$row)->getValue(),1);
              $x_axis=$pdf->getx();
              $pdf->vcell(20,15,$x_axis,$worksheet->getCell('O'.$row)->getValue(),1);
              $ans+=(double)$worksheet->getCell('O'.$row)->getValue();
              $x_axis=$pdf->getx();
             $pdf->Ln();
             $row++;

             while($worksheet->getCell('A'.$row)->getValue()===null&&$row<=$lastRow)
             {
                $tmp=$worksheet->getCell('L'.$row)->getValue();
                if($tmp==null)goto a;
            $x_axis=$pdf->getx();
            $pdf->vcell(32,15,$x_axis,$worksheet->getCell('A'.$row)->getValue(),1);
            $x_axis=$pdf->getx();
            $pdf->vcell(32,15,$x_axis,$worksheet->getCell('B'.$row)->getValue());
            $x_axis=$pdf->getx();
            $pdf->vcell(32,15,$x_axis,$worksheet->getCell('E'.$row)->getValue());
            $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,$worksheet->getCell('F'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(15,15,$x_axis,$worksheet->getCell('G'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(15,15,$x_axis,$worksheet->getCell('H'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,$worksheet->getCell('I'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,$worksheet->getCell('J'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,$worksheet->getCell('K'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,$worksheet->getCell('A'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(32,15,$x_axis,$worksheet->getCell('L'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
             $pdf->vcell(20,15,$x_axis,$worksheet->getCell('M'.$row)->getValue(),1);
             $x_axis=$pdf->getx();
              $pdf->vcell(20,15,$x_axis,$worksheet->getCell('N'.$row)->getValue(),1);
              $x_axis=$pdf->getx();
              $pdf->vcell(20,15,$x_axis,$worksheet->getCell('O'.$row)->getValue(),1);
              $ans+=(double)$worksheet->getCell('O'.$row)->getValue();
              $x_axis=$pdf->getx();
             $pdf->Ln();
             a:
             $row++;
             }
             
             $pdf->Write(10,"Total:".$ans);
             $pdf->Output('F',"D:\\IRSS\\COM DO\\commission statement\\$month\\$name.pdf");
        }
        echo "</table>";
        echo "complete";    

 // send to browser and display


?>