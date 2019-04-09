<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('auth')?>">
        <span class="fas fa-home"></span>
        <div class="sidebar-brand-text mx-3">Codingan</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Query Menu -->
      <?php

      $role_id = $this->session->userdata('role_id');

      $q = "SELECT `user_menu`.`id` , `menu`
      		FROM `user_menu` JOIN `user_access_menu`
      		ON `user_menu`.id = `user_access_menu`.`menu_id`
      		WHERE `user_access_menu`.`role_id` = $role_id 
			ORDER BY `user_access_menu`.`menu_id` ASC
      		";
      $menu = $this->db->query($q)->result_array();
      ?>

      <!-- Looping -->
      <?php foreach ($menu as $m) : ?>
      <div class="sidebar-heading">
      	<?= $m['menu']; ?>
      </div>
	
	  <?php
	  	$q1 = "SELECT *
	  			FROM `user_sub_menu` JOIN `user_menu`
	  			ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
	  			WHERE `user_sub_menu`.`menu_id` = {$m['id']} 
	  			AND `user_sub_menu`.`is_active` = 
	  			1";
	  	$q2 = $this->db->query($q1)->result_array();  		
	  ?>

		<?php foreach($q2 as $qq): ?>
      <?php if($title == $qq['title']) : ?>
	     <li class="nav-item active">
      <?php else : ?>
        <li class="nav-item">
      <?php endif; ?>    
	        <a class="nav-link" href="<?= base_url($qq['url']);?>">
	          <i class="<?= $qq['icon'];?>"></i>
	          <span><?= $qq['title']; ?></span></a>
	      </li> 			
		<?php endforeach; ?>

  	  <?php endforeach; ?>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
<!-- End of Sidebar