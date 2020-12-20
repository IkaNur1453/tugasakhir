<?php

class M_Reservasi Extends CI_Model
{
    var $table = 'reservasi';
    var $table_detail_reservation = 'detail_reservasi';
    var $table_konfirmasi = 'konfirmasi_pembayaran';
    var $column_order = array(null,'nama','acara','tgl_pesan','nama_kabupaten','alamat','dp','status',null); //set column field database for datatable orderable
    var $column_search = array('nama','acara','tgl_pesan','nama_kabupaten','alamat','dp','status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order 

    private function _get_datatables_query()
    {
        $this->db->from('v_'.$this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from('v_'.$this->table);
        return $this->db->count_all_results();
    }

    public function get_by_where_row($where)
    {
        $this->db->from('v_'.$this->table);
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

    public function getDetailByIdReservasi($idReservasi)
    {
        $query = $this->db->query("CALL sp_detail_reservasi('.$idReservasi.')");
        $data = $query->result();
        $query->next_result(); 
        $query->free_result();
        return $data; 
    }

    public function getKonfirmasiPembayaranByIdReservasi($idReservasi)
    {
        $this->db->from($this->table_konfirmasi);
        $this->db->where('id_reservasi', $idReservasi);
        $query = $this->db->get();

        return $query->row();
    }

    public function getWhereKonfirmasiPembayaran($where)
    {
        $this->db->from($this->table_konfirmasi);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data); //menyimpan data

        return $this->db->insert_id();
    }

    public function saveDetail($data)
    {
        $this->db->insert($this->table_detail_reservation, $data);

        return $this->db->insert_id();
    }

    public function saveKonfirmasiPembayaran($data)
    {
        $this->db->insert($this->table_konfirmasi, $data);

        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}
?>