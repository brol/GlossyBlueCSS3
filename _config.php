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
if (!defined('DC_CONTEXT_ADMIN')) exit;

l10n::set(dirname(__FILE__).'/locales/'.$_lang.'/main');

# Default values
$default_footer = 'blogcustom';
$default_about = false;

# Settings
$my_footer = $core->blog->settings->themes->glossyblueCSS3_footer;
$my_about = $core->blog->settings->themes->glossyblueCSS3_about;

# Footer type
$glossyblueCSS3_footer_combo = array(
	__('custom') => 'blogcustom',
	__('Recents posts and comments') => 'recents'
);

# About
$html_fileabout = path::real($core->blog->themes_path).'/'.$core->blog->settings->system->theme.'/tpl/_about.html';
$html_contentabout = is_file($html_fileabout) ? file_get_contents($html_fileabout) : '';

if (!is_file($html_fileabout) && !is_writable(dirname($html_fileabout))) {
	throw new Exception(
		sprintf(__('File %s does not exist and directory %s is not writable.'),
		$css_fileabout,dirname($html_fileabout))
	);
}

// POST ACTIONS

if (!empty($_POST))
{
	try
	{
		$core->blog->settings->addNamespace('themes');

		# Footer type
		if (!empty($_POST['glossyblueCSS3_footer']) && in_array($_POST['glossyblueCSS3_footer'],$glossyblueCSS3_footer_combo))
		{
			$my_footer = $_POST['glossyblueCSS3_footer'];

		} elseif (empty($_POST['glossyblueCSS3_footer']))
		{
			$my_footer = $default_footer;

		}
		$core->blog->settings->themes->put('glossyblueCSS3_footer',$my_footer,'string','Content footer',true);

		# About (txt dans le footer)
		if (!empty($_POST['glossyblueCSS3_about']))
		{
			$my_about = $_POST['glossyblueCSS3_about'];


		} elseif (empty($_POST['glossyblueCSS3_about']))
		{
			$my_about = $default_about;

		}
		$core->blog->settings->themes->put('glossyblueCSS3_about',$my_about,'boolean', 'Display About',true);

		if (isset($_POST['about']))
		{
			@$fp = fopen($html_fileabout,'wb');
			fwrite($fp,$_POST['about']);
			fclose($fp);
		}

		// Blog refresh
		$core->blog->triggerBlog();

		// Template cache reset
		$core->emptyTemplatesCache();

		dcPage::success(__('Theme configuration has been successfully updated.'),true,true);
	}
	catch (Exception $e)
	{
		$core->error->add($e->getMessage());
	}
}

//Display
# Footer
echo
'<div class="fieldset"><h4>'.__('Customizations').'</h4>'.
'<p class="field"><label>'.__('Content footer:').'</label>'.
form::combo('glossyblueCSS3_footer',$glossyblueCSS3_footer_combo,$my_footer).
'</p>'.
'<p class="info">'.__('Tickets and recent comments list the last 5 each.').'<br />'.
__('The additional component can accommodate 4 widgets.').'</p>'.
'</div>';

# About
echo
'<div class="fieldset"><h4>'.__('About').'</h4>'.
'<p>'.
	form::checkbox('glossyblueCSS3_about',1,$my_about).
	'<label class="classic" for="glossyblueCSS3_about">'.
		__('Display About').
	'</label>'.
'</p>';

echo
'<p class="area"><label for="about">'.__('Code:').' '.
form::textarea('about',60,10,html::escapeHTML($html_contentabout)).'</label></p>'.
'</div>';