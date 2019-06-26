<?php
class Approval_pengajuan extends My_Controller {

    public function __construct()
    {
        // user level role
        parent::__construct("Approval_pengajuan");

        // panggil helper
        $this->helper('field_data');
        // panggil model
        $this->model = $this->model('M_part_transaksi');
        $this->model_part = $this->model('M_part');
        $this->model_part_work = $this->model('M_part_workcenter');

    }


    public function index($alert = NULL, $msg =NULL){
        $data = $this->model->getByStatus('submit');
        $this->template->get_template('approval_pengajuan',[
            "data" => $data,
            "url_detail" => BASEURL."Approval_pengajuan/detail/",
            "url_approve" => BASEURL."Approval_pengajuan/approve/",
            "url_reject" => BASEURL."Approval_pengajuan/reject/",
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function detail($id){
        $data = $this->model->getById($id);
        $detail = $this->model->getAllDetail($id);

        $this->template->get_template('detail_approval',[
            "data" => $data,
            "detail" => $detail,
            "url_approve" => BASEURL."Approval_pengajuan/approve/",
            "url_reject" => BASEURL."Approval_pengajuan/reject/",
        ]);
    }

    // Action
    public function approve($id){
        $data = array(
            'id_part_request' => $id,
            'status' => 'approve',
            'approve_date' => date("y-m-d h:i:s")
        );

        // do update stock part & insert to part_workcenter
        $detail = $this->model->getAllDetail($id);

        foreach ($detail as $value) {
            $part = $this->model_part->getById($value['id_part']);
            $part['stock'] = $part['stock']-$value['stock_request'];

            // check part stock
            if($part['stock'] <= 0){
                $msg = "Failed_to_Approve._Stock_$part[part_name]_kurang.";
                header("Location: ".BASEURL."Approval_pengajuan/error/$msg");
            }
            // update stock gudang
            $this->model_part->update(field_edit([
                "id_part" => $value['id_part'],
                "stock" => $part['stock']
            ]));

            // update stock data to workcenter
            $part['stock'] = $value['stock_request'];
            // insert to workcenter
            self::insert_part_workcenter($part);

        }

        $result = $this->model->update(field_edit($data));
        if($result){
            $msg = "Successful_Approve.";
            // var_dump($result);
            header("Location: ".BASEURL."Approval_pengajuan/success/$msg");
        } else {
            $msg = "Failed_to_Approve.";
            header("Location: ".BASEURL."Approval_pengajuan/error/$msg");
        }
    }

    public function insert_part_workcenter($data){
        $id = $data['part_number'];

        $res = $this->model_part_work->getByPartNumber($id);

        if ($res) {
            // update
            $stock = $res["stock"]+$data["stock"];

            $result = $this->model_part_work->update(field_edit([
                "id_part" => $res["id_part"],
                "stock" => $stock
            ]));
        } else {
            // insert
            $data['id_part'] = NULL;
            $result = $this->model_part_work->insert(field_data($data));
        }
        return $result;
    }

    public function reject($id){
        $data = array(
            'id_part_request' => $id,
            'status' => 'reject'
        );
        $result = $this->model->update(field_edit($data));
        if($result){
            $msg = "Successful_Reject.";
            // var_dump($result);
            header("Location: ".BASEURL."Approval_pengajuan/success/$msg");
        } else {
            $msg = "Failed_to_Reject.";
            header("Location: ".BASEURL."Approval_pengajuan/error/$msg");
        }
    }

    public function delete($id){
        // delete record
        $result = $this->model->delete($id);
        // check if success delete
        if($result){
            $msg = "Successful_delete_Suppler.";
            header("Location: ".BASEURL."Approval_pengajuan/success/$msg");
        } else {
            $msg = "Failed_to_delete_Approval_pengajuan.";
            header("Location: ".BASEURL."Approval_pengajuan/error/$msg");
        }
    }
    
    // public function template($page, $data=[]){
    //     $this->view('admin/partials/header');
    //     $this->view('admin/partials/sidebar', ['menu' => 'approval_pengajuan']);
    //     $this->view('admin/partials/navbar');
    //     $this->view('admin/dashboard/'.$page, $data);
    //     $this->view('admin/partials/footer');
    // }

}