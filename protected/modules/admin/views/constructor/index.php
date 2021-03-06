<?php
	$this->breadcrumbs=array( Yii::t("products", "Constructor Goods") );

	$this->renderPartial('secondMenu');
?>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$products,
        'columns' => array(
            array(
                'name'=>'id',
                'htmlOptions'=>array('width'=> '10'),
            ),
            'name',
            array(
                'type'=>'raw',
                'value'=>'CHtml::link(Yii::t("products","form"), Yii::app()->createUrl("/admin/constructor/form",array("id"=>$data->id)) )',
                 'htmlOptions'=>array('width'=> '50'),
            ),
            array(
                'type'=>'raw',
                'value'=>'CHtml::link(Yii::t("products","fields"), Yii::app()->createUrl("/admin/constructor/fields",array("id"=>$data->id)) )',
                 'htmlOptions'=>array('width'=> '40'),
            ),
            array(
                'htmlOptions'=>array('width'=>'10'),
                'class'=>'CButtonColumn',
                'template'=>'{update}',
                'buttons'=> array(
                    'update' => array(
                        'url'=> 'Yii::app()->createUrl("/admin/constructor/edit",array("id"=>$data->id))',
                        'imageUrl'=>null,
                        'label'=>'<span class="icon-pencil pointer" title="'.Yii::t('main','Редактировать').'"></span>'
                    )
                )
            ),
            array(
                'htmlOptions'=>array('width'=>'10'),
                'class'=>'CButtonColumn',
                'template'=>'{delete}',
                'buttons'=> array(
                    'delete' => array(
                        'url'=> 'Yii::app()->createUrl("/admin/constructor/delete",array("id"=>$data->id))',
                        'imageUrl'=>null,
                        'label'=>'<span class="close" title="'.Yii::t('main','Удалить').'">&times;</span>'
                    )
                )
            ),
        ),
        'htmlOptions'=>array(
            'class'=> ''
        ),
        'itemsCssClass'=>'table table-bordered table-striped',
        'template'=>'{summary} {items} {pager}',
        'pagerCssClass'=>'pagination',
        'pager'=>array(
            'class'         =>'myLinkPager',
            'cssFile'        => false,
            'header'        => '',
        	'firstPageLabel'=> '&laquo;',
        	'prevPageLabel'	=> '&larr;',
        	'nextPageLabel'	=> '&rarr;',
        	'lastPageLabel' => '&raquo;',
        	'htmlOptions'	=> array("class"=>false),
        ),
    ));

?>