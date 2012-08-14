<?php

/**
 * This is the model class for table "Categories".
 *
 * The followings are the available columns in table 'Categories':
 * @property integer $ID
 * @property integer $lft
 * @property integer $rgt
 * @property integer $Level
 * @property integer $Status
 * @property string $Alias
 * @property string $Name
 * @property string $Description
 */
class Categories extends CActiveRecord
{
	public $Parent = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Status, Name', 'required'),
			array('lft, rgt, Level, Status, Parent', 'numerical', 'integerOnly'=>true),
			array('Alias, Name', 'length', 'max'=>255),
			array('Alias, Name', 'unique'),
			array('Description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, lft, rgt, Level, Status, Alias, Name, Description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'Level' => 'Level',
			'Status' => 'Статус',
			'Alias' => 'Alias',
			'Name' => 'Наименование',
			'Description' => 'Описание',
			'Parent' => 'Родитель',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('Level',$this->Level);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('Alias',$this->Alias,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function behaviors()
	{
		return array(
			'NestedSetBehavior'=>array(
				'class'				=>	'application.extensions.nestedset.NestedSetBehavior',
				'leftAttribute'		=>	'lft',
				'rightAttribute'	=>	'rgt',
				'levelAttribute'	=>	'Level',
				'hasManyRoots'      =>  true
			),
		);
	}

	public function getListCategories(){
		$return = array();

		$Categories = Categories::model()->findAll(array('order'=>'lft'));
		foreach($Categories as $Category){
			$return[$Category->ID] = $Category->Name;
		}

		return $return;
	}

	public static function getMenuItems($items) {
        
        Categories::toHierarchy($items);
        
        die();
        
        $return = array();
        $SubMenu = array();
        $level = 1;
        
        $SizeMenu = sizeof($items);
        
        echo $SizeMenu;
        
        for($i = 0; $i <= $SizeMenu; $i++ ){
            
            echo $items[$i]->Name;
            
        }
        
        /*
    	foreach( $items as $Node ) {
            
            if ( $Node->Level > $level ) {
                print_r( sizeof($children) );  
                echo CHtml::encode($Node->Name);
            }
                
            
            $return[] = array(  'label'     =>  CHtml::encode($Node->Name),
							    'url'       =>  array('/categories/view/','Alias'=>$Node->Alias),
							    'active'    =>  CHttpRequest::getParam('Alias') == $Node->Alias,
							    'items'     =>  $SubMenu
						      );
		}
        */
        
        return $return;
	}
    
    public static function toHierarchy($collection)
    {
            // Trees mapped
            $trees = array();
            $l = 0;
    
            if (count($collection) > 0) {
                    // Node Stack. Used to help building the hierarchy
                    $stack = array();
    
                    foreach ($collection as $node) {
                            $item = $node;
                            $item['children'] = array();
    
                            // Number of stack items
                            $l = count($stack);
    
                            // Check if we're dealing with different levels
                            while($l > 0 && $stack[$l - 1]['depth'] >= $item['depth']) {
                                    array_pop($stack);
                                    $l--;
                            }
    
                            // Stack is empty (we are inspecting the root)
                            if ($l == 0) {
                                    // Assigning the root node
                                    $i = count($trees);
                                    $trees[$i] = $item;
                                    $stack[] = & $trees[$i];
                            } else {
                                    // Add node to parent
                                    $i = count($stack[$l - 1]['children']);
                                    $stack[$l - 1]['children'][$i] = $item;
                                    $stack[] = & $stack[$l - 1]['children'][$i];
                            }
                    }
            }
    
            return $trees;
    }
    

}