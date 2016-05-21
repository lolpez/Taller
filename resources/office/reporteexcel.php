<?php

  function cellColor($cells,$color){
        global $objPHPExcel;
        $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
        ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
        'borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
        'font' => array('bold'=>true,'color'=>array('rgb'=>'FFFFFF')),
        'startcolor' => array('rgb' => $color)
        ));
    }

  $conexion = new mysqli('localhost','root','','epsas',3306);
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
	$consulta = "select m.nombre as matriz,p.nombre,p.metodo,p.tecnica,p.unidades,p.limite_max,p.limite_min from parametro p,matriz m where p.estado=1 and p.matriz=m.pkmatriz and p.fkarea=1;";
	$resultado = $conexion->query($consulta);
	if($resultado->num_rows > 0 ){
						
		date_default_timezone_set('America/La_Paz');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

    $styleArray = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
    );

    $objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Aquino") //Autor
							 ->setLastModifiedBy("Aquino") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte Para Epsas")
							 ->setKeywords("Reporte de Epsas")
							 ->setCategory("Reporte excel");

		$tituloReporte = "LABORATORIO CENTRAL";
		$titulosColumnas = array('N*', 'Matriz','Parametro', 'Metodo de Ensayo', 'Tecnica Analitica','Unidades de Reporte','Rango de Trabajo');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('D1:F1');
						
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $logo = '../img/logo.png'; // Provide path to your logo file
    $objDrawing->setPath($logo);  //setOffsetY has no effect
    $objDrawing->setCoordinates('A1');
    $objDrawing->setWidthAndHeight(220,110);
    $objDrawing->setResizeProportional(true);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(0)); 
    
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D3:J3');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3',"OFERTA DE SERVICIOS DE ENSAYO LABORATORIO CENTRAL EPSAS");
    $objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setSize(22);
    $objPHPExcel->getActiveSheet()->getStyle('D3:J3')->getFont()->setBold(true);


    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A5:B5');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5',"AREA");
    $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getFont()->setBold(true);

    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C5:D5');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5',"FISICOQUIMICA");
    $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle('C5:D5')->getFont()->setBold(true);
    
    cellColor('A7', '4682B4');
    cellColor('B7', '4682B4');
    cellColor('C7', '4682B4');
    cellColor('D7', '4682B4');
    cellColor('E7', '4682B4');
    cellColor('F7', '4682B4');
    cellColor('G7', '4682B4');

		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('D1',$tituloReporte)
        		    ->setCellValue('A7',  $titulosColumnas[0])
		            ->setCellValue('B7',  $titulosColumnas[1])
        		    ->setCellValue('C7',  $titulosColumnas[2])
        		    ->setCellValue('D7',  $titulosColumnas[3])
        		    ->setCellValue('E7',  $titulosColumnas[4])
        		    ->setCellValue('F7',  $titulosColumnas[5])
            		->setCellValue('G7',  $titulosColumnas[6]);
		
		//Se agregan los datos de los alumnos
		$i = 8;
    $j=1;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $j)
		            ->setCellValue('B'.$i,  $fila['matriz'])
        		    ->setCellValue('C'.$i,  $fila['nombre'])
        		    ->setCellValue('D'.$i,  $fila['metodo'])
        		    ->setCellValue('E'.$i,  $fila['tecnica'])
        		    ->setCellValue('F'.$i,  $fila['unidades'])
            		->setCellValue('G'.$i,  "De ".$fila['limite_min']." a ".$fila['limite_max']);
					$i++;
          $j++;
		}

		$objPHPExcel->getActiveSheet()->getStyle('D1:G1')->getFont()->setSize(20);
    $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setSize(25);
    $objPHPExcel->getActiveSheet()->getStyle('D1:G1')->getFont()->setBold(true); 
		//$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
		//$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);		
		//$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));
				
		for($i = 'A'; $i <= 'G'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('FISICOQUIMICA');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		$objPHPExcel->createSheet(1);//creamos la pestaña

    $consulta1 = "select m.nombre as matriz,p.nombre,p.metodo,p.tecnica,p.unidades,p.limite_max,p.limite_min from parametro p,matriz m where p.estado=1 and p.matriz=m.pkmatriz and p.fkarea=2;";
    $resultado1 = $conexion->query($consulta1);

    $tituloReporte1 = "LABORATORIO CENTRAL";
    $titulosColumnas1 = array('N*', 'Matriz','Parametro', 'Metodo de Ensayo', 'Tecnica Analitica','Unidades de Reporte','Rango de Trabajo');

		$objPHPExcel->setActiveSheetIndex(1)
        		    ->mergeCells('D1:F1');
		
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $logo = '../img/logo.png'; // Provide path to your logo file
    $objDrawing->setPath($logo);  //setOffsetY has no effect
    $objDrawing->setCoordinates('A1');
    $objDrawing->setWidthAndHeight(220,110);
    $objDrawing->setResizeProportional(true);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(1)); 

    $objPHPExcel->setActiveSheetIndex(1)->mergeCells('D3:J3');
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3',"OFERTA DE SERVICIOS DE ENSAYO LABORATORIO CENTRAL EPSAS");
    $objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setSize(22);
    $objPHPExcel->getActiveSheet()->getStyle('D3:J3')->getFont()->setBold(true);


    $objPHPExcel->setActiveSheetIndex(1)->mergeCells('A5:B5');
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A5',"AREA");
    $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getFont()->setBold(true);

    $objPHPExcel->setActiveSheetIndex(1)->mergeCells('C5:D5');
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C5',"METALES PESADOS");
    $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle('C5:D5')->getFont()->setBold(true);

    cellColor('A7', '4682B4');
    cellColor('B7', '4682B4');
    cellColor('C7', '4682B4');
    cellColor('D7', '4682B4');
    cellColor('E7', '4682B4');
    cellColor('F7', '4682B4');
    cellColor('G7', '4682B4');
    
		// Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(1)
          ->setCellValue('D1',$tituloReporte1)
                ->setCellValue('A7',  $titulosColumnas1[0])
                ->setCellValue('B7',  $titulosColumnas1[1])
                ->setCellValue('C7',  $titulosColumnas1[2])
                ->setCellValue('D7',  $titulosColumnas1[3])
                ->setCellValue('E7',  $titulosColumnas1[4])
                ->setCellValue('F7',  $titulosColumnas1[5])
                ->setCellValue('G7',  $titulosColumnas1[6]);
    
    //Se agregan los datos de los alumnos
    $i = 8;
    $k=1;
    while ($fila = $resultado1->fetch_array()) {
      $objPHPExcel->setActiveSheetIndex(1)
                ->setCellValue('A'.$i,  $k)
                ->setCellValue('B'.$i,  $fila['matriz'])
                ->setCellValue('C'.$i,  $fila['nombre'])
                ->setCellValue('D'.$i,  $fila['metodo'])
                ->setCellValue('E'.$i,  $fila['tecnica'])
                ->setCellValue('F'.$i,  $fila['unidades'])
                ->setCellValue('G'.$i,  "De ".$fila['limite_min']." a ".$fila['limite_max']);
          $i++;
          $k++;
    }
		
    $objPHPExcel->getActiveSheet()->getStyle('D1:G1')->getFont()->setSize(20);
    $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setSize(25);
    $objPHPExcel->getActiveSheet()->getStyle('D1:G1')->getFont()->setBold(true);
		//$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
		//$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($estiloTituloColumnas);		
		//$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:D".($i-1));
				
		for($i = 'A'; $i <= 'G'; $i++){
			$objPHPExcel->setActiveSheetIndex(1)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('METALES PESADOS');

//////NUEVA HOJA///////

    $objPHPExcel->createSheet(2);//creamos la pestaña

    $consulta2 = "select m.nombre as matriz,p.nombre,p.metodo,p.tecnica,p.unidades,p.limite_max,p.limite_min from parametro p,matriz m where p.estado=1 and p.matriz=m.pkmatriz and p.fkarea=3;";
    $resultado2 = $conexion->query($consulta2);

    $tituloReporte2 = "LABORATORIO CENTRAL";
    $titulosColumnas2 = array('N*', 'Matriz','Parametro', 'Metodo de Ensayo', 'Tecnica Analitica','Unidades de Reporte','Rango de Trabajo');

    $objPHPExcel->setActiveSheetIndex(2)
                ->mergeCells('D1:F1');
    
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $logo = '../img/logo.png'; // Provide path to your logo file
    $objDrawing->setPath($logo);  //setOffsetY has no effect
    $objDrawing->setCoordinates('A1');
    $objDrawing->setWidthAndHeight(220,110);
    $objDrawing->setResizeProportional(true);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(2)); 

    $objPHPExcel->setActiveSheetIndex(2)->mergeCells('D3:J3');
    $objPHPExcel->setActiveSheetIndex(2)->setCellValue('D3',"OFERTA DE SERVICIOS DE ENSAYO LABORATORIO CENTRAL EPSAS");
    $objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setSize(22);
    $objPHPExcel->getActiveSheet()->getStyle('D3:J3')->getFont()->setBold(true);


    $objPHPExcel->setActiveSheetIndex(2)->mergeCells('A5:B5');
    $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A5',"AREA");
    $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getFont()->setBold(true);

    $objPHPExcel->setActiveSheetIndex(2)->mergeCells('C5:D5');
    $objPHPExcel->setActiveSheetIndex(2)->setCellValue('C5',"MICROBIOLOGIA");
    $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle('C5:D5')->getFont()->setBold(true);

    cellColor('A7', '4682B4');
    cellColor('B7', '4682B4');
    cellColor('C7', '4682B4');
    cellColor('D7', '4682B4');
    cellColor('E7', '4682B4');
    cellColor('F7', '4682B4');
    cellColor('G7', '4682B4');

    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(2)
          ->setCellValue('D1',$tituloReporte2)
                ->setCellValue('A7',  $titulosColumnas2[0])
                ->setCellValue('B7',  $titulosColumnas2[1])
                ->setCellValue('C7',  $titulosColumnas2[2])
                ->setCellValue('D7',  $titulosColumnas2[3])
                ->setCellValue('E7',  $titulosColumnas2[4])
                ->setCellValue('F7',  $titulosColumnas2[5])
                ->setCellValue('G7',  $titulosColumnas2[6]);
    
    //Se agregan los datos de los alumnos
    $i = 8;
    $k=1;
    while ($fila = $resultado2->fetch_array()) {
      $objPHPExcel->setActiveSheetIndex(2)
                ->setCellValue('A'.$i,  $k)
                ->setCellValue('B'.$i,  $fila['matriz'])
                ->setCellValue('C'.$i,  $fila['nombre'])
                ->setCellValue('D'.$i,  $fila['metodo'])
                ->setCellValue('E'.$i,  $fila['tecnica'])
                ->setCellValue('F'.$i,  $fila['unidades'])
                ->setCellValue('G'.$i,  "De ".$fila['limite_min']." a ".$fila['limite_max']);
          $i++;
          $k++;
    }
    
    $objPHPExcel->getActiveSheet()->getStyle('D1:G1')->getFont()->setSize(20);
    $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setSize(25);
    $objPHPExcel->getActiveSheet()->getStyle('D1:G1')->getFont()->setBold(true);
    //$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
    //$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($estiloTituloColumnas);   
    //$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:D".($i-1));
        
    for($i = 'A'; $i <= 'G'; $i++){
      $objPHPExcel->setActiveSheetIndex(2)      
        ->getColumnDimension($i)->setAutoSize(TRUE);
    }
    
    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('MICROBIOLOGIA');

    ///NUEVA HOJA///

    $objPHPExcel->createSheet(3);//creamos la pestaña

    $consulta3 = "select m.nombre as matriz,p.nombre,p.metodo,p.tecnica,p.unidades,p.limite_max,p.limite_min from parametro p,matriz m where p.estado=1 and p.matriz=m.pkmatriz and p.fkarea=4;";
    $resultado3 = $conexion->query($consulta3);

    $tituloReporte3 = "LABORATORIO CENTRAL";
    $titulosColumnas3 = array('N*', 'Matriz','Parametro', 'Metodo de Ensayo', 'Tecnica Analitica','Unidades de Reporte','Rango de Trabajo');

    $objPHPExcel->setActiveSheetIndex(3)
                ->mergeCells('D1:F1');
    
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $logo = '../img/logo.png'; // Provide path to your logo file
    $objDrawing->setPath($logo);  //setOffsetY has no effect
    $objDrawing->setCoordinates('A1');
    $objDrawing->setWidthAndHeight(220,110);
    $objDrawing->setResizeProportional(true);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(3)); 
    
    $objPHPExcel->setActiveSheetIndex(3)->mergeCells('D3:J3');
    $objPHPExcel->setActiveSheetIndex(3)->setCellValue('D3',"OFERTA DE SERVICIOS DE ENSAYO LABORATORIO CENTRAL EPSAS");
    $objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setSize(22);
    $objPHPExcel->getActiveSheet()->getStyle('D3:J3')->getFont()->setBold(true);


    $objPHPExcel->setActiveSheetIndex(3)->mergeCells('A5:B5');
    $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A5',"AREA");
    $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getFont()->setBold(true);

    $objPHPExcel->setActiveSheetIndex(3)->mergeCells('C5:D5');
    $objPHPExcel->setActiveSheetIndex(3)->setCellValue('C5',"AGUA RESIDUAL");
    $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(18);
    $objPHPExcel->getActiveSheet()->getStyle('C5:D5')->getFont()->setBold(true);

    cellColor('A7', '4682B4');
    cellColor('B7', '4682B4');
    cellColor('C7', '4682B4');
    cellColor('D7', '4682B4');
    cellColor('E7', '4682B4');
    cellColor('F7', '4682B4');
    cellColor('G7', '4682B4');

    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(3)
          ->setCellValue('D1',$tituloReporte3)
                ->setCellValue('A7',  $titulosColumnas3[0])
                ->setCellValue('B7',  $titulosColumnas3[1])
                ->setCellValue('C7',  $titulosColumnas3[2])
                ->setCellValue('D7',  $titulosColumnas3[3])
                ->setCellValue('E7',  $titulosColumnas3[4])
                ->setCellValue('F7',  $titulosColumnas3[5])
                ->setCellValue('G7',  $titulosColumnas3[6]);
    
    //Se agregan los datos de los alumnos
    $i = 8;
    $k=1;
    while ($fila = $resultado3->fetch_array()) {
      $objPHPExcel->setActiveSheetIndex(3)
                ->setCellValue('A'.$i,  $k)
                ->setCellValue('B'.$i,  $fila['matriz'])
                ->setCellValue('C'.$i,  $fila['nombre'])
                ->setCellValue('D'.$i,  $fila['metodo'])
                ->setCellValue('E'.$i,  $fila['tecnica'])
                ->setCellValue('F'.$i,  $fila['unidades'])
                ->setCellValue('G'.$i,  "De ".$fila['limite_min']." a ".$fila['limite_max']);
          $i++;
          $k++;
    }
    
    $objPHPExcel->getActiveSheet()->getStyle('D1:G1')->getFont()->setSize(20);
    $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setSize(25);
    $objPHPExcel->getActiveSheet()->getStyle('D1:G1')->getFont()->setBold(true);
    //$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
    //$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($estiloTituloColumnas);   
    //$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:D".($i-1));
        
    for($i = 'A'; $i <= 'G'; $i++){
      $objPHPExcel->setActiveSheetIndex(3)      
        ->getColumnDimension($i)->setAutoSize(TRUE);
    }
    
    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('AGUA RESIDUAL');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte de Parametros.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>