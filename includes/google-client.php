<?php 
/**
 * Include the necessary classes for youtube API to work properly
 *
 * @package sngreea
 */

error_reporting( E_ALL );

var_dump( get_include_path() );

set_include_path( dirname( __FILE__ ) . '/google-api-php-client-2.0.0/src/' );

require_once 'Google/Client.php';
require_once 'Google/Service.php';
require_once 'Google/Service/Resource.php';

var_dump( get_include_path() );

set_include_path( dirname( __FILE__ ) . '/google-api-php-client-2.0.0/vendor/google/apiclient-services/Google/' );
// require_once 'Service/YouTube/Resource/';
require_once 'Service/YouTube/Resource/Activities.php';
require_once 'Service/YouTube/Resource/Captions.php';
foreach (glob(get_include_path() . "Service/YouTube/Resource/*.php") as $filename)
{
    require_once $filename;
}
require_once 'Service/YouTube.php';

set_include_path( dirname( __FILE__ ) . '/google-api-php-client-2.0.0/vendor/monolog/monolog/src/' );
require_once 'Monolog/Logger.php';

var_dump( get_include_path() );



?>