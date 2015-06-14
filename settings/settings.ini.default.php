<?php
return array(
    'settings' => array(
        'site' => array(
            'title' => 'Eventizer',
            'site_admin_email' => '',
            'locale' => 'en_EN',
            'theme' => 'defaulttheme',
            'installed' => false,
            'secrethash' => '',
            'debug_output' => false,
            'debug_email' => '',
            'domain' => 'http://example.com',
            'debug_ip' => array(),
            'templatecache' => false,
            'templatecompile' => false,
            'modulecompile' => false,
            'force_virtual_host' => false,
            'https_port' => 443,
            'default_site_access' => 'eng',
            'sysupdate' => array(
                'version' => 0.1,
            ),
            'site_languages' => array(
                'eng' => array(
                    'locale' => 'en_EN',
                    'class' => 'english',
                    'title' => 'English',
                    'base_url' => '/'
                )
            ),
            'extensions' => array(
                 0 => 'form',
                 1 => 'socialcomments',
                 2 => 'mycalendar',
            ),
            'imagemagic_enabled' => false,
            'default_www_user' => 'apache',
            'default_www_group' => 'apache',
            'StorageDirPermissions' => 0755,
            'StorageFilePermissions' => 0644,
            'available_site_access' => array(
                0 => 'eng',
                1 => 'site_admin'
            ),
            'time_zone' => '',
            'date_format' => 'Y-m-d',
            'date_hour_format' => 'H:i:s',
            'date_date_hour_format' => 'Y-m-d H:i:s'
        ),
        'default_url' => array(
            'module' => 'front',
            'view' => 'default'
        ),
        'user_settings' => array(
            'default_user_group' => 2,
            'anonymous_user_id' => 2
        ),
        'db' => array(
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => '',
            'port' => 3306,
            'use_slaves' => false,
            'db_slaves' => array(
                0 => array(
                    'host' => '',
                    'user' => '',
                    'port' => 3306,
                    'password' => '',
                    'database' => ''
                )
            )
        ),
        'site_access_options' => array(
            'eng' => array(
                'locale' => 'en_EN',
                'content_language' => 'en',
                'dir_language' => 'ltr',
                'default_url' => array(
                    'module' => 'front',
                    'view' => 'default'
                ),
                'theme' => array(
                    0 => 'customtheme',
                    1 => 'defaulttheme'
                )
            ),
            'site_admin' => array(
                'locale' => 'en_EN',
                'content_language' => 'en',
                'dir_language' => 'ltr',
                'theme' => array(
                    0 => 'backendtheme',
                    1 => 'defaulttheme'
                ),
                'login_pagelayout' => 'login',
                'default_url' => array(
                    'module' => 'dashboard',
                    'view' => 'dashboard'
                )
            )
        ),
        'cacheEngine' => array(
            'cache_global_key' => 'global_cache_key_dev_framework',
            'className' => false
        )
    ),
    'comments' => NULL
);
?>