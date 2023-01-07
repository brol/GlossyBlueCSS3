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