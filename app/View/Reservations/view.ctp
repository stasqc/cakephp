
<div id="page-container" class="row">

	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
			
			<ul class="list-group">			
						<li class="list-group-item"><?php echo $this->Html->link(__('Edit Reservation'), array('action' => 'edit', $reservation['Reservation']['id']), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Form->postLink(__('Delete Reservation'), array('action' => 'delete', $reservation['Reservation']['id']), array('class' => ''), __('Are you sure you want to delete # %s?', $reservation['Reservation']['id'])); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Reservations'), array('action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Reservation'), array('action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Books Users'), array('controller' => 'books_users', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Books Users'), array('controller' => 'books_users', 'action' => 'add'), array('class' => '')); ?> </li>
				
			</ul><!-- /.list-group -->
			
		</div><!-- /.actions -->
		
	</div><!-- /#sidebar .span3 -->
	
	<div id="page-content" class="col-sm-9">
		
		<div class="reservations view">

			<h2><?php  echo __('Reservation'); ?></h2>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($reservation['Reservation']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('DateTaken'); ?></strong></td>
		<td>
			<?php echo h($reservation['Reservation']['dateTaken']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('DateDue'); ?></strong></td>
		<td>
			<?php echo h($reservation['Reservation']['dateDue']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('DateReturned'); ?></strong></td>
		<td>
			<?php echo h($reservation['Reservation']['dateReturned']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Books Users'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($reservation['BooksUsers']['id'], array('controller' => 'books_users', 'action' => 'view', $reservation['BooksUsers']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
