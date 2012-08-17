<?php

class ManufacturersController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		$rules = array_merge(
			parent::accessRules(),
			array(
				array(  'allow',    // allow admin user to perform 'admin' and 'delete' actions
						'actions'   =>  array('admin','delete'),
						'roles'     =>  array('Administrator')
				),
				array(  'deny',  // deny all users
						'users'=>array('*'),
				)
			)
		);

		return $rules;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->order = 'Name';
        $Manufacturers	= new CActiveDataProvider('Manufacturers',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>'20')));		
		
		$this->render('index', array(
			'Manufacturers' => $Manufacturers
		));
	}	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd()
	{
		$Manufacturer = new Manufacturers('add');

    	$this->performAjaxValidation($Manufacturer);

		if(isset($_POST['Manufacturers']))
		{
			$Manufacturer->attributes = $_POST['Manufacturers'];
			if($Manufacturer->validate()){				
				if ( $Manufacturer->save() ){
					$this->redirect(array('/admin/manufacturers'));
				}
			}
		}
        
        $Form = new CForm( $Manufacturer->getArrayCForm(), $Manufacturer );        
        
		$this->render('add',array(
			'Form'=>$Form,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($ManufacturerID)
	{
		$Manufacturer = $this->loadModel($ManufacturerID);
        $Manufacturer->setScenario('edit');

        $this->performAjaxValidation($Manufacturer);

    	if(isset($_POST['Manufacturers']))
		{
			$Manufacturer->attributes = $_POST['Manufacturers'];
			if($Manufacturer->validate()){				
				if ( $Manufacturer->save() ){
					$this->redirect(array('/admin/manufacturers'));
				}
			}
		}
        
        $Form = new CForm( $Manufacturer->getArrayCForm(), $Manufacturer );     
        
		$this->render('edit',array(
			'Form'=>$Form,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Categories('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Categories']))
			$model->attributes=$_GET['Categories'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Manufacturers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($manufacturer)
	{
        if( Yii::app()->request->isAjaxRequest && isset($_POST['ajax']) && $_POST['ajax'] == "ManufacturersForm" ){
    		echo CActiveForm::validate($manufacturer);
			Yii::app()->end();
		}
	}
  
}
