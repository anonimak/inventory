<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title"><?= $data['title']?></h5>
            <a class="btn btn-primary" href="<?=BASEURL?>Request_part" role="button">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
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
                                    <td>$value[uniq_no]</td>
                                    <td>$value[part_name]</td>
                                    <td>$value[part_number]</td>
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