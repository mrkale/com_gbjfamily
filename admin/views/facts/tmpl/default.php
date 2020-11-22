<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019-2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', '.multipleYears', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_YEAR')));
JHtml::_('formbehavior.chosen', '.multipleMonths', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_MONTH')));
JHtml::_('formbehavior.chosen', '.multipleYearoffs', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_YEAROFF')));
JHtml::_('formbehavior.chosen', '.multipleMonthoffs', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_MONTHOFF')));
JHtml::_('formbehavior.chosen', '.multipleUnits', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_UNIT')));
JHtml::_('formbehavior.chosen', '.multipleDomains', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_DOMAIN')));
JHtml::_('formbehavior.chosen', '.multipleInfos', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_INFO')));
JHtml::_('formbehavior.chosen', '.multipleProjects', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_PROJECT')));
JHtml::_('formbehavior.chosen', 'select');

$viewName = $this->getName();
$viewEdit = Helper::singular($this->getName());
$user = JFactory::getUser();
$layoutBasePath = Helper::getLayoutBase();

// Component parameters
$componentName = Helper::getName();
$cparams = JComponentHelper::getParams($componentName);
?>
<form action="<?php echo JRoute::_(Helper::getUrlView($viewName)); ?>" method="post" name="adminForm" id="adminForm">

<?php if (!empty($this->sidebar))
:
?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php
else
:
?>
<div id="j-main-container">
<?php endif; ?>
	<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

<?php if ($this->total > 0)
:
?>
	<table class="table table-striped" id="recordList">

	<?php if ($cparams->get('show_filter_stats'))
	:
	?>
		<caption style="text-align: left"><?php echo $this->htmlStatistics(); ?></caption>
	<?php endif; ?>
		<thead>
			<tr>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'state, featured', 'onlyone' => true)); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'title')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'alias')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'date_on, date_off')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'period')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'id_domain')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'id_info')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'id_project')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields' => 'modified')); ?>
			</tr>
		</thead>
	<?php if ($this->pagination->pagesTotal > 1)
	:
	?>
		<tfoot>
			<tr>
				<td <?php echo $this->htmlAttribute('colspan', $this->columns); ?>
				>
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	<?php endif; ?>
		<tbody>
	<?php foreach ($this->items as $this->item->sequence => $this->item)
	:
	?>
		<?php
		$this->item->periodfmt = JText::sprintf('LIB_GBJ_FORMAT_PERIOD_DATE',
			Helper::formatPeriodDates($this->item->date_on, $this->item->date_off)
		);
		?>
			<tr class="row<?php echo $this->item->sequence % 2; ?>">
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'state, featured')); ?>
				<?php echo JLayoutHelper::render('grid.items_edit', $this, $layoutBasePath, array('fields' => 'title')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'alias')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'date_on, date_off')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'period')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'id_domain')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'id_info')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'id_project')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields' => 'modified')); ?>
			</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo $this->getBatchForm(); ?>
<?php endif; ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
