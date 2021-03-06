<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019-2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

$layoutBasePath = Helper::getLayoutBase();
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));
$class = strtolower(Helper::getClassPrefix()) . '_dl' . $pageclass_sfx;

$this->item->periodfmt = JText::sprintf('LIB_GBJ_FORMAT_PERIOD_DATE',
	Helper::formatPeriodDates($this->item->date_on, $this->item->date_off)
);
?>
<dl class="<?php echo $class; ?>">
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field' => 'alias')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field' => 'id_unit')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field' => 'date_on')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field' => 'date_off')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field' => 'period')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field' => 'id_domain')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field' => 'id_info')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field' => 'id_project')); ?>
</dl>
