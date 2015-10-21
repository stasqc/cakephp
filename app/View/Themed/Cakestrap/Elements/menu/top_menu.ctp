<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button><!-- /.navbar-toggle -->
		<?php echo $this->Html->Link(__('Library'), array('controller' => 'Books', 'action' => 'index'), array('class' => 'navbar-brand')); ?>
	</div><!-- /.navbar-header -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Link</a></li>
                        <li><?php echo $this->Html->Link(__('Books'), array('controller' => 'Books', 'action' => 'index')); ?></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Authors<b class="caret"></b></a>
				<ul class="dropdown-menu">
                                    <li><?php echo $this->Html->Link(__('Add'), array('controller' => 'Authors', 'action' => 'add')); ?></li>
                                    <li><?php echo $this->Html->Link(__('Show'), array('controller' => 'Authors', 'action' => 'index')); ?></li>
                                </ul>
                        </li>                        

                        
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
				<ul class="dropdown-menu">
                                    <li><?php echo $this->Html->Link(__('Add'), array('controller' => 'Categories', 'action' => 'add')); ?></li>
                                    <li><?php echo $this->Html->Link(__('Show'), array('controller' => 'Categories', 'action' => 'index')); ?></li>
                                </ul>
                        </li>      
                        
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Covers<b class="caret"></b></a>
				<ul class="dropdown-menu">
                                    <li><?php echo $this->Html->Link(__('Add'), array('controller' => 'Covers', 'action' => 'add')); ?></li>
                                    <li><?php echo $this->Html->Link(__('Show'), array('controller' => 'Covers', 'action' => 'index')); ?></li>
                                </ul>
                        </li>    
                        
                        
                        <li><?php echo $this->Html->Link(__('Users'), array('controller' => 'Users', 'action' => 'add')); ?></li>
                        <li><?php echo $this->Html->Link(__('Reservations'), array('controller' => 'Users', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->Link(__('Give rights'), array('controller' => 'Users', 'action' => 'add')); ?></li>
                        
                        <li>
                            <?php 
                            if(!$authUser)
                            {
                                echo $this->Html->Link(__('Login'), array('controller' => 'Users', 'action' => 'Login')); 
                            }
                            else
                            {
                                echo $this->Html->Link(__('Logout'), array('controller' => 'Users', 'action' => 'logout'));
                            }
                             
                            ?>
                        </li>
		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar navbar-default -->