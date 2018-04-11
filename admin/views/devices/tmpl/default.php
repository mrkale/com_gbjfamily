<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', '.multipleNetworks', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_NETWORK')));
JHtml::_('formbehavior.chosen', '.multiplePorts', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_PORT')));
JHtml::_('formbehavior.chosen', '.multipleDevices', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_DEVICE')));
JHtml::_('formbehavior.chosen', '.multipleVendors', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_VENDOR')));
JHtml::_('formbehavior.chosen', '.multipleLocations', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_LOCATION')));
JHtml::_('formbehavior.chosen', 'select');

$viewName = $this->getName();
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
		<caption style="text-align: left"><?php echo JText::_('LIB_GBJ_FILTER_COUNT_LABEL') . $this->pagination->total; ?></caption>
		<?php endif; ?>
		<thead>
			<tr>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'state, featured', 'onlyone'=>true)); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'alias')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'brandname, serial, type')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'eth_mac, eth_ip4, eth_ifc')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'wifi_mac, wifi_ip4, wifi_ifc')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_network_alias')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_port_alias')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_device_alias')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_vendor_alias')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_location_alias')); ?>
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
			<tr class="row<?php echo $this->item->sequence % 2; ?>">
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'state, featured')); ?>
				<?php echo JLayoutHelper::render('grid.items_edit', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'alias')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'brandname, serial, type')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'eth_mac, eth_ip4, eth_ifc')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'wifi_mac, wifi_ip4, wifi_ifc')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_network_alias')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_port_alias')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_device_alias')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_vendor_alias')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_location_alias')); ?>
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
