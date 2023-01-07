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

if (!defined('DC_CONTEXT_ADMIN')) exit;

l10n::set(__DIR__ . '/locales/' . dcCore::app()->lang . '/main');

# Default values
$default_footer = 'blogcustom';
$default_about = false;

# Settings
$my_footer = dcCore::app()->blog->settings->themes->glossyblueCSS3_footer;
$my_about = dcCore::app()->blog->settings->themes->glossyblueCSS3_about;

# Footer type
$glossyblueCSS3_footer_combo = array(
	__('custom') => 'blogcustom',
	__('Recents posts and comments') => 'recents'
);

# About
$html_fileabout = path::real(dcCore::app()->blog->themes_path).'/'.dcCore::app()->blog->settings->system->theme.'/tpl/_about.html';

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
		dcCore::app()->blog->settings->addNamespace('themes');

		# Footer type
		if (!empty($_POST['glossyblueCSS3_footer']) && in_array($_POST['glossyblueCSS3_footer'],$glossyblueCSS3_footer_combo))
		{
			$my_footer = $_POST['glossyblueCSS3_footer'];

		} elseif (empty($_POST['glossyblueCSS3_footer']))
		{
			$my_footer = $default_footer;

		}
		dcCore::app()->blog->settings->themes->put('glossyblueCSS3_footer',$my_footer,'string','Content footer',true);

		# About (txt dans le footer)
		if (!empty($_POST['glossyblueCSS3_about']))
		{
			$my_about = $_POST['glossyblueCSS3_about'];


		} elseif (empty($_POST['glossyblueCSS3_about']))
		{
			$my_about = $default_about;

		}
		dcCore::app()->blog->settings->themes->put('glossyblueCSS3_about',$my_about,'boolean', 'Display About',true);

		if (isset($_POST['about']))
		{
			@$fp = fopen($html_fileabout,'wb');
			fwrite($fp,$_POST['about']);
			fclose($fp);
		}

		// Blog refresh
		dcCore::app()->blog->triggerBlog();

		// Template cache reset
		dcCore::app()->emptyTemplatesCache();

		dcPage::success(__('Theme configuration has been successfully updated.'),true,true);
	}
	catch (Exception $e)
	{
		dcCore::app()->error->add($e->getMessage());
	}
}

$html_contentabout = is_file($html_fileabout) ? file_get_contents($html_fileabout) : '';

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
