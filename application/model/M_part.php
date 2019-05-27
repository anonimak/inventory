<?php
    class M_part extends Model{
        private $table, $id;

        public function __construct(){
            parent::__construct();
            $this->table = 'part';
            $this->table_supplier = 'supplier';
            $this->id = 'id_part';
            $this->id_supplier = 'id_supplier';
        }

        // Find All Part
        public function getAll(){
            $this->db->query("
                SELECT a.*, b.nama FROM `$this->table` AS a
                LEFT JOIN `$this->table_supplier` AS b
                ON a.`$this->id_supplier` = b.`$this->id_supplier`
            ");
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

        // Find All Part
        public function getAllNotInTransaksi($id_part_request){
            $this->db->query("
                SELECT a.*, b.nama FROM `$this->table` AS a
                LEFT JOIN `$this->table_supplier` AS b
                ON a.`$this->id_supplier` = b.`$this->id_supplier`
                WHERE a.`$this->id` NOT IN (SELECT `$this->id` FROM `part_d_request` WHERE `id_part_request` = :id)
            ");
            $this->db->bind(':id', $id_part_request);
            $result = $this->db->resultSet();
            return $result;
        }

        public function insert($data)
        {
            $this->db->query("INSERT INTO `$this->table` ($data[key]) VALUES ($data[value])");
            $result = $this->db->execute_param($data['data']);
            return $result;
        }

        public function update($data)
        {   
            $id = $data['data']['id_part'];
            $this->db->query("UPDATE `$this->table` SET $data[key] WHERE `$this->id` = $id");
            $result = $this->db->execute_param($data['data']);
            // $result = $data['data'];
            return $result;
        }

        public function delete($id){
            $this->db->query("DELETE FROM `$this->table` WHERE `$this->id` = :id");
            $this->db->bind(':id', $id);
            $result = $this->db->execute();
            return $result;
        }

    }
?>