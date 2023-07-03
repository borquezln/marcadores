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
            $sql = "UPDATE usuarios SET inicio_sesion = now()
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

    public function activar($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "UPDATE usuarios SET estado_usuario = 1 WHERE dni = $dni";
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
            $sql = "UPDATE usuarios SET estado_password = 'No activa' WHERE dni = $dni";
            $result = mysqli_query($link, $sql);
            return $result;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function resetear($dni)
    {
        try {
            $passFuerte = password_hash("Sistema2023", PASSWORD_DEFAULT);
            $link = parent::conexionBD();
            $sql = "UPDATE usuarios SET estado_password = 'Activa', password = '$passFuerte'
                    WHERE dni = $dni";
            $result = mysqli_query($link, $sql);
            return $result;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function hacerAdmin($dni)
    {
        try {
            $link = parent::conexionBD();
            $sql = "UPDATE usuarios SET tipo_usuario = 1
                    WHERE dni = $dni";
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
            $sql = "SELECT u.dni, u.nombre, u.apellido, u.mail, u.inicio_sesion, tu.tipo as tipo_usuario, eu.nombre as estado_usuario, u.estado_password
                    FROM usuarios u, estado_usuario eu, tipo_usuario tu
                    WHERE u.estado_usuario = eu.id_estado_usuario AND u.tipo_usuario = tu.id_tipo_usuario
                    ORDER BY u.dni";
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
            $sql = "SELECT u.dni, u.nombre, u.apellido, u.mail, u.inicio_sesion, eu.nombre as estado_usuario, u.estado_password
                    FROM usuarios u, estado_usuario eu
                    WHERE u.estado_usuario = eu.id_estado_usuario AND dni = $dni";
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

    // CONTADORES
    public function contadorTotal($marcador)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*) AS total FROM {$marcador}";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $total = $row["total"];
            }
            return $total;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function contadorUnicos($tabla, $columna)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(DISTINCT $columna) AS total FROM {$tabla}";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $total = $row["total"];
            }
            return $total;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function contadorPorValor($tabla, $columna, $valor)
    {
        try {
            $link = parent::conexionBD();
            $sql = "SELECT count(*) AS total FROM {$tabla} WHERE $columna = $valor";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $total = $row["total"];
            }
            return $total;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
