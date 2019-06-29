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
            <h5 class="card-title"><?= $data['title'] ?></h5>
            <a class="btn btn-primary" href="<?=BASEURL?>Request_part/detail/<?=$data['id']?>" role="button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Back
            </a>
            </div>
            <div class="card-body">
                <?php
                    if($data['data_part'] != []){
                ?>
                <form id="request_detail_form" action="<?=$data['action']?>" method="post" action method novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Part Name <star class="text-danger">*</star></label>
                                <select class="form-control selectpicker" id="id_part" name="id_part" data-style="select-with-transition" title="Select Part" required="required">
                                    <?php 
                                        if(isset($data['data_part'])){
                                            foreach ($data['data_part'] as $value) {
                                                    echo "<option value='$value[id_part]' data-stock='$value[stock]'>$value[part_name] ($value[stock])</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <input type="hidden" name="hid_stock" id="hid_stock">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Stock <star class="text-danger">*</star></label>
                            <input type="number" name="stock" class="form-control" placeholder="Stock" required="required">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary btn-round"><?= $data['title'] ?></button>
                        </div>
                    </div>
                </form>
                    <?php } else{?>
                <div class="alert alert-warning" role="alert">
                    <strong>Semua part telah tertambah.</strong>
                </div>
                <?php }?>
            </div>
        </div>
        </div>
    </div>
</div>