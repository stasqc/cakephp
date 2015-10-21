
<div id="page-container" class="row">

		<?php
                            if(isset($authUser) && $authUser == 'Admin')
                            {
                                echo '	<div id="sidebar" class="col-sm-3">'; //sidebar
                                echo '<div class="actions">';
                                echo '<div class="dropdown">';
                                echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">'.__('This cover').'<span class="caret"></span></button>';
                                echo '<ul class="dropdown-menu">';
                                echo '<li>';
                                echo $this->Html->link(__('Edit this cover'), array('action' => 'edit', $cover['Cover']['id']), array('class' => ''));
                                echo '</li>';
                                echo '<li>';
                                echo $this->Form->postLink(__('Delete this cover'), array('action' => 'delete', $cover['Cover']['id']), array('class' => ''), __('Are you sure you want to delete %s?', $cover['Cover']['type']));
                                echo '</li>';
                                echo '<li>';
                                echo $this->Html->link(__('List all covers'), array('action' => 'index'), array('class' => ''));
                                echo '</li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';//actions end
                                echo '</div>';//end sidebar

                            }
                 ?>
	
	<div id="page-content" class="col-sm-9">
		
		<div class="covers view">

			<h2><?php  echo __('Cover'); ?></h2>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>		<td><strong><?php echo __('Type'); ?></strong></td>
		<td>
			<?php echo h($cover['Cover']['type']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

					

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
