<?php
// Clase simulada para evitar errores de PDO y drivers en la nube
class FakePDOStatement {
    public function execute($params = null) { return false; }
    public function fetch($mode = null) { return []; }
    public function fetchAll($mode = null) { return []; }
}

class FakePDO {
    public function prepare($sql) { return new FakePDOStatement(); }
    public function exec($sql) { return true; }
}

$conn = new FakePDO();
?>
