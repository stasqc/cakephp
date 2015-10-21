
<div id="page-container" class="row">


		
		
               		
		<?php
                            if(isset($authUser) && $authUser == 'Admin')
                            {
                                echo '	<div id="sidebar" class="col-sm-3">'; //sidebar
                                echo '<div class="actions">';
                                echo '<div class="dropdown">';
                                echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">'.__('This book').'<span class="caret"></span></button>';
                                echo '<ul class="dropdown-menu">';
                                echo '<li>';
                                echo $this->Html->link(__('Edit this book'), array('action' => 'edit', $book['Book']['id']), array('class' => ''));
                                echo '</li>';
                                echo '<li>';
                                echo $this->Form->postLink(__('Delete this book'), array('action' => 'delete', $book['Book']['id']), array('class' => ''), __('Are you sure you want to delete %s?', $book['Book']['title']));
                                echo '</li>';
                                echo '<li>';
                                echo $this->Html->link(__('List all books'), array('action' => 'index'), array('class' => ''));
                                echo '</li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';//actions end
                                echo '</div>';//end sidebar

                            }
                 ?>
		
	
	<div id="page-content" class="col-sm-9">
		
		<div class="books view">

			<h2><?php  echo __('Book'); ?></h2>
                <?php 
                    if ($book['Book']['filename'] == null)
                    {
                        $book['Book']['filename'] = "uploads/empty.jpg";
                    }

                        echo $this->Html->image($book['Book']['filename'], array('escape' => false, 'width' => '180px', 'height' => '280px', 'class'=>'img-rounded'));
                        echo "<br/>";
                        echo "<br/>";
                ?>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>		
</tr><tr>		<td><strong><?php echo __('ISBN'); ?></strong></td>
		<td>
			<?php echo h($book['Book']['isbn']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Title'); ?></strong></td>
		<td>
			<?php echo h($book['Book']['title']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Date of publication'); ?></strong></td>
		<td>
			<?php echo h($book['Book']['datePublication']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Author'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($book['Author']['name'], array('controller' => 'authors', 'action' => 'view', $book['Author']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Cover'); ?></strong></td>
		<td>
			<?php echo h($book['Cover']['type']);  ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

					
			<div class="related">

				<h3><?php echo __('Categories'); ?></h3>
				
				<?php if (!empty($book['Category'])): ?>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
		<th><?php echo __('Name'); ?></th>
									
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($book['Category'] as $category): ?>
		<tr>
			<td><?php
                        //echo $category['name'];
                        echo $this->Html->link($category['name'], array('controller' => 'categories', 'action' => 'view', $category['id']), array('class' => ''));
                        ?></td>
		</tr>
	<?php endforeach; ?>
							</tbody>
						</table><!-- /.table table-striped table-bordered -->
					</div><!-- /.table-responsive -->
					
				<?php endif; ?>

			
				


			
	</div><!-- /#page-content .span9 -->
        
        		<?php
                            //Seulement les users et admin peuvent emprunter des livres
                            if(isset($authUser) && $authUser == 'User')
                            {
                                echo $this->Form->create(null, array('role' => 'form', 'url' => array('controller' => 'reservations', 'action' => 'add')));
                                echo $this->Form->input(null, array('type' => 'hidden', 'name' => 'bookID', 'value' => $book['Book']['id']));
                                echo $this->Form->submit(__('Reserve book'), array('class' => 'btn btn-large btn-primary'));
                                echo $this->Form->end();                        

                            }

                        ?>

</div><!-- /#page-container .row-fluid -->
