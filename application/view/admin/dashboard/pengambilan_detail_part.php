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
            <h5 class="card-title"><?= $data['title']?></h5>
            <a class="btn btn-primary" href="<?=BASEURL?>Pengambilan_part" role="button">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
            </a>
            <a class="btn btn-primary pull-right" href="<?=BASEURL?>Pengambilan_part/add_detail/<?=$data['id_detail']?>" role="button">
                Add data
                <i class="fa fa-plus-square" aria-hidden="true"></i>
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
                        <th>Unique No</th>
                        <th>Part Name</th>
                        <th>Part Number</th>
                        <th>Qty</th>
                        <th>Image</th>
                        <th>Action</th>
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
                                    <td>$value[uniq_no]</td>
                                    <td>$value[part_name]</td>
                                    <td>$value[part_number]</td>
                                    <td>$value[qty_pengambilan]</td>
                                    <td>
                                    <img src='$url' class='img-responsive image' style='height:60px'>
                                    </td>
                                    <td>
                                        <a name='delete' id='' class='btn btn-sm btn-danger' href='".$data['url_remove'].$value['id_d_pengambilan']."' role='button'>
                                        <i class='fa fa-trash-o' aria-hidden='true'></i>
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