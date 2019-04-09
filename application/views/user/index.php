        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message')?>
            </div>
          </div>

          <h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="<?= base_url('assets/img/profil/') . $petugas['gambar']?>" class="card-img" alt="Gambarku">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h3 class="card-title"><?php $y = $petugas['role_id'];if($y == 1){echo "Administrator";}elseif($y == 2){echo "Operator";}else{
                    echo "Peminjam";}?></h3>
                  <h5 class="card-title"><?= "Nama  : " . $petugas['nama']?></h5>
                  <h6 class="card-title"><?= "Username  : " . $petugas['username']?></h5>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

