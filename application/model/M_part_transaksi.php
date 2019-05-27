<?php
    class M_part_transaksi extends Model{
        private $table, $id;

        public function __construct(){
            parent::__construct();
            $this->table = 'part_t_request';
            $this->table_detail = 'part_d_request';
            $this->id = 'id_part_request';
            $this->id_detail = 'id';
        }

        // Find All Part
        public function getAll(){
            $this->db->query("
                SELECT * FROM `$this->table`
            ");
            $result = $this->db->resultSet();
            return $result;
        }

        // Find All Part
        public function getAllByStatus($status){
            $this->db->query("
                SELECT * FROM `$this->table`
                WHERE `status` = :status
            ");
            $this->db->bind(':status',$status);
            
            $result = $this->db->resultSet();
            return $result;
        }

        public function getAllDetail($id_transaksi){
            $this->db->query(" SELECT a.*, b.* FROM `$this->table_detail` AS a
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

        public function getByStatus($status){
            $this->db->query("SELECT * FROM `$this->table` WHERE `status` = :status");
            $this->db->bind(':status', $status);
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
            $id = $data['data']['id_part_request'];
            $this->db->query("UPDATE `$this->table` SET $data[key] WHERE `$this->id` = $id");
            $result = $this->db->execute_param($data['data']);
            // $result = $data['data'];
            return $result;
        }

        public function updateDetail($data)
        {   
            $id = $data['data']['id_part_request'];
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