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
          <h5 class="card-title">Request Part</h5>
          <a class="btn btn-primary" href="<?=BASEURL?>Request_part" role="button">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
          </a>
        </div>
        <div class="card-body">
          <form id="request_part_form" action="<?=$data['action']?>" method="post" action method novalidate="novalidate">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="5"><?= (isset($data['data']))? $data['data']['deskripsi'] : ''; ?></textarea>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="update ml-auto mr-auto">
                <button type="submit" class="btn btn-primary btn-round"><?= $data['title'] ?></button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>