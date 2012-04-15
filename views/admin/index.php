<section class="title">
	<h4><?php echo lang('sitemappy.disable_page_label'); ?></h4>
</section>

<section class="item">
	<?php echo form_open('admin/sitemappy/available');?>
	
	<?php if ( ! empty($disable_pages)): ?>
	
		<table border="0" class="table-list">
			<thead>
				<tr>
					<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
					<th><?php echo lang('sitemappy.page_slug'); ?></th>
					<th><?php echo lang('sitemappy.page_operations'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach( $disable_pages as $page ): 
						$page_def = $this->page_m->get($page->page_id);
				?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $page->page_id); ?></td>
					<td><?php echo $page_def->slug; ?></td>
					<td class="align-center buttons buttons-small">
						<?php echo anchor('admin/sitemappy/available/'.$page_def->id,lang('sitemappy.disable_button'),'class="button"'); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	
		<div class="table_action_buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
		</div>
	
	<?php else: ?>
		<div class="blank-slate">
			<div class="no_data">
				<?php echo lang('sitemappy.no_disable_pages'); ?>
			</div>
		</div>
	<?php endif;?>
	
	<?php echo form_close(); ?>
</section>