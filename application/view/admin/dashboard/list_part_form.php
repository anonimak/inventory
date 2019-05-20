<?php 
    // var_dump($data['data']);
?>
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
    <div class="card-header">
        <h5 class="card-title"><?= $data['title'] ?></h5>
        <a class="btn btn-primary" href="<?=BASEURL?>List_part" role="button">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
          </a>
    </div>
    <div class="card-body">
        <form  method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Unique No</label>
                <input type="text" class="form-control" placeholder="Company" value="<?= (isset($data['data']))? $data['data']['uniq_no'] : ''; ?>">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Supplier</label>
                <select class="selectpicker" class="form-control">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Barbecue</option>
                </select>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Model</label>
                <input type="text" class="form-control" placeholder="Model" value="<?= (isset($data['data']))? $data['data']['model'] : ''; ?>">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Part Number</label>
                <input type="text" class="form-control" placeholder="Part Number" value="<?= (isset($data['data']))? $data['data']['part_number'] : ''; ?>">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Part Name</label>
                <input type="text" class="form-control" placeholder="Part Name" value="<?= (isset($data['data']))? $data['data']['part_name'] : ''; ?>">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Stock</label>
                <input type="text" class="form-control" placeholder="Stock" value="<?= (isset($data['data']))? $data['data']['stock'] : ''; ?>">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Stock Min</label>
                <input type="text" class="form-control" placeholder="Stock Min" value="<?= (isset($data['data']))? $data['data']['stock_min'] : ''; ?>">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Qty</label>
                <input type="text" class="form-control" placeholder="Qty" value="<?= (isset($data['data']))? $data['data']['qty'] : ''; ?>">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel-body panel-img">
                    <img src="<?=(isset($data['data']))? BASEURL.'asset/img/'.$data['data']['image'] : BASEURL.'asset/img/logo-small.png'; ?>" name="test" class="img-responsive image" id="image_part">
                    <div class="middle">
                        <label class="btn btn-orange-inline label-upload" for="upload_image"><i class="fa fa-edit"></i> Upload Image</label>
                        <input type="file" name="upload_image" id="upload_image" accept="image/*" style="opacity:0;"/>
                        <input type="hidden" name="hid_image" id="hid_image">
                        <div id="uploaded_image"></div>
                        <a class="btn" href="#" >
                            <i class="fa fa-trash"></i> Delete
                        </a> 
                        
                    </div>
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



<!-- modal upload -->
<div id="uploadimageModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Image</h4>
        </div>
        <div class="modal-body">
          <div class="row">
       <div class="col-md-8 text-center">
        <div id="image_demo" style="width:350px; margin-top:30px"></div>
       </div>
       <div class="col-md-4" style="padding-top:30px;">
        <br />
        <br />
        <br/>
        <button class="btn btn-success crop_image">Upload Image</button>
     </div>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
     </div>
    </div>
</div>


<script>
    $(function () {
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width:200,
                height:200,
                // type:'circle' //circle
            },
            boundary:{
                width:300,
                height:300
            }
        });

        $('#upload_image').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                url: event.target.result
                }).then(function(){
                console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event){
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response){
                $.ajax({
                url:"<?=BASEURL."List_part/upload_image/"?>",
                type: "POST",
                data:{   
                    "photo": response,
                    "id" : '<?= (isset($data['data']))?$data['data']['id']:''; ?>',
                    "old_photo" : '<?= (isset($data['data']))?$data['data']['image']:''; ?>'
                },
                success:function(datajson)
                {   
                    data = JSON.parse(datajson);
                    console.log(data.name);
                    $('#hid_image').val(data.name);
                    $('#uploadimageModal').modal('hide');
                    $('#uploaded_image').html(data);
                    $('#image_part').attr("src", "<?=BASEURL?>asset/img/part/"+data.name);
                }
                });
            })
        });
    });
</script>