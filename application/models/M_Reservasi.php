<?php

class M_Reservasi Extends CI_Model

{
    var $table = 'reservasi';

    public function get_by_where_row($where)
    {
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row(); //menampilkan tabel satu baris
    }

    public function get_by_where($where)
    {
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result(); //lebiih dari satu baris
    }

    public function save($data)
    {
        $this->db->insert($this->table, data); //menyimpan data

        return $this->db->insert_id();
    }

    public function update($data, $where)
    {
        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();
    }
}
?>