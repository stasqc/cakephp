
<div id="page-container" class="row">

		<?php
                            if(isset($authUser) && $authUser == 'Admin')
                            {
                                echo '	<div id="sidebar" class="col-sm-3">'; //sidebar
                                echo '<div class="actions">';
                                echo '<div class="dropdown">';
                                echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">'.__('This author').'<span class="caret"></span></button>';
                                echo '<ul class="dropdown-menu">';
                                echo '<li>';
                                echo $this->Html->link(__('Edit this author'), array('action' => 'edit', $author['Author']['id']), array('class' => ''));
                                echo '</li>';
                                echo '<li>';
                                echo $this->Form->postLink(__('Delete this author'), array('action' => 'delete', $author['Author']['id']), array('class' => ''), __('Are you sure you want to delete %s?', $author['Author']['name']));
                                echo '</li>';
                                echo '<li>';
                                echo $this->Html->link(__('List all authors'), array('action' => 'index'), array('class' => ''));
                                echo '</li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';//actions end
                                echo '</div>';//end sidebar

                            }
                 ?>
	
	<div id="page-content" class="col-sm-9">
		
		<div class="authors view">

			<h2><?php  echo __('Author'); ?></h2>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>		<td><strong><?php echo __('Name'); ?></strong></td>
		<td>
			<?php echo h($author['Author']['name']); ?>
			&nbsp;
		</td>
</tr>				</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

					
			<div class="related">

				<h3><?php echo __('Related Books'); ?></h3>
				
				<?php if (!empty($author['Book'])): ?>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
		<th><?php echo __('ISBN'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('DatePublication'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php 
										$i = 0;
										foreach ($author['Book'] as $book): ?>
		<tr>
			<td><?php echo $book['isbn']; ?></td>
			<td><?php echo $book['title']; ?></td>
			<td><?php echo $book['datePublication']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'books', 'action' => 'view', $book['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php 
                                    //Si admin - peut modifier et supprimer. Si non, seulement voir.
                                    if(isset($user['role'])&& $user['role'] === 'Admin')
                                    {
                                        echo $this->Html->link(__('Edit'), array('controller' => 'books', 'action' => 'edit', $book['id']), array('class' => 'btn btn-default btn-xs'));
                                        echo $this->Form->postLink(__('Delete'), array('controller' => 'books', 'action' => 'delete', $book['id']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $book['id']));
                                    }
                                
                                 
                                ?>
				<?php 
                                 
                                ?>
			</td>
		</tr>
	<?php endforeach; ?>
							</tbody>
						</table><!-- /.table table-striped table-bordered -->
					</div><!-- /.table-responsive -->
					
				<?php endif; ?>

				

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
