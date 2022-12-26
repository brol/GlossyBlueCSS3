<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of GlossyblueCSS3.
#
# Copyright (c) 2015 Pierre Van Glabeke
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------
if (!defined('DC_RC_PATH')) {
    return;
}
$this->registerModule(
    'GlossyblueCSS3',
    'Fork du thème Glossyblue de Pixials',
    'Pierre Van Glabeke',
    '0.6',
    [
        'requires' => [['core', '2.24']],
        'type'     => 'theme',
        'tplset'   => 'mustek',
    ]
);
