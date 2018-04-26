<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

$layoutBasePath = Helper::getLayoutBase();
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));
?>
<dl class="gbjfamily_dl<?php echo $pageclass_sfx; ?>">
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'events')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'events_start')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'events_stop')); ?>
</dl>

<?php echo JHtml::_('bootstrap.startAccordion', 'slide-statistics', array('toggle' => true)); ?>

<?php echo JHtml::_('bootstrap.addSlide', 'slide-statistics',
	JText::_('COM_GBJFAMILY_FIELD_EVENT_DURATION_LABEL') . ' (' . JText::_('COM_GBJFAMILY_UNIT_HOURS') . ')',
	'duration'); ?>
<?php echo $this->loadTemplate('duration'); ?>
<?php echo JHtml::_('bootstrap.endSlide'); ?>

<?php echo JHtml::_('bootstrap.endAccordion'); ?>
