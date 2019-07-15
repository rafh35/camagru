<?php
    define( 'DB_NAME', 'camagram' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', 'rootpass' );
    define( 'DB_HOST', '172.18.0.2' );
    define( 'DB_TABLE', 'users' );

    $DB_DSN = `mysql:dbname=DB_NAME;host=DB_HOST`;
    $DB_USER = `DB_USER`;
    $DB_PASSWORD = `DB_PASSWORD`;
?>