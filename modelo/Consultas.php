<?php
require "Conexion.php";

class Consultas extends Conexion
{
    // USUARIOS
    public function autenticarUsuario($dni, $pass)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT password FROM usuarios
                    WHERE dni = $dni";
            $result = mysqli_query($link, $sql);
            while ($registro = mysqli_fetch_assoc($result)) {
                if (password_verify($pass, $registro["password"])) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function inicioSesion($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "UPDATE usuarios SET inicioSesion = now()
                    WHERE dni = $dni";
            $result = mysqli_query($link, $sql);
            return $result;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function registrarUsuario($dni, $nombre, $apellido, $mail, $password)
    {
        try {
            $passFuerte = password_hash($password, PASSWORD_DEFAULT);
            $link = parent::conexionBD();
            $sql = "INSERT INTO usuarios VALUES
                    ($dni, '$nombre', '$apellido', '$mail', '$passFuerte', NULL, 2, 2, 'Activa')";
            $result = mysqli_query($link, $sql);
            return $result;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function resetPassword($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "UPDATE usuarios SET estado_password = 'Resetear' WHERE dni = $dni";
            $result = mysqli_query($link, $sql);
            return $result;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function listarUsuarios()
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT * FROM usuarios";
            $result = mysqli_query($link, $sql);
            $lista = [];
            $i = 0;
            while ($registro = mysqli_fetch_assoc($result)) {
                $lista[$i] = $registro;
                $i += 1;
            }
            return $lista;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function listarDatosUsuario($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT * FROM usuarios
                    WHERE dni = $dni";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            return $row;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function listarDatoUsuario($dni, $dato)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT $dato FROM usuarios
                    WHERE dni = $dni";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $valor = $row[$dato];
            }
            return $valor;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    // MARCADOR
    public function crearMarcador($marcador, $direccion, $latitud, $longitud, $foto, $creador)
    {
        try {
            $link = parent::conexionBD();
            $sql = "INSERT INTO {$marcador}(direccion, latitud, longitud, archivo, creador, creacion, modificacion)
            VALUES ('$direccion', '$latitud', '$longitud', '$foto', $creador, now(), now())";
            $result = mysqli_query($link, $sql);
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function listarMarcadores($marcador)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT * from {$marcador}";
            $result = mysqli_query($link, $sql);
            $lista = [];
            $i = 0;
            while ($registro = mysqli_fetch_assoc($result)) {
                $lista[$i] = $registro;
                $i += 1;
            }
            return $lista;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
