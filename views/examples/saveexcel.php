<?php

public function actionAddlist(){
		set_time_limit(5000); 
        $model = new Upload();
		$res="";
        if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');
			
            $path = dirname(__DIR__).'/runtime/temp/'; 
            if(!file_exists($path)&&!mkdir($path)){
                return 'не удалось создать директорию';
            }
            if ($model->file && $model->validate()) {
                
                $fileName = 'upload_price_temp.xls';
                
                if(file_exists($path.$fileName)){
                    unlink($path.$fileName);
                }
                $model->file->saveAs($path.$fileName);
                if(!file_exists($path.$fileName)){
                    die('не удалось сохранить файл');
                }
				ob_end_clean();
                $data =Excel::import($path.$fileName,
                    ['setFirstRecordAsKeys' => true, 
                    'setIndexSheetByName' => true,]);
                if(!is_array($data)){
                    die('не удалось разобрать файл');
                }
	
				//return print_r($data);
						
                if(is_array($data)&&count($data)>0){
			
                    foreach($data as $n=>$m){
						if(is_array($m)&&$this->issetParams($m)==self::RES_TRUE){
							$this->parcseRecord($m);
						}else if(is_array($m)){
							foreach($m as $k=>$v){
								$this->parcseRecord($v);
							}
						}
						
						
					}
					
                }else{
					return print_r('11111'.serialize($data));
				}
            }else{
				return print_r(serialize($model->getErrors()));
			}
        }else{
			return 'is no post';
		}

        return $this->redirect(['index','message'=>serialize($res)]);
    
    }

    
    
    
    	private function parcseRecord($v){
		$res="";
		if(!is_array($v)){
			return $v;
		}
		$isset=$this->issetParams($v);
							if($isset==self::RES_TRUE){
								$col=Collection::find()->where(['name'=>$v['collection']])->one();
								if($col==null){
									$col=new Collection();
									$col->name=$v['collection'];
									$col->save();
									$col->pos_id=$col->collection_id;
									$col->save();
								}
								$price= Price::find()->where(['id'=>$v['id']])->one();
								if($price==null){
									$price=new Price();
									$price->id=$v['id'];
								}
								$price->colorcode=$v['colorcode'];
								$price->collection_id=$col->collection_id;
								$price->design=$v['design'];
								$price->lenghtsize=$v['lenghtsize'];
								$price->widthsize=$v['widthsize'];
								
								
								if(isset($v['draw'])){
									$price->draw=$v['draw'];
								}
								if(isset($v['price_filepath'])){
									$price->price_filepath=$v['price_filepath'];
								}
								if(isset($v['price_bgfilepath'])){
									$price->price_bgfilepath=$v['price_bgfilepath'];
								}

								
								$price->mono_price=$v['mono_price'];
												
								$price->duo_price=$v['duo_price'];
								
								$price->trio_price=$v['trio_price'];
							
								$price->mono_name=$v['mono_name'];
								
								
								$price->duo_name=$v['duo_name'];
								
								
								$price->trio_name=$v['trio_name'];
								
								
								$price->hori_lenghtsize=$v['hori_lenghtsize'];
								
								$price->hori_widthsize=$v['hori_widthsize'];
								

								
								if((isset($v['mono_price'])&&isset($v['mono_name']))
								   ||isset($v['duo_price'])&&isset($v['duo_name'])
								   ||isset($v['trio_price'])&&isset($v['trio_name'])){
									if(!$price->save()){
										return serialize($price->getErrors());
									}
								}
								
								
								
							}elseif($isset==self::RES_FALSE){
								return ('Не все параметры переданы'.serialize($this->error));
							}
							return $res;
	}

?>