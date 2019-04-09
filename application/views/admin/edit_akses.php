        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>
          <div class="col-lg-12">
          <form class="user" method="post" action="<?= base_url('admin/edit_akses')?>">
          	<?php foreach($terpilih as $t) : ?>
          	<div class="jumbotron">
          	<h1><?=$t['nama']?></h1>
          	<label>Hak Akses : </label>

          	<input type="text" name="nomor" value="<?=$t['username']?>" hidden>
             <?= form_error('nomor','<small class="text-danger pl-3">','</small>')?>

          	<select id="hak" name="hak">?
          		<option value="<?= 1 ?>"
				<?php if($t['role_id'] == 1){
					echo "selected";
				}?>
          		>1 : Admin</option>
          		<option value="<?= 2 ?>"
          		<?php if($t['role_id'] == 2){
					echo "selected";
				}?>
				>2 : Operator</option>
          		<option value="<?= 3 ?>"
          		<?php if($t['role_id'] == 3){
					echo "selected";
				}?>
				>3 : Pegawai</option>
          	</select>
          	<button type="submit" class="badge badge-warning">Update</button>
          	<?php endforeach;?>
          </form>
          </div>
          </div>	
      </div>