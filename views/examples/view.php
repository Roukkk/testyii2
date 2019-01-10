<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use budyaga\users\models\User;
use kartik\datetime\DateTimePicker;


            //форма
            $form = ActiveForm::begin([ 
						'id' => 'zadarmacalls-form',
						'action'=>['/call/callreport'], 
						'options' => ['class' => 'form-inline'], 
					]);

			echo $form->field($callreport, 'from')	->widget(DateTimePicker::classname(),					
								[
							'name' => 'Callreport[from]',
							'options' => ['placeholder' => 'ОТ','value'=>date('d.m.Y H:i',strtotime($callreport->from))],
							'convertFormat' => true,
							'type' => DateTimePicker::TYPE_INPUT,
							'pluginOptions' => [
								'weekStart'=>1,
								'format' => 'dd.MM.yyyy h:i',
								'startDate' => date('dd.MM.yyyy h:i'),
								'todayHighlight' => true,	
							]
						])->label('От');
			
			echo $form->field($callreport, 'user_id')->dropDownList($userList,['prompt'=>'Менеджер','class'=>'form-control input-xs'] )->label(false);
			echo $form->field($callreport, 'number')->textInput()->input('text', ['placeholder' => "Номер телефона"])->label(false);
                
						
			echo Html::submitButton('Обновить',['class' => 'btn btn-xs btn-primary', 'name' => 'add-button','style'=>'margin-left:10px;']);		
			ActiveForm::end();

            //таблица
            $dataProvider = new ActiveDataProvider([
				'query' => $query,
				'pagination' => ['pageSize' => 20],
			]);

			echo GridView::widget([ 
				'dataProvider' => $dataProvider, 
				'rowOptions'=>['class' => 'xs'],
				'summary'=>'',
				'showHeader'=>true,
				'tableOptions' => [
					'class' => 'table table-striped table-bordered'
				],
				'rowOptions' => function ($data){
				  if($data['seconds']==0){
					return ['class' => 'danger'];
				  }else if($data['incoming']==1){
					return ['class' => 'warning'];
				  }else{
					return ['class' => 'success'];   
				  }
				},
				'columns' => [ 

					['label'=>'Клиент',
						'format' => 'raw',
						'value'=>function ($data){
							if( $data['clients_id']!=null){
								return Html::a($data['name'],['clients/show','clients_id'=>$data['clients_id']],['target'=>'_blank']);
							}
						}	
					],
					['label'=>'Прослушать',
						'format' => 'raw',
						'value'=>function ($data) {
							if($data['is_recorded']=='true'){
								return '<audio src="/calls/'.$data['call_id'].'.mp3" preload="auto" controls></audio>';
							}else{
								return 'Звонок не был записан на АТС';
							}
						}
					],
					
				], 
			]);

            //excel
            private function setFormat($orderId){
		$cntcell=Positions::find()->where(['order_id'=>$orderId])->count();
		$objPHPExcel = PHPExcel_IOFactory::load('/var/www/html/basic/web/orders/'.$orderId.'.xls');
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
		$objWorksheet->mergeCells('B15:K15');
		$objWorksheet->setCellValue('B15', 'Деталировка');
		
		$objWorksheet->mergeCells('L15:P15');
		$objWorksheet->setCellValue('M15', 'Присадка под петли');
		
		
		$objWorksheet->setCellValue('O5', 'con-mat.ru');

		$gdImage = imagecreatefromjpeg('/var/www/html/basic/web/img/logo2.jpg');
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setName('logo');$objDrawing->setDescription('logo');
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setHeight(75);
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		$objDrawing->setCoordinates('N1');
		$styleArray = array(
			'borders' => array(
			  'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			  )
			)
		  );
		$styleArray2 = array(
			'borders' => array(
			  'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM
			  )
			)
		  );
		$styleArray3 = array(
			'borders' => array(
			  'top' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM
			  ),
			  'left' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM
			  ),
			  'right' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM
			  ),
			  'bottom' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM
			  )
			)
		);
		$styleArray4 = array(
			'borders' => array(
			  'bottom' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM
			  )
			)
		);
		$endtable=(16+$cntcell);
		$aftertable=($endtable);
		$objWorksheet->getStyle('B15:P'.$endtable)->applyFromArray($styleArray);
		$objWorksheet->getStyle('I'.($aftertable+1).':K'.($aftertable+1))->applyFromArray($styleArray2);
		$objWorksheet->getStyle('P'.($aftertable+1))->applyFromArray($styleArray2);
		$objWorksheet->getStyle('B15:P'.$endtable)->applyFromArray($styleArray3);
		$objWorksheet->getStyle('B16:L16')->applyFromArray($styleArray3);
		$objWorksheet->getStyle('M16:P16')->applyFromArray($styleArray3);
		$objWorksheet->getStyle('K15:K'.$endtable)->applyFromArray($styleArray3);
		$objWorksheet->getStyle('P15:P'.$endtable)->applyFromArray($styleArray3);
		$objWorksheet->getStyle('P15:P'.$endtable)->applyFromArray($styleArray3);
		$objWorksheet->getStyle('M'.($aftertable+8).':N'.($aftertable+8))->applyFromArray($styleArray4);
		$objWorksheet->mergeCells('C'.($aftertable+12).':P'.($aftertable+12));
		$objWorksheet->getRowDimension(($aftertable+12))->setRowHeight(40);
		$objWorksheet->mergeCells('C'.($aftertable+14).':P'.($aftertable+14));
		$objWorksheet->mergeCells('C'.($aftertable+15).':P'.($aftertable+15));
		
		
		$objWorksheet->getStyle("A1:P47")->getFont()->setBold( true );
		$objWorksheet->getStyle("A1:P47")->getAlignment()->setWrapText(true); 
		$objWorksheet->getColumnDimension('C')->setWidth(15);
		$objWorksheet->getColumnDimension('D')->setWidth(25);
		$objWorksheet->getColumnDimension('E')->setWidth(15);
		$objWorksheet->getColumnDimension('F')->setWidth(15);
		$objWorksheet->getColumnDimension('G')->setWidth(15);
		$objWorksheet->getColumnDimension('H')->setWidth(15);
		$objWorksheet->getColumnDimension('I')->setWidth(15);
		$objWorksheet->getColumnDimension('J')->setWidth(15);
		$objWorksheet->getColumnDimension('K')->setWidth(15);
		$objWorksheet->getColumnDimension('L')->setWidth(15);
		$objWorksheet->getColumnDimension('M')->setWidth(15);
		$objWorksheet->getColumnDimension('N')->setWidth(15);
		$objWorksheet->getColumnDimension('O')->setWidth(15);
		$objWorksheet->getColumnDimension('P')->setWidth(15);
		$objWorksheet->getStyle('A15:T'.$endtable)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('/var/www/html/basic/web/orders/'.$orderId.'.xls'); 
	}
    
    
    //почта
    private function sendMail($to,$subject,$body,$attachments){
		$em = new Email();
		$em->email=$to;
		if($em->validate()){
			$transport = new \Swift_SmtpTransport('mail.nic.ru', 465, 'ssl');		
			$transport->setUsername("zakaz@con-mat.ru") 
			->setPassword("123QWEasd");
			$mailer = new \Swift_Mailer($transport);
	
			$messages = new \Swift_Message($subject);
			$messages->setFrom(["zakaz@con-mat.ru" => "zakaz@con-mat.ru"])
			->setTo(trim($to))
			->setContentType("text/html; charset=UTF-8")
			->setBody($body, 'text/html');
			foreach ($attachments as $attach){
				$messages->attach($attach);
			}
			try{
				
				$mailer->send($messages);
			}catch (\Swift_TransportException $e) {
				print_r ('Выброшено исключение: '.  $e->getMessage(). "\n");
			}
			
		}
	}

	//загрузка
	<?php $form = ActiveForm::begin(['action' =>['addlist'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-inline']]) ?>
		<?php echo $form->field($upload, 'file')->fileInput()->label('Файл') ?>
        <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary', 'name' => 'add-button','style'=>'margin-top:10px;']) ?>
		<?php ActiveForm::end(); ?>

?>