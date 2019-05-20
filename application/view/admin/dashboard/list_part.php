<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">List Parts</h5>
          <a class="btn btn-primary pull-right" href="<?=BASEURL?>List_part/add" role="button">
                Add data
                <i class="fa fa-plus-square" aria-hidden="true"></i>
          </a>
        </div>
        <div class="card-body">
        <?php 
          if(isset($data['data']) && $data['data'] != NULL){
        ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Unique No</th>
                        <th>Model</th>
                        <th>Part Number</th>
                        <th>Stock</th>
                        <th>Stock Min</th>
                        <th>Qty</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                      $i = 1;
                      foreach ($data['data'] as $value) {
                        $body = "
                                <tr>
                                  <td>".$i++."</td>
                                  <td>$value[uniq_no]</td>
                                  <td>$value[model]</td>
                                  <td>$value[part_number]</td>
                                  <td>$value[stock]</td>
                                  <td>$value[stock_min]</td>
                                  <td>$value[qty]</td>
                                  <td>$value[image]</td>
                                  <td>
                                    <a name='update' id='' class='btn btn-sm btn-primary' href='".$data['url_preview'].$value['id_part']."' role='button'>
                                      <i class='fa fa-eye' aria-hidden='true'></i>
                                    </a>
                                    <a name='update' id='' class='btn btn-sm btn-primary' href='".$data['url_edit'].$value['id_part']."' role='button'>
                                      <i class='fa fa-pencil-square' aria-hidden='true'></i>
                                    </a>
                                    <a name='delete' id='' class='btn btn-sm btn-danger' href='".$data['url_remove'].$value['id_part']."' role='button'>
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