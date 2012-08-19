<?php

return array(
	'name'				=>  'Большой Магазин',
	'defaultController'	=>  'site',
	'sourceLanguage'    =>  'en',
	'language'          =>  'ru',
	'theme'             =>  'classic',

	'params'=>array(
		'keywords'		=>	array('компания, товары, услуги, бизнес, продажа, сделки, покупка, тендеры, заявки, каталог, справочник, информация о компаниях, прайс-листы, цены, материалы, технологии, b2b, Россия',),
		'description'	=>	'Каталог производителей, поставщиков, промышленных и торговых предприятий, заводов, предприятий сферы услуг России. Бесплатная регистрация компаний на сайте. Размещение прайс-листов, информации о товарах и услугах. Поиск товаров и услуг, тендеров и заявок, бесплатное создание сайта компании.',
		'smtp'			=>	array(
								"host"		=> "smtp.yandex.ru", 			//smtp сервер
								"debug"		=> 0,                   		//отображение информации дебаггера (0 - нет вообще)
								"auth"		=> true,                 		//сервер требует авторизации
								"port"		=> 25,                    		//порт (по-умолчанию - 25)
								"username"	=> "",			//имя пользователя на сервере
								"password"	=> "",					//пароль
								"addreply"	=> "",	//ваш е-mail
								"replyto"	=> "",   //e-mail ответа
								"fromname"	=> "",				//имя
								"from"		=> "",	//от кого
								"charset"	=> "utf-8",      				//от кого
							),
		'separator'		=>	' | '
	 ),

	// подгружаем модели к классы
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.widgets.*',

        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
	),

	// Сжатие
	//'onBeginRequest'=>create_function('$event', 'return ob_start("ob_gzhandler");'),
	//'onEndRequest'=>create_function('$event', 'return ob_end_flush();'),

	// Модули
	'modules'=>array(
		'admin' => array(
			'layout'=>'application.modules.admin.views.layouts.main',
		),
        'gii'=>array(
            'class'         =>  'system.gii.GiiModule',
            'password'      =>  '1',
            'ipFilters'     =>  array("192.168.56.1","127.0.0.1",),
            'newFileMode'   =>  0666,
            'newDirMode'    =>  0777,
        )
    ),

	// Компоненты
	'components'=>array(

		'clientScript'=>array(
            'scriptMap'=>array(
                'jquery.js'				=> 'https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js',
                //'jquery-ui.js'			=> 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js',
				//'jquery.ajaxqueue.js'	=> false,
				//'jquery.metadata.js'	=> false,
				//'jquery.yiilistview.js'	=> false,
				//'jquery.ba-bbq.js'		=> false,
				'styles.css'			=> false,
            ),
            //'enableJavaScript'=>false,    // Эта опция отключает любую генерацию javascript'а фреймворком
        ),

		// Почта
		'mailer' => array(
			'class' => 'application.extensions.mailer.EMailer',
			'pathViews' => 'application.views.email',
			'pathLayouts' => 'application.views.email.layouts'
		),

		// База
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=enchikiben_fbfde',
            //'connectionString' => 'mysql:host=mysql0.db.koding.com;dbname=enchikiben_fbfde',
			'emulatePrepare' => true,
			'username' => 'enchikiben_fbfde',
			'password' => '754089db',
			'charset' => 'utf8',
			'tablePrefix' => '',
			// включаем профайлер
			'enableProfiling' => true,
			// показываем значения параметров
			'enableParamLogging' => true,
		),

		// пользователи
		'session' => array(
			'autoStart'		=> true,
            //'cookieParams'	=> array('domain' => '.'.$_SERVER['SERVER_NAME'] ),
        ),

        'user' => array(
			'allowAutoLogin'	=> true,
			'allowAutoLogin'	=> true,
            //'identityCookie'	=> array('domain' => '.'.$_SERVER['SERVER_NAME']  ),
			'loginUrl'			=> array('login'),
        ),

 		'authManager'=>array(
			'class' => 'PhpAuthManager',
			'defaultRoles' => array('guest'),
        ),
		'loid' => array(
            'class' => 'ext.lightopenid.loid',
        ),
        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => false,       // Использовать всплывающее окно вместо перенаправления на сайт провайдера
            'services' => array(    // Вы можете настроить список провайдеров и переопределить их классы
                'google' => array(
                    'class' => 'GoogleOpenIDService',
                ),
                'yandex' => array(
                    'class' => 'YandexOpenIDService',
                )
            ),
        ),

		// адресация
        'urlManager'=>array(
        	'urlFormat'			=>	'path',
			'showScriptName'	=>	false,
            // тут правим если запускаем из подпапки
			'baseUrl'			=>	'http://'.$_SERVER['SERVER_NAME']."/yiishop",
         	'rules'				=> require 'urlRules.php',

			'urlSuffix' => '.html',
        ),

        'errorHandler'=>array(
			'errorAction'=>'site/error',
        ),

		'preload'=>array('log'),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					//выводим лог внизу страницы
					'class'=>'CWebLogRoute',
					'levels'=>'error, warning, trace, profile, info',
				),
			),
		),

	),

);

