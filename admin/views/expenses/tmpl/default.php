<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', '.multipleYears', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_EXPENSE_YEAR')));
JHtml::_('formbehavior.chosen', '.multipleMonths', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_EXPENSE_MONTH')));
JHtml::_('formbehavior.chosen', '.multipleYearoffs', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_EXPENSE_YEAROFF')));
JHtml::_('formbehavior.chosen', '.multipleYearouts', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_EXPENSE_YEAROUT')));
JHtml::_('formbehavior.chosen', '.multipleMonthoffs', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_EXPENSE_MONTHOFF')));
JHtml::_('formbehavior.chosen', '.multipleMonthouts', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_EXPENSE_MONTHOUT')));
JHtml::_('formbehavior.chosen', '.multipleDomains', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_DOMAIN')));
JHtml::_('formbehavior.chosen', '.multipleCurrencies', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_CURRENCY')));
JHtml::_('formbehavior.chosen', '.multipleUnits', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_UNIT')));
JHtml::_('formbehavior.chosen', '.multipleCommodities', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_COMMODITY')));
JHtml::_('formbehavior.chosen', '.multipleTypes', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_TYPE')));
JHtml::_('formbehavior.chosen', '.multipleVendors', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_VENDOR')));
JHtml::_('formbehavior.chosen', '.multipleLocations', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_LOCATION')));
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
<?php if (!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif; ?>
	<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
<?php if ($this->total > 0) : ?>
	<table class="table table-striped" id="recordList">
		<?php if ($cparams->get('show_filter_stats')) : ?>
			<caption style="text-align: left"><?php echo $this->htmlStatistics(); ?></caption>
		<?php endif; ?>
		<thead>
			<tr>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'state, featured', 'onlyone'=>true)); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'date_on, date_off, period')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'date_out, lifespan')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'quantity')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'price, price_unit, price_orig')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_domain, id_location, id_project')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_commodity, id_type, id_vendor')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'modified')); ?>
			</tr>
		</thead>
	<?php if ($this->pagination->pagesTotal > 1) : ?>
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
		<?php foreach ($this->items as $this->item->sequence => $this->item): ?>
			<?php
				$this->item->quantity = (float)$this->item->quantity;
				$this->item->period = Helper::formatNumberUnit($this->item->period, 'LIB_GBJ_FORMAT_DAYS');
				$this->item->lifespan = Helper::formatNumberUnit($this->item->lifespan, 'LIB_GBJ_FORMAT_DAYS');
				$this->item->lifeperiod = Helper::formatPeriodDates(
					Helper::getProperDate($this->item->date_off, $this->item->date_on),
					$this->item->date_out);
			?>
			<tr class="row<?php echo $this->item->sequence % 2; ?>">
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'state, featured')); ?>
				<?php echo JLayoutHelper::render('grid.items_edit', $this, $layoutBasePath, array('fields'=>'date_on, date_off, period')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'date_out, lifespan')); ?>
				<?php echo JLayoutHelper::render('grid.items_nodesc', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'quantity')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'price, price_unit, price_orig')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_domain, id_location, id_project')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_commodity, id_type, id_vendor')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'modified')); ?>
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
