
<div id="page-container" class="row">

	
	<div id="page-content" class="col-sm-9">

		<div class="books index">
		
			<h2><?php echo __('Books'); ?></h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
                                                    <th><?php echo __("Book");?></th>
							<th><?php echo $this->Paginator->sort('isbn'); ?></th>
							<th><?php echo $this->Paginator->sort('title'); ?></th>
							<th><?php echo $this->Paginator->sort('datePublication'); ?></th>
							<th><?php echo $this->Paginator->sort('author_id'); ?></th>
							<th><?php echo $this->Paginator->sort('cover_id'); ?></th>
                                                        <th><?php echo $this->Paginator->sort('categories');?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
<?php foreach ($books as $book): ?>
	<tr>
            <td><?php 
                if ($book['Book']['filename'] == null)
                {
                    $book['Book']['filename'] = "uploads/empty.jpg";
                }

                    echo $this->Html->image($book['Book']['filename'], array('escape' => false, 'width' => '90px', 'height' => '140px'));
                ?>
            </td>
		<td><?php echo h($book['Book']['isbn']); ?>&nbsp;</td>
		<td><?php echo h($book['Book']['title']); ?>&nbsp;</td>
		<td><?php echo h($book['Book']['datePublication']); ?>&nbsp;</td>
		<td>
			<?php
                        echo $this->Html->link($book['Author']['name'], array('controller' => 'authors', 'action' => 'view', $book['Author']['id'])); 
                        ?>
		</td>
		<td>
			<?php echo $book['Cover']['type']; ?>
		</td>
                <td>
                    
                    <?php
                    foreach($book['Category'] as $cat)
                    {
                        echo $this->Html->tag('span', $this->Html->link($cat['name'], array('controller' => 'categories', 'action' => 'view', $cat['id']), array('class' => '')).' ', array('class' => 'label label-info'))."&nbsp;";
                           echo "<br/>";
                        
                    }
                    ?>
                </td>
                
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $book['Book']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                    
                    <?php
                          if(isset($authUser) && $authUser == 'Admin')
                          {
                                        echo $this->Html->link(__('Edit'), array('action' => 'edit', $book['Book']['id']), array('class' => 'btn btn-default btn-xs')); 
                                        echo " ";
                                        echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $book['Book']['id']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $book['Book']['id']));
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