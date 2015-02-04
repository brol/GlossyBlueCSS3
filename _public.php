<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of GlossyblueCSS3.
#
# Copyright (c) 2015 Pierre Van Glabeke
# Licensed under the CreativeCommons version 2.0 license.
# See LICENSE file or
# http://creativecommons.org/licenses/by-nc/2.0/fr/
#
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_RC_PATH')) { return; }

l10n::set(dirname(__FILE__).'/locales/'.$_lang.'/main');

# appel css footer
$core->addBehavior('publicHeadContent','glossyblueCSS3footer_publicHeadContent');

function glossyblueCSS3footer_publicHeadContent($core)
{
	$style = $core->blog->settings->themes->glossyblueCSS3_footer;
	if (!preg_match('/^blogcustom|recents$/',$style)) {
		$style = 'recents';
	}

	$url = $core->blog->settings->themes_url.'/'.$core->blog->settings->theme;
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/".$style.".css\" />\n";
}

# appel css about
if ($core->blog->settings->themes->glossyblueCSS3_about)
{
	$core->addBehavior('publicHeadContent',
		array('tplGlossyblueCSS3_about','publicHeadContent'));
}

class tplGlossyblueCSS3_about
{
	public static function publicHeadContent($core)
	{
	$url = $core->blog->settings->themes_url.'/'.$core->blog->settings->theme;
		echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/about.css\" />\n";
	}
}