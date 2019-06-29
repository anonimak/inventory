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
          <h5 class="card-title">List Pengambilan Part</h5>
          <a class="btn btn-primary pull-right" href="<?=$data['url_add']?>" role="button">
                Add
                <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
          <!-- Button to Open the Modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Open modal
          </button>
        </div>
        <div class="card-body">
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
        </div>
      </div>
    </div>
  </div>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="request_part_form" action="<?=$data['action']?>" method="post" action method novalidate="novalidate">
          <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" rows="5"></textarea>
              </div>
              </div>
          </div>
          <div class="row">
              <div class="update ml-auto mr-auto">
              <button type="submit" class="btn btn-primary btn-round">Submit</button>
              </div>
          </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>