<div class="content">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-box-2 text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">List Part</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="nc-icon nc-box-2"></i> Check Now
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
                <i class="nc-icon nc-box text-success"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Request Part</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <a href="<?= BASEURL."Request_part"?>"><i class="fa fa-calendar-o"></i> Request Part List</a>
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
                <i class="nc-icon nc-box text-danger"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Pengambilan</p>
                <p class="card-title">23
                  <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-clock-o"></i> In the last hour
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
                <i class="nc-icon nc-box text-primary"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Report</p>
                <p class="card-title">+45K
                  <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-refresh"></i> Update now
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">List Parts</h5>
          <a class="btn btn-primary pull-right" href="<?=BASEURL?>Dashboards/excel" role="button">
                <i class="fa fa-file" aria-hidden="true"></i>
                Print Report
          </a>
        </div>
        <div class="card-body">
        <?php 
          if(isset($data['data']) && $data['data'] != NULL){
        ?>
            <table id="example" class="datatables table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Part Name</th>
                        <th>Stock</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                      $i = 1;
                      foreach ($data['data'] as $value) {
                        $url_img = BASEURL.'asset/img/part/'.$value['image'];
                        $url = ($value['image'] != '')? $url_img : BASEURL.'asset/img/logo-small.png';
                        $body = "
                                <tr>
                                  <td>".$i++."</td>
                                  <td>$value[part_name]</td>
                                  <td>$value[stock]</td>
                                  <td>
                                  <img src='$url' class='img-responsive image' style='height:60px'>
                                  </td>
                                </tr>
                                ";
                        echo $body;
                      }
                  ?>
                </tbody>
            </table>
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
