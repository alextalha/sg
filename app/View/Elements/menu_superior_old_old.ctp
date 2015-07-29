
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-target=".nav-collapse"
				data-toggle="collapse"> <span class="icon-bar"></span> <span
				class="icon-bar"></span> <span class="icon-bar"></span>
			</a>
			<div class="container nav-collapse">
				<?php if ($this->session->read('UserAuth.Usuario')) : ?>
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>BPO </b><i class="icon-icon icon-caret-down"></i></a>
						<ul class='dropdown-menu'>
							<li class="cabecalho">MENU DO SISTEMA</li>
							<?php echo $this->element('menus_menu'); ?>	
							<li class="dropdown-submenu">
								<a href="#" class="dropdown-toggle"	data-toggle="dropdown">Relatórios</a>
								<ul class='dropdown-menu'>
									<li class="dropdown-submenu">
										<a href="#" class="dropdown-toggle"	data-toggle="dropdown">Relatórios</a>

										<ul class='dropdown-menu'>
											<?php echo $this->element('elementos_menu',array('cache' => '+1 hour')); ?>
										</ul>
									</li>
									<li class="dropdown-submenu">
										<a href="#" class="dropdown-toggle"	data-toggle="dropdown">Pivots</a>
										<ul class='dropdown-menu'>
											<?php echo $this->element('elementos_menu',array('cache' => '+1 hour','elemento'=>'Pivot')); ?>
										</ul>
									</li>
									<li class="dropdown-submenu">
										<a href="#" class="dropdown-toggle"	data-toggle="dropdown">BPM</a>
										<ul class='dropdown-menu'>
											<?php echo $this->element('bpm_menu',array('cache' => '+1 hour')); ?>
										</ul>
									</li>
								</ul>
							</li>
		
						</ul>
					</li>	
				</ul>
				<?php endif; ?>
				<ul class="nav pull-right">
					<?php if ($this->session->read('UserAuth.Usuario')) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle"	data-toggle="dropdown">Bem Vindo <strong><?php echo $this->session->read('UserAuth.Usuario.first_name');?></strong><i class="icon-icon icon-caret-down"></i></a>
						<ul class='dropdown-menu'>
							<?php echo $this->element('perfil_menu',array('cache' => '+1 hour')); ?>
						</ul>
					</li>
					<?php } ?>

					<li class="dropdown menu_buttons">
						<?php 
							if ($this->session->read('UserAuth.Usuario')) {
								echo $this->element('icon', array('url'=>$this->Html->url(array('controller'=>'usuarios','action'=>'logout')),'title'=>'Logout do sistema','icon'=>'times-circle','text'=>'','sembotao'=>true));
								echo $this->element('icon', array('url'=>$this->Html->url("/"),'title'=>'Página Inicial','icon'=>'home','text'=>'','sembotao'=>true));	 
							} 
							else echo $this->Html->link(__('Sign In'), '#',array('id'=>'link-login'));
						?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() {
	$("#link-login").on("click",function() {
		$("#login").dialog("open");
	});
});
</script>