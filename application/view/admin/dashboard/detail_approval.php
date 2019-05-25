<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title">Detail Approval Pengajuan</h5>
            <a class="btn btn-primary" href="<?=BASEURL?>Approval_pengajuan" role="button">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
            </a>
        </div>
        <div class="card-body">
        <?php 
          if(isset($data['detail']) && $data['detail'] != NULL){
        ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Part Name</th>
                        <th>Part Number</th>
                        <th>Model</th>
                        <th>Request Stock</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                      $i = 1;
                      foreach ($data['detail'] as $value) {
                        $body = "
                                <tr>
                                  <td>".$i++."</td>
                                  <td>$value[part_name]</td>
                                  <td>$value[part_number]</td>
                                  <td>$value[model]</td>
                                  <td>$value[stock]</td>
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
        <div class="card-footer">
            <?php if(isset($data['detail']) && $data['detail'] != NULL){ ?>
            <a class="btn btn-primary" href="<?= $data['url_approve'].$data['data']['id_part_request']?>" role="button">
                <i class="fa fa-check" aria-hidden="true"></i>
                Approve
            </a>
            <a class="btn btn-danger" href="<?= $data['url_reject'].$data['data']['id_part_request']?>" role="button">
                <i class="fa fa-times" aria-hidden="true"></i>
                Reject
            </a>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>