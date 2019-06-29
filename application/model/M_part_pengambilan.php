<?php
    class M_part_pengambilan extends Model{
        private $table, $id;

        public function __construct(){
            parent::__construct();
            $this->table = 'part_t_pengambilan';
            $this->table_detail = 'part_d_pengambilan';
            $this->id = 'id';
            $this->id_detail = 'id_d_pengambilan';
        }

        // Find All Part
        public function getAll(){
            $this->db->query("
                SELECT * FROM `$this->table`
            ");
            $result = $this->db->resultSet();
            return $result;
        }


        public function getAllDetail($id_transaksi){
            $this->db->query(" SELECT a.*, a.`qty` as qty_pengambilan, b.* FROM `$this->table_detail` AS a
                                LEFT JOIN `part` AS b 
                                ON a.`id_part` = b.`id_part`
                                WHERE `$this->id` = :id
                            ");
            $this->db->bind(':id', $id_transaksi);
            $result = $this->db->resultSet();
            return $result;
        }

        // Find Part By ID
        public function getById($id){
            $this->db->query("SELECT * FROM `$this->table` WHERE `$this->id` = :id");
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function getDetailById($id){
            $this->db->query("SELECT a.*, b.* FROM `$this->table_detail` AS a
                                LEFT JOIN `part` AS b 
                                ON a.`id_part` = b.`id_part`
                                WHERE `$this->id_detail` = :id");
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function getReportItemByPeriode($tgl_awal, $tgl_akhir){
            $this->db->query(" SELECT a.*, b.*, c.part_name, c.part_number,c.uniq_no, SUM(a.stock) as total_stock
                                FROM `part_d_request` AS a
                                LEFT JOIN `part_t_request` AS b
                                ON a.id_part_request = b.id_part_request
                                LEFT JOIN `part` AS c
                                ON a.id_part = c.id_part
                                WHERE b.status = 'approve'
                                AND b.approve_date BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                GROUP BY id_part
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        public function insert($data)
        {
            $this->db->query("INSERT INTO `$this->table` ($data[key]) VALUES ($data[value])");
            $result = $this->db->execute_param($data['data']);
            return $result;
        }

        public function insertGetId($data)
        {
            $this->db->query("INSERT INTO `$this->table` ($data[key]) VALUES ($data[value])");
            $result = $this->db->execute_param($data['data']);
            if($result){
                return $this->db->lastInsertId();
            }
            return $result;
        }

        public function insertDetail($data)
        {
            $this->db->query("INSERT INTO `$this->table_detail` ($data[key]) VALUES ($data[value])");
            $result = $this->db->execute_param($data['data']);
            return $result;
        }

        public function update($data)
        {   
            $id = $data['data']['id'];
            $this->db->query("UPDATE `$this->table` SET $data[key] WHERE `$this->id` = $id");
            $result = $this->db->execute_param($data['data']);
            // $result = $data['data'];
            return $result;
        }

        public function updateDetail($data)
        {   
            $id = $data['data']['id'];
            $this->db->query("UPDATE `$this->table_detail` SET $data[key] WHERE `$this->id_detail` = $id");
            $result = $this->db->execute_param($data['data']);
            // $result = $data['data'];
            return $result;
        }

        public function delete($id){
            $this->db->query("DELETE FROM `$this->table` WHERE `$this->id` = :id");
            $this->db->bind(':id', $id);
            $result = $this->db->execute();
            // delete detail
            if($result){
                // check data kalau ada maka delete
                $check = self::getAllDetail($id);
                if($check){
                    $this->db->query("DELETE FROM `$this->table_detail` WHERE `$this->id` = :id");
                    $this->db->bind(':id', $id);
                    $result = $this->db->execute();
                }
            }
            return $result;
        }

        public function deleteDetail($id){
            $this->db->query("DELETE FROM `$this->table_detail` WHERE `$this->id_detail` = :id");
            $this->db->bind(':id', $id);
            $result = $this->db->execute();
            return $result;
        }

    }
?>