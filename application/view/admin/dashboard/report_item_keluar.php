
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Report Item Keluar</h5>
        </div>
        <div class="card-body">
            <p>Report item keluar per periode. Silahkan masukkan tanggal awal dan tanggal akhir transaksi item keluar dibawah ini.</p>
            <form id="report_item_keluar" action="<?=$data['action']?>" method="post" action method novalidate="novalidate">
                <div class="form-row col-6">
                    <div class="col">
                    <input type="text" name="tgl_awal" class="form-control datepicker" placeholder="Tanggal Awal">
                    </div>
                    <div class="col">
                    <input type="text" name="tgl_akhir" class="form-control datepicker" placeholder="Tanggal Akhir">
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    <?php 
      if(isset($data['data']) && $data['data'] != NULL){
    ?>
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">List Parts Workcenter</h5>
          <a class="btn btn-primary" href="<?=$data['url_print_pdf']?>" role="button">
                PDF
          </a>
          <a class="btn btn-primary" href="<?=$data['url_print_excel']?>" role="button">
                Excel
          </a>
        </div>
        <div class="card-body">
            <table id="example" class="datatables table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Unique No</th>
                        <th>Part Name</th>
                        <th>Total Stock</th>
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
                                    <td>$value[part_name]</td>
                                    <td>$value[total_stock]</td>
                                </tr>
                                ";
                        echo $body;
                      }
                  ?>
                </tbody>
            </table>
        </div>
      </div>
      <?php
          }
        ?>
  </div>
</div>
