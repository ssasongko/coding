        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>
			<div class="row">
            <div class="col-lg-6">

            <?= form_error('menu','<div class="alert alert-danger">','</div>')?>	

            <?= $this->session->flashdata('message');?>

			<!-- Button trigger modal -->
				<a href="" class="btn btn-primary m-1" data-toggle="modal" data-target="#newMenuModal">+ Menu</a>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Action</th>
                  </tr>  
                </thead>
                <tbody>
                </tbody>
                  <?php $i = 1; ?>
                  <?php foreach($menu as $m) : ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?= $m['menu'];?></td>
                    <td>
                      <a href="" class="badge badge-success">edit</a>
                      <a href="" class="badge badge-danger">delete</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>  
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu');?>" method="post"> 
      <div class="modal-body">
       	<div class="form-group">
       		<input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
       	</div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>