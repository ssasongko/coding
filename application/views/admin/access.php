        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>
          <p>Menu ini untuk mengelola akses akun yang telah terdaftar</p>
			<div class="row">
            <div class="col-lg-6">

            <?= form_error('menu','<div class="alert alert-danger">','</div>')?>	

            <?= $this->session->flashdata('message');?>

			<!-- Button trigger modal -->
				<!-- <a href="" class="btn btn-primary m-1" data-toggle="modal" data-target="#newMenuModal">+ Menu</a> -->

			<form action="<?= base_url('admin/access');?>" method="post"> 
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Hak Akses</th>
                    <th>Action</th>
                  </tr>  
                </thead>
                <tbody>
                </tbody>
                  <?php $i = 1; ?>
                  <?php foreach($menu as $m) : ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?= $m['nama'];?></td>
                    <td><?= $m['role_id'];?></td>
                    <td>
                      <a href="<?= base_url('admin/edit_akses/').$m['id']?>" class="badge badge-success">Edit</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
             </form> 
            </div>  
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
<!-- End of Main Content -->

<!-- Modal
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kelola Akses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/edit_akses');?>" method="post"> 
      <div class="modal-body">
       	<div class="form-group">
       		<input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
       		<select name="akses" id="akses">
       			<?php foreach ($dika as $r) : ?>
       			<option value="<?=$r['role_id']?>"><?=$r['role_id']?></option>
       		<?php endforeach;?>
       		</select>

       	</div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div> -->