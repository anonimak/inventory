<?php
    class M_part_workcenter extends Model{
        private $table, $id;

        public function __construct(){
            parent::__construct();
            $this->table = 'part_workcenter';
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

        // Find by part_number
        public function getByPartNumber($part_number){
            $this->db->query("SELECT * FROM `$this->table` WHERE `part_number` = :number");
            $this->db->bind(':number', $part_number);

            $row = $this->db->single();

            return $row;
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