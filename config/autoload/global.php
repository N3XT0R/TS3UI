<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'teamspeak' => array(
        'server' => '5.159.56.190:10011',
        'port' => '9987',
        'username' => '{username}',
        'password' => '{password}',
    ),
    'asset_manager' => array(
        'map' => array(
            //Bootstrap
            'fonts/glyphicons-halflings-regular.eot'                 => 'fonts/glyphicons-halflings-regular.eot',
            'fonts/glyphicons-halflings-regular.svg'                 => 'fonts/glyphicons-halflings-regular.svg',
            'fonts/glyphicons-halflings-regular.ttf'                 => 'fonts/glyphicons-halflings-regular.ttf',
            'fonts/glyphicons-halflings-regular.woff'                => 'fonts/glyphicons-halflings-regular.woff',
            'fonts/glyphicons-halflings-regular.woff2'               => 'fonts/glyphicons-halflings-regular.woff2',
            //FontAwesome
            'fonts/FontAwesome.otf'                 => 'fonts/FontAwesome.otf',
            'fonts/fontawesome-webfont.eot'         => 'fonts/fontawesome-webfont.eot',
            'fonts/fontawesome-webfont.svg'         => 'fonts/fontawesome-webfont.svg',
            'fonts/fontawesome-webfont.ttf'         => 'fonts/fontawesome-webfont.ttf',
            'fonts/fontawesome-webfont.woff'        => 'fonts/fontawesome-webfont.woff'
        ),
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . '/../../public/',
                __DIR__ . '/../../vendor/fortawesome/font-awesome/',
                __DIR__ . '/../../vendor/twbs/bootstrap/'
            ),
        ),
        'caching' => array(
            'default' => array(
                'cache'     => 'AssetManager\\Cache\\FilePathCache',
                'options' => array(
                    'dir' => 'public', // path/to/cache
                ),
            ),
        ),
    ),
);
