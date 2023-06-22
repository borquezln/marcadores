<?php
class Conexion
{
    protected $link;
    public function conexionBD()
    {
        try {
            $this->link = new mysqli("localhost", "root", "", "marcadores", 3306, "utf8mb4");
        } catch (Exception $e) {
            die("Error" . $e->getMessage());
        }
        return $this->link;
    }
}
