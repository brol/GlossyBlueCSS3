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

l10n::set(dirname(__FILE__) . '/locales/' . dcCore::app()->lang. '/public');

# appel css footer
dcCore::app()->addBehavior('publicHeadContent','glossyblueCSS3footer_publicHeadContent');

function glossyblueCSS3footer_publicHeadContent()
{
	$style = dcCore::app()->blog->settings->themes->glossyblueCSS3_footer;
	if (!preg_match('/^blogcustom|recents$/', (string) $style)) {
		$style = 'recents';
	}

	$url = dcCore::app()->blog->settings->system->themes_url.'/'.dcCore::app()->blog->settings->system->theme;
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/".$style.".css\" />\n";
}

# appel css about
if (dcCore::app()->blog->settings->themes->glossyblueCSS3_about)
{
	dcCore::app()->addBehavior('publicHeadContent',
		array('tplGlossyblueCSS3_about','publicHeadContent'));
}

class tplGlossyblueCSS3_about
{
	public static function publicHeadContent()
	{
	$url = dcCore::app()->blog->settings->system->themes_url.'/'.dcCore::app()->blog->settings->system->theme;
		echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/about.css\" />\n";
	}
}