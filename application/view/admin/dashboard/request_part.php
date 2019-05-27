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
          <h5 class="card-title">List Parts Workcenter</h5>
          <a class="btn btn-primary pull-right" href="<?=$data['url_add']?>" role="button">
                Add Request
                <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
        </div>
        <div class="card-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edited</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Submited</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Approved</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Rejected</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content my-4">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php 
              if(isset($data['data']) && $data['data'] != NULL){
            ?>
                <table class="datatables table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Request</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
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
                                        <td>
                                          <a name='update' id='' class='btn btn-sm btn-primary' href='".$data['url_submit'].$value['id_part_request']."' role='button'>
                                            <i class='fa fa-paper-plane' aria-hidden='true'></i>
                                            Submit Request
                                          </a>
                                          <a name='update' id='' class='btn btn-sm btn-secondary' href='".$data['url_preview'].$value['id_part_request']."' role='button'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                            Detail
                                          </a>
                                          <a name='delete' id='' class='btn btn-sm btn-danger' href='".$data['url_remove'].$value['id_part_request']."' role='button'>
                                            <i class='fa fa-trash-o' aria-hidden='true'></i>
                                            Delete
                                          </a>
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
                echo '<div class="alert alert-warning" role="alert">
                        <strong>No data.</strong>
                      </div>';
              } 
            ?>
            </div>
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <?php 
              if(isset($data['data_submit']) && $data['data_submit'] != NULL){
            ?>
                <table class="datatables table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Request</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          $i = 1;
                          foreach ($data['data_submit'] as $value) {
                            $date = date_format(date_create($value['date_creation']),"d/m/Y");
                            $body = "
                                    <tr>
                                        <td>".$i++."</td>
                                        <td>$date</td>
                                        <td>$value[deskripsi]</td>
                                        <td>
                                          <a name='update' id='' class='btn btn-sm btn-secondary' href='".$data['url_preview_detail'].$value['id_part_request']."' role='button'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                            Detail
                                          </a>
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
                echo '<div class="alert alert-warning" role="alert">
                        <strong>No data.</strong>
                      </div>';
              } 
            ?>
            </div>
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
            <?php 
              if(isset($data['data_approve']) && $data['data_approve'] != NULL){
            ?>
                <table class="datatables table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Request</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          $i = 1;
                          foreach ($data['data_approve'] as $value) {
                            $date = date_format(date_create($value['date_creation']),"d/m/Y");
                            $body = "
                                    <tr>
                                        <td>".$i++."</td>
                                        <td>$date</td>
                                        <td>$value[deskripsi]</td>
                                        <td>
                                          <a name='update' id='' class='btn btn-sm btn-secondary' href='".$data['url_preview_detail'].$value['id_part_request']."' role='button'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                            Detail
                                          </a>
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
                echo '<div class="alert alert-warning" role="alert">
                        <strong>No data.</strong>
                      </div>';
              } 
            ?>
            </div>
            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <?php 
              if(isset($data['data_reject']) && $data['data_reject'] != NULL){
            ?>
                <table id="example" class="datatables table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Request</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          $i = 1;
                          foreach ($data['data_reject'] as $value) {
                            $date = date_format(date_create($value['date_creation']),"d/m/Y");
                            $body = "
                                    <tr>
                                        <td>".$i++."</td>
                                        <td>$date</td>
                                        <td>$value[deskripsi]</td>
                                        <td>
                                          <a name='update' id='' class='btn btn-sm btn-primary' href='".$data['url_submit'].$value['id_part_request']."' role='button'>
                                            <i class='fa fa-paper-plane' aria-hidden='true'></i>
                                            Resubmit Request
                                          </a>
                                          <a name='update' id='' class='btn btn-sm btn-secondary' href='".$data['url_preview'].$value['id_part_request']."' role='button'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                            Detail
                                          </a>
                                          <a name='delete' id='' class='btn btn-sm btn-danger' href='".$data['url_remove'].$value['id_part_request']."' role='button'>
                                            <i class='fa fa-trash-o' aria-hidden='true'></i>
                                            Delete
                                          </a>
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
                echo '<div class="alert alert-warning" role="alert">
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
</div>