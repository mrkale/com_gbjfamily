<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2018 Libor Gabaj
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

// Agenda parameters
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
		<caption><?php echo JText::_('LIB_GBJ_FILTER_COUNT_LABEL') . $this->pagination->total; ?></caption>
		<?php endif; ?>
		<thead>
			<tr>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'alias')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'brandname, serial')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'eth_mac, eth_ip4, eth_ifc')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'wifi_mac, wifi_ip4, wifi_ifc')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_device')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_vendor')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_location')); ?>
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
			<tr <?php echo ($this->item->featured ? $this->htmlAttribute('class', $featuredClass) : ''); ?>>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.items_detail', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'alias')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'brandname, serial')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'eth_mac, eth_ip4, eth_ifc')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'wifi_mac, wifi_ip4, wifi_ifc')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_device')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_vendor')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_location')); ?>
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
