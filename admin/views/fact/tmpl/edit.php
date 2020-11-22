<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019-2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');

$tabSetName = 'editTabSet';
$tabNameDetails = 'details';
$tabNamePublishing = 'publishing';
$tabNameActive = $tabNameDetails;
?>

<form action="<?php echo JRoute::_(
	Helper::getUrl(
		array(
			'layout' => Helper::COMMON_LAYOUT_EDIT,
			'id' =>	(int) $this->item->id
		)
	)
);?>"
	method="post" name="adminForm" id="adminForm" class="form-validate">
	<?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', $tabSetName, array('active' => $tabNameActive)); ?>

		<?php echo JHtml::_('bootstrap.addTab', $tabSetName, $tabNameDetails, $this->getTabRecord()); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span9">
			<?php echo $this->form->renderField('id_unit'); ?>
			<?php echo $this->form->renderField('date_on'); ?>
			<?php echo $this->form->renderField('date_off'); ?>
			<?php echo $this->form->renderField('period'); ?>
			<?php echo $this->form->renderField('id_domain'); ?>
			<?php echo $this->form->renderField('id_info'); ?>
			<?php echo JLayoutHelper::render('record.field_parent', $this, Helper::getLayoutBase(), array('field' => 'id_project')); ?>
			<?php echo $this->form->renderField('description'); ?>
			</div>
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', $tabSetName, $tabNamePublishing, JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>
</form>
