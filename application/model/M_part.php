<?php
    class M_part extends Model{
        private $table, $id;

        public function __construct(){
            parent::__construct();
            $this->table = 'part';
            $this->id = 'id_part';
        }

        // Find All Part
        public function getAll(){
            $this->db->query("
                SELECT * FROM `$this->table`
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

        
    }
?>