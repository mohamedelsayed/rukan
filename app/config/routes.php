<?php Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
//Static Pages Routing
Router::connect('/', array('controller' => 'home', 'action' => 'index'));
Router::connect('/maintenance', array('controller' => 'home', 'action' => 'maintenancemode'));
Router::connect('/search', array('controller' => 'page', 'action' => 'search'));
//Router::connect('/', array('controller' => 'admin', 'action' => 'index'));
//Router::connect('/about-us', array('controller' => 'texts', 'action' => 'display', 1));
Router::connect('/contact-us', array('controller' => 'texts', 'action' => 'display', 1));
Router::connect('/forget-password/*', array('controller' => 'profil', 'action' => 'forgot'));
Router::connect('/me-admin', array('controller' => 'meadmin', 'action' => 'index'));
Router::connect('/me-admin/index', array('controller' => 'meadmin', 'action' => 'index'));
Router::connect('/me-admin/login', array('controller' => 'meadmin', 'action' => 'login'));
Router::connect('/me-admin/logout', array('controller' => 'meadmin', 'action' => 'logout'));
Router::connect('/me-admin/', array('controller' => 'meadmin', 'action' => 'index'));
Router::connect('/me-admin/index/', array('controller' => 'meadmin', 'action' => 'index'));
Router::connect('/me-admin/login/', array('controller' => 'meadmin', 'action' => 'login'));
Router::connect('/me-admin/logout/', array('controller' => 'meadmin', 'action' => 'logout'));
Router::connect('/forum', array('controller' => 'forum', 'action' => 'index'));	
//Router::connect('/forum/index', array('controller' => 'posts', 'action' => 'all'));	
//Sitemap Routing
Router::connect('/sitemap', array('controller' => 'sitemaps', 'action' => 'index'));
//Router::connect('/sitemap/:action/*', array('controller' => 'sitemaps'));
Router::connect('/robots', array('controller' => 'sitemaps', 'action' => 'robot'));
//Router::connect('/robots/:action/*', array('controller' => 'sitemaps', 'action' => 'robot'));
Router::connect('/:language/:controller/:action/*',
                       array(),
                       array('language' => '[a-z]{2}'));
Router::connect('/:language/:controller',
                       array(),
                       array('language' => '[a-z]{2}'));
Router::connect('/:language/*',
                       array(),
                       array('language' => '[a-z]{2}'));  
Router::parseExtensions();  