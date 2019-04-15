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

<?php echo JHtml::_('bootstrap.startAccordion', 'slide-statistics', array('toggle' => true)); ?>

<?php echo JHtml::_('bootstrap.addSlide', 'slide-statistics', JText::_('COM_GBJFAMILY_EVENTS'),	'events'); ?>
<?php echo $this->loadTemplate('statistics_events'); ?>
<?php echo JHtml::_('bootstrap.endSlide'); ?>

<?php echo JHtml::_('bootstrap.addSlide', 'slide-statistics', JText::_('COM_GBJFAMILY_INCOMES'),	'incomes'); ?>
<?php echo $this->loadTemplate('statistics_incomes'); ?>
<?php echo JHtml::_('bootstrap.endSlide'); ?>

<?php echo JHtml::_('bootstrap.endAccordion'); ?>
