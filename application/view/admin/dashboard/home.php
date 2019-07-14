<div class="content">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-box text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Part Masuk</p>
                  <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <a href="<?= BASEURL."Part_masuk" ?>">
              <i class="fa fa-refresh"></i> Check Part
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-box-2 text-success"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">List Part</p>
                  <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <a href="<?= BASEURL."List_part" ?>">
              <i class="nc-icon nc-box-2"></i> Detail Here
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-single-02 text-danger"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Supplier</p>
                  <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <a href="<?= BASEURL."Supplier" ?>">
              <i class="fa fa-user"></i> Detail Here
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-paper text-primary"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Report Item</p>
                  <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <a href="<?= BASEURL."Report_item_keluar" ?>">
              <i class="fa fa-refresh"></i> Check Here
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php
  if($data['alert'] == "error"){ 
      $alert = "danger";
      $alert_display = "show";
  } elseif($data['alert'] == "success"){ 
      $alert = "success";
      $alert_display = "show";
  } else{
      $alert = "danger";
      $alert_display = "d-none";
  }
?>

<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-<?= $alert; ?> alert-dismissible fade <?= $alert_display; ?>" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <strong><?= ucfirst($data['alert']) ?></strong> 
          <?= $data['msg'] ?>
      </div>
      <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title">Approval Pengajuan</h5>
        </div>
        <div class="card-body">
        <?php 
          if(isset($data['data']) && $data['data'] != NULL){
        ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                      $i = 1;
                      foreach ($data['data'] as $value) {
                        $date = date_format(date_create($value['date_creation']),"d/m/Y");
                        $body = "
                                <tr>
                                  <td>".$i++."</td>
                                  <td>$date</td>
                                  <td>$value[deskripsi]</td>
                                </tr>
                                ";
                        echo $body;
                      }
                  ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="<?= $data["url_Approve"]?>" role="button">See Detail</a>
            <?php
          } else {
            echo '<div class="alert alert-info" role="alert">
                    <strong>No data.</strong>
                  </div>';
          } 
        ?>
        </div>
      </div>
    </div>
  </div>
</div>

</div>