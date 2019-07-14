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
          <a id="btn-add" class="btn btn-primary pull-right" href="<?=$data['url_add']?>" role="button">
                Add
                <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
        </div>
        <div class="card-body">
        <?php 
              if(isset($data['data']) && $data['data'] != NULL){
            ?>
                <table class="datatables table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengambilan</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          $i = 1;
                          foreach ($data['data'] as $value) {
                            $date = date_format(date_create($value['tgl']),"d/m/Y");
                            $body = "
                                    <tr>
                                        <td>".$i++."</td>
                                        <td>$date</td>
                                        <td>$value[deskripsi]</td>
                                        <td>
                                          <a name='update' id='' class='btn btn-sm btn-secondary' href='".$data['url_preview'].$value['id']."' role='button'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                            Detail
                                          </a>
                                          <a name='delete' id='' class='btn btn-sm btn-danger' href='".$data['url_remove'].$value['id']."' role='button'>
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