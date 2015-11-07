
<div id="page-container" class="row">

	
	<div id="page-content" class="col-sm-9">

		<div class="reservations index">
		
			<h2><?php echo __('Reservations'); ?></h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
                                                        <th><?php echo __('Title') ?></th>
                                                        <th><?php echo __('E-mail') ?></th>
							<th><?php echo $this->Paginator->sort('dateTaken'); ?></th>
							<th><?php echo $this->Paginator->sort('dateDue'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
                                            
<?php 
    for($i=0; $i<sizeof($reservations); $i++)
    {
        echo '<tr>';
        echo '<td>';
        echo h($theBookUsers[$i]['Book']['title']);
        echo '</td>';
        echo '<td>';
        echo h($theBookUsers[$i]['User']['email']);
        echo '</td>';
        echo '<td>';
        echo h($reservations[$i]['Reservation']['dateTaken']);
        echo '</td>';
        echo '<td>';
        echo h($reservations[$i]['Reservation']['dateDue']);
        echo '</td>';
        echo '<td class="actions">';
        if($authUser == 'Admin')
        {
           echo $this->Form->postLink(__('Delete Reservation'), array('action' => 'delete', $reservations[$i]['Reservation']['id'], $reservations[$i]['Reservation']['books_users_id']), array('class' => ''), __('Are you sure you want to delete this reservation?'));
        }
        
        echo '</td>';
        echo '</tr>';
        
    }
    
    
    
    ?>

        
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			<?php
                            if(isset($notConfirmed))
                            {
                                echo $this->Html->link(__('Re-send confirmation e-mail'), array('controller' => 'users', 'action' => 'resend'));
                            }
                        ?>
			<p><small>
				<?php
					echo $this->Paginator->counter(array(
					'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
					));
				?>
			</small></p>

			<ul class="pagination">
				<?php
					echo $this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
					echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));
					echo $this->Paginator->next(__('Next') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
				?>
			</ul><!-- /.pagination -->
			
		</div><!-- /.index -->
	
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->