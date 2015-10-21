
<div id="page-container" class="row">

	
	<div id="page-content" class="col-sm-9">

		<h2><?php echo __('Add Book'); ?></h2>

		<div class="books form">
		
			<?php echo $this->Form->create('Book', array('type'=>'file','role' => 'form')); ?>

				<fieldset>

					<div class="form-group">
						<?php echo $this->Form->input('isbn', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('title', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('datePublication', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('author_id', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('cover_id', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
							<?php echo $this->Form->input('Category', array('multiple' => 'checkbox'));?>
					</div><!-- .form-group -->
					<div class="form-group">
							<?php echo $this->Form->input('filename', array('type'=>'file', 'class' => 'form-control'));?>
					</div><!-- .form-group -->

					<?php echo $this->Form->submit('Submit', array('class' => 'btn btn-large btn-primary')); ?>

				</fieldset>

			<?php echo $this->Form->end(); ?>

		</div><!-- /.form -->
			
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->