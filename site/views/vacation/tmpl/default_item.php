<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

$layoutBasePath = Helper::getLayoutBase();
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));
$class = strtolower(Helper::getClassPrefix()). '_dl' . $pageclass_sfx;
?>
<dl class="<?php echo $class; ?>">
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'date_on')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'date_off')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'period')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'id_stay')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'id_staff')); ?>
</dl>
