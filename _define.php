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
if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
	/* Name */			    "GlossyblueCSS3",
	/* Description*/		"Fork du thème Glossyblue de Pixials",
	/* Author */			  "Pierre Van Glabeke",
	/* Version */			  '0.5',
	array(
		'type'	 =>	'theme',
		'tplset' => 'mustek',
		'dc_min' => '2.15'
	)
);