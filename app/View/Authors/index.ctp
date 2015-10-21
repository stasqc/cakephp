
<div id="page-container" class="row">

	
	<div id="page-content" class="col-sm-9">

		<div class="authors index">
		
			<h2><?php echo __('Authors'); ?></h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('name'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
<?php foreach ($authors as $author): ?>
	<tr>
		<td><?php echo h($author['Author']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $author['Author']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php
                                    if(isset($authUser) && $authUser == 'Admin')
                                    {
                                        echo $this->Html->link(__('Edit'), array('action' => 'edit', $author['Author']['id']), array('class' => 'btn btn-default btn-xs')); 
                                        echo " ";
                                        echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $author['Author']['id']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete %s?', $author['Author']['name']));
                                    }
                        
                         ?>
		</td>
	</tr>
<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			
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