<?php
    if (!defined('DB_NAME'))
        define( 'DB_NAME', 'camagram' );
    if (!defined('DB_USER'))
        define( 'DB_USER', 'root' );
    if (!defined('DB_PASSWORD'))
        define( 'DB_PASSWORD', 'rootpass' );
    if (!defined('DB_HOST'))
        define( 'DB_HOST', '172.18.0.2' );

    $DB_DSN = `mysql:dbname=DB_NAME;host=DB_HOST`;
    $DB_USER = `DB_USER`;
    $DB_PASSWORD = `DB_PASSWORD`;
?>