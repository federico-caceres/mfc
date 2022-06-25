<?php

/**
 * [PANTALLAS_STAR] , Skytel. All Rights Reserved. [2013].
 *
 * $Id: config.libs.php 13843 2015-05-28 20:23:35Z ana.espinola $
 */
?>
<?php
if(defined('PATH_LIBS_PHP')) {
   return;
}

//define('PATH_LIBS_PHP','D:\svn\libs_php');
define('PATH_LIBS_PHP','/opt/libs_php');
set_include_path(get_include_path() . PATH_SEPARATOR . PATH_LIBS_PHP);

?>