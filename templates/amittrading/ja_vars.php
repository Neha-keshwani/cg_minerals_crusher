<?php
/**
 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
include_once (dirname(__FILE__).DS.'/ja_templatetools.php');

$tmpTools = new JA_Tools($this);
$tmpTools->setColorThemes(array('default', 'green', 'cyan','red'));

# Auto Collapse Divs Functions ##########
$ja_left = $this->countModules( 'left' );
$ja_right = $this->countModules( 'right' );
$ja_masscol = $this->countModules('top');
if ( $ja_left && $ja_right ) {
  //2 columns on the right
	$divid = '';
} elseif ( ($ja_left || $ja_right) && !$ja_masscol ) {
  //One column without masscol
	$divid = '-c';
} elseif (($ja_left || $ja_right) && $ja_masscol) {
  //One column with masscol
	$divid = '-cm';
} elseif ($ja_masscol) {
  //masscol only
	$divid = '-m';
} else {
  //No column in right
	$divid = '-f';
}
?>