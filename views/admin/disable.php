<section class="title">
	<h4><?php echo lang('sitemappy.disable_page'); ?></h4>
</section>
<section class="item">
	<?php echo form_open(uri_string(), 'class="crud"'); ?>
		<div class="tabs">
		
			<ul class="tab-menu">
				<li><a href="#sitemappy-disable_page"><span><?php echo lang('sitemappy.disable_page'); ?></span></a></li>
			</ul>
			
			<div class="form_inputs" id="sitemappy-disable_page">
			
			<fieldset>
			
				<ul>
					<li class="<?php echo alternator('', 'even'); ?>">
						<label for="page_id"><?php echo lang('sitemappy.page'); ?>  <span>*</span></label>
						<div class="input"><?php echo form_dropdown('page_id', array(lang('global:select-pick')) + $pages,'', 'id="page_id" class="required"'); ?></div>
					</li>	
				</ul>
				</fieldset>
	
			</div>
	
		</div>
	
		<div class="buttons align-right padding-top">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
		</div>
	
	<?php echo form_close(); ?>
	
</section>