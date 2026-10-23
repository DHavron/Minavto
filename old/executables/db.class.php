<?php
interface db {
    public function __construct($type);
    public function query($query);
    public function insert($table,$column,$values,$last);
    public function select($table,$column,$where,$order,$limit);
    public function update($table,$column,$values,$where);
    public function delete($table,$where);
    public function __destruct();
}
?>