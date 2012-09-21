<?php
$this->pageTitle = $manufacturer->name;


if( !empty($products) ){
    foreach($products as $product){
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$product->search(),
			'filter'=>$product,
        	'columns' =>$product->getTableFields(),
        	'htmlOptions'=>array('class'=>false),
        	'itemsCssClass'=>'table table-bordered table-striped',
        	'template'=>'{summary} {items} {pager}',
        	'pagerCssClass'=>'pagination',
        	'pager'=>array(
        		'class' => 'myLinkPager',
        		'cssFile' => false,
        		'header' => '',
        		'firstPageLabel'=> '&laquo;',
        		'prevPageLabel'	=> '&larr;',
        		'nextPageLabel'	=> '&rarr;',
        		'lastPageLabel' => '&raquo;',
        		'htmlOptions'	=> array("class"=>false),
        	),
        ));
    }
}

?>