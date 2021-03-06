<?php

/**
 * This is the model class for table "ProductsFields".
 *
 * The followings are the available columns in table 'ProductsFields':
 * @property integer $ID
 * @property integer $ProductID
 * @property integer $FieldType
 * @property string $Name
 * @property integer $IsMandatory
 * @property integer $IsFilter
 *
 * The followings are the available model relations:
 * @property Products $product
 */
class Field extends CModel
{
    protected static $instance;  // object instance
    
    
    public $id;
    public $product_id;
    public $field_type;
    public $position;
    public $name;
    public $unit_name;
    public $hint;
    public $alias;
    public $is_filter;    
    public $is_mandatory;
    public $is_column_table;
    public $is_editing_table_admin;
    public $is_column_table_admin;    
    
    public $tab_id;
    
    public $subClass = null;
    public $subClassName = null;

    public static function model()
    {
        if ( is_null(self::$instance) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

	public static function tableName()
	{
		return 'product_field';
	}

    public static function selectCol(){
        $return = array( 
                self::tableName().'.*',
                'field_tab.tab_id'
            );
        
        return $return;
    }

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('field_type, name, alias', 'required', 'on'=>'add, edit'),
			array('product_id, field_type, position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('alias', 'length', 'max'=>50),
			array('name, alias', 'unique', 'criteria' => array(
												'condition' => 'product_id = :product_id',
												'params'=>array(':product_id'=> $this->product_id )
											)),

			array('is_filter, is_mandatory, is_column_table, is_editing_table_admin, is_column_table_admin', 'boolean' ),
            array('unit_name, hint', 'safe'),
			array('alias', 'match', 'pattern' => '/^[A-Za-z0-9]+$/u','message' => Yii::t("products",'Field contains invalid characters.')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, field_type, name, is_mandatory, is_filter', 'safe', 'on'=>'search'),
		);
	}
    
    protected function setAttr($params)
    {
        $this->id = $params['id'];
        $this->product_id = $params['product_id'];
        $this->field_type = $params['field_type'];
        $this->position = $params['position'];
        $this->name = $params['name'];
        $this->unit_name = $params['unit_name'];
        $this->hint = $params['hint'];
        $this->alias = $params['alias'];
        $this->is_filter = $params['is_filter'];    
        $this->is_mandatory = $params['is_mandatory'];
        $this->is_column_table = $params['is_column_table'];
        $this->is_editing_table_admin = $params['is_editing_table_admin'];
        $this->is_column_table_admin = $params['is_column_table_admin'];
        $this->tab_id = $params['tab_id'];
        
    }
    
    private function create($params){
        $class = null;
        switch ($params['field_type']) {
            case TypeField::INTEGER:
                $class = new IntegerField();
            break;            
            case TypeField::STRING:
                $class = new StringField();
            break;
            case TypeField::TEXT:
                $class = new TextField();
            break;     
            case TypeField::PRICE:
                $class = new PriceField();
            break;             
            case TypeField::LISTS:
                $class = new ListField();
            break;            
            case TypeField::BOOLEAN:
                $class = new BooleanField();
            break;            
            case TypeField::DOUBLE:
                $class = new DoubleField();
            break;             
            
            case TypeField::IMAGE:
                $class = new ImageField();
            break;             

            case TypeField::FILE:
                $class = new DoubleField();
            break; 

            case TypeField::CATEGORIES:
                $class = new CategoryField();
            break;
            case TypeField::MANUFACTURER:
                $class = new ManufacturerField();
            break;            
        }
        if ( $class ) {
            $class->setAttr($params);
        }
        return $class;
    }
    
    public function find($condition,$params){        
        
        $select = array_merge(  self::selectCol(), 
                                StringField::selectCol(), 
                                IntegerField::selectCol(), 
                                TextField::selectCol(),
                                PriceField::selectCol(),
                                ListField::selectCol(),
                                BooleanField::selectCol(),
                                DoubleField::selectCol(),
                                
                                ImageField::selectCol(),
                                
                                CategoryField::selectCol(),
                                ManufacturerField::selectCol()
            );
        
        $fields = Yii::app()->db->createCommand()
                    ->select($select)
                    ->from(self::tableName())
                    
                    ->leftJoin( FieldTab::tableName, FieldTab::tableName.'.field_id = id' )                    
                    
                    ->leftJoin( StringField::tableName(), StringField::tableName().'.field_id = id' )
                    ->leftJoin( IntegerField::tableName(), IntegerField::tableName().'.field_id = id' )
                    ->leftJoin( TextField::tableName(), TextField::tableName().'.field_id = id' )
                    ->leftJoin( PriceField::tableName(), PriceField::tableName().'.field_id = id' )
                    ->leftJoin( ListField::tableName(), ListField::tableName().'.field_id = id' )
                    ->leftJoin( BooleanField::tableName(), BooleanField::tableName().'.field_id = id' )
                    ->leftJoin( DoubleField::tableName(), DoubleField::tableName().'.field_id = id' )
                    
                    ->leftJoin( ImageField::tableName(), ImageField::tableName().'.field_id = id' )
                    
                    ->leftJoin( CategoryField::tableName(), CategoryField::tableName().'.field_id = id' )
                    ->leftJoin( ManufacturerField::tableName(), ManufacturerField::tableName().'.field_id = id' )
                    
                    ->where($condition,$params)
                    ->queryAll();
        
        $rows = array();
        if ( !empty($fields) ){
            foreach($fields as $field){
                $rows[$field['id']] = $this->create($field);
            }
        }
        
        return $rows;
    }

	public function relations()
	{
		return array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),

            'booleanField' => array(self::HAS_ONE, 'BooleanField', 'field_id'),
            'categoryField' => array(self::HAS_ONE, 'CategoryField', 'field_id'),
            'dateTimeField' => array(self::HAS_ONE, 'DateTimeField', 'field_id'),
            'doubleField' => array(self::HAS_ONE, 'DoubleField', 'field_id'),
            'imageField' => array(self::HAS_ONE, 'ImageField', 'field_id'),
            'integerField' => array(self::HAS_ONE, 'IntegerField', 'field_id'),
            'listField' => array(self::HAS_ONE, 'ListField', 'field_id'),
            'manufacturerField' => array(self::HAS_ONE, 'ManufacturerField', 'field_id'),
            'priceField' => array(self::HAS_ONE, 'PriceField', 'field_id'),
            'stringField' => array(self::HAS_ONE, 'StringField', 'field_id'),
            'textField' => array(self::HAS_ONE, 'TextField', 'field_id'),

            'tabs' => array(self::HAS_MANY, 'Tab', 'product_id'),
            'fieldTab' => array(self::HAS_ONE, 'FieldTab', 'field_id'),
		);
	}


	public function attributeNames()
	{
		return array(
			'id' =>  Yii::t("fields",'ID'),
			'position' => Yii::t("fields",'Приоритет'),
			'product_id' => Yii::t("fields",'Идентификатор продукта'),
			'field_type' => Yii::t("fields",'Тип поля'),
			'name' => Yii::t("fields",'Наименование'),
			'alias' => Yii::t("fields",'Псевдоним'),
			'is_mandatory' => Yii::t("fields",'Обязательно'),
			'is_filter' =>  Yii::t("fields",'Использовать в фильтрации'),
			'is_column_table' => Yii::t("fields",'Used In Table Header?'),
			'unit_name' => Yii::t("fields",'Unitname'),
			'hint' => Yii::t("fields",'Hint'),
            'is_editing_table_admin'=> Yii::t("fields","Editing table"),
            'is_column_table_admin'=> Yii::t("fields","is_column_table_admin")
		);
	}


}
