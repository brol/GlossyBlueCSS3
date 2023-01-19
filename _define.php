<?php
/**
 * @brief GlossyblueCSS3, a theme for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Theme
 *
 * @author Pierre Van Glabeke
 *
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
 
if (!defined('DC_RC_PATH')) {
    return;
}
$this->registerModule(
    'GlossyblueCSS3',
    'Fork du thème Glossyblue de Pixials',
    'Pierre Van Glabeke',
    '0.6.1',
    [
        'requires' => [['core', '2.24']],
        'type'     => 'theme',
        'tplset'   => 'mustek',
    ]
);
