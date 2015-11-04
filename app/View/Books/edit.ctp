
<div id="page-container" class="row">

	
	<div id="page-content" class="col-sm-9">

		<h2><?php echo __('Edit Book'); ?></h2>

		<div class="books form">
		
			<?php
                        //test github
                        echo $this->Form->create('Book', array('type'=>'file','role' => 'form')) ?>
                    <?php
                    $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array('inline' => false));
                      $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array('inline' => false));
                      $this->Html->script('View/Books/add', array('inline' => false));
                        ?>
				<fieldset>
                                    

					<div class="form-group">
						<?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
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
						<?php echo $this->Form->input('authorName', array('type' => 'text', 'class' => 'form-control', 'id' => 'autocomplete', 'value' => $theAuthor)); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('cover_id', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
							<?php echo $this->Form->input('Category', array('multiple' => 'checkbox'));?>
					</div><!-- .form-group -->
					<?php echo $this->Form->submit('Submit', array('class' => 'btn btn-large btn-primary')); ?>

				</fieldset>

			<?php echo $this->Form->end(); ?>

		</div><!-- /.form -->
			
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->