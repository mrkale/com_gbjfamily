<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

JHtml::_('behavior.core');
JHtml::_('behavior.keepalive');

$layoutBasePath = Helper::getLayoutBase();

// Component parameters
$cparams = JComponentHelper::getParams(Helper::getName());
$featuredClass = $cparams->get('featured_row_class');

// Expense parameters
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));
$showDesc = $tparams->get('show_itemdescription');
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">

<?php if ($tparams->get('show_filter_bar')) : ?>
	<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
<?php endif; ?>
<?php if ($this->total > 0) : ?>
		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" value="" />
		<input type="hidden" name="limitstart" value="" />
		<input type="hidden" name="task" value="" />

	<div class="table-responsive">
	<table class="table table-hover gbjfamily_table<?php echo $pageclass_sfx; ?>" id="recordList">
		<?php if ($tparams->get('show_filter_stats')) : ?>
			<caption><?php echo $this->htmlStatistics(); ?></caption>
		<?php endif; ?>
		<thead>
			<tr>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'date_on, date_off, period')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'date_out, lifespan')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'quantity')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'price')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_domain, id_project')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_commodity, id_type')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_vendor, id_location')); ?>
			<?php if ($showDesc) : ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'description')); ?>
			<?php endif; ?>

			</tr>
		</thead>
		<tfoot>
			<tr>
				<td <?php echo $this->htmlAttribute('colspan', $this->columns); ?>
				>
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $this->item->sequence => $this->item) : ?>
			<?php
				$this->item->sequence += $this->pagination->limitstart;
				$this->item->quantity = (float)$this->item->quantity;
				$this->item->period = Helper::formatNumberUnit($this->item->period, 'LIB_GBJ_FORMAT_DAYS');
				$this->item->lifespan = Helper::formatNumberUnit($this->item->lifespan, 'LIB_GBJ_FORMAT_DAYS');
				$this->item->lifeperiod = Helper::formatPeriodDates(
					Helper::getProperDate($this->item->date_off, $this->item->date_on),
					$this->item->date_out);
			?>
			<tr <?php echo ($this->item->featured ? $this->htmlAttribute('class', $featuredClass) : ''); ?>>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.items_detail', $this, $layoutBasePath, array('fields'=>'date_on, date_off, period')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'date_out, lifespan')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'quantity')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'price, price_unit, price_orig')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_domain, id_project')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_commodity, id_type')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_vendor, id_location')); ?>
			<?php if ($showDesc) : ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'description')); ?>
			<?php endif; ?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	</div>
<?php endif; ?>
</form>
