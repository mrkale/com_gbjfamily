<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018-2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

$layoutBasePath = Helper::getLayoutBase();
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));
?>

<?php echo JHtml::_('bootstrap.startTabSet', 'tab-statistics', array('toggle' => true, 'active' => 'expenses')); ?>

<?php echo JHtml::_('bootstrap.addTab', 'tab-statistics', 'expenses', JText::_('COM_GBJFAMILY_EXPENSES')); ?>
<?php echo $this->loadTemplate('statistics_expenses'); ?>
<?php echo JHtml::_('bootstrap.endTab'); ?>

<?php echo JHtml::_('bootstrap.addTab', 'tab-statistics', 'events' , JText::_('COM_GBJFAMILY_EVENTS')); ?>
<?php echo $this->loadTemplate('statistics_events'); ?>
<?php echo JHtml::_('bootstrap.endTab'); ?>

<?php echo JHtml::_('bootstrap.addTab', 'tab-statistics', 'incomes', JText::_('COM_GBJFAMILY_INCOMES')); ?>
<?php echo $this->loadTemplate('statistics_incomes'); ?>
<?php echo JHtml::_('bootstrap.endTab'); ?>

<?php echo JHtml::_('bootstrap.endTabSet'); ?>
