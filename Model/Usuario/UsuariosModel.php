<?php

include_once 'Database.php';
include_once 'Usuario.php';

class UsuariosModel {

    public function getUsuarios() {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = "select * from 	inv_tab_usuarios order by ID_USU";
        $resultado = $pdo->query($sql);

        //transformamos los registros en objetos de tipo Usuario y guardamos en array
        $listadoUsuarios = array();
        foreach ($resultado as $res) {
            $usuario = new Usuario($res['ID_USU'], $res['ID_TIPO_USU'], $res['CEDULA_RUC_PASS_USU'], $res['NOMBRES_USU'], $res['APELLIDOS_USU'], $res['FECH_NAC_USU'], $res['CIUDAD_NAC_USU'], $res['DIRECCION_USU'], $res['FONO_USU'], $res['E_MAIL_USU'], $res['ESTADO_USU']);
            array_push($listadoUsuarios, $usuario);
        }

        // Desconección de la Base de Datos
        Database::disconnect();

        // Retornamos el listado resultante:
        return $listadoUsuarios;
    }

    // Método para Obtener información de un usuario especificando su Id
    public function getUsuario($ID_USU) {
        //Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = "select * from inv_tab_usuarios where ID_USU=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($ID_USU));

        // Guardamos el resultado obtenido en objeto tipo Usuario
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $usuario = new Usuario($res['ID_USU'], $res['ID_TIPO_USU'], $res['CEDULA_RUC_PASS_USU'], $res['NOMBRES_USU'], $res['APELLIDOS_USU'], $res['FECH_NAC_USU'], $res['CIUDAD_NAC_USU'], $res['DIRECCION_USU'], $res['FONO_USU'], $res['E_MAIL_USU'], $res['ESTADO_USU']);
        Database::disconnect();

        // Retornamos el Usuario encontrado
        return $usuario;
    }

    // Método para insertar un Usuario
    public function insertarUsuario($ID_USU, $ID_TIPO_USU, $CEDULA_RUC_PASS_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECH_NAC_USU, $CIUDAD_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU) {
        // Conexión a Base de Datos y creación de consulta sql
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into inv_tab_usuarios(ID_USU, ID_TIPO_USU, CEDULA_RUC_PASS_USU, NOMBRES_USU, APELLIDOS_USU,"
                . "FECH_NAC_USU, CIUDAD_NAC_USU, DIRECCION_USU, FONO_USU, E_MAIL_USU, ESTADO_USU) values(?,?,?,?,?,?,?,?,?,?,?)";
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($ID_USU, $ID_TIPO_USU, $CEDULA_RUC_PASS_USU, $NOMBRES_USU, $APELLIDOS_USU,
                $FECH_NAC_USU, $CIUDAD_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    // Método para eliminar Usuario
    public function eliminarUsuario($ID_USU) {
        // Conexión a BD y ejecución de consulta sql
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from inv_tab_usuarios where ID_USU=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($ID_USU));
        Database::disconnect();
    }

    // Método para actualizar parámetros de Usuario
    public function actualizarUsuario($ID_USU, $ID_TIPO_USU, $CEDULA_RUC_PASS_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECH_NAC_USU, $CIUDAD_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU) {
        // Conexión a BD y creación de consulta sql
        $pdo = Database::connect();
        $sql = "update inv_tab_usuarios set ID_TIPO_USU=?, CEDULA_RUC_PASS_USU=?, NOMBRES_USU=?, APELLIDOS_USU=?, FECH_NAC_USU=?, CIUDAD_NAC_USU=?,"
                . "DIRECCION_USU=?, FONO_USU=?, E_MAIL_USU=?, ESTADO_USU=? where ID_USU=?";
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($ID_TIPO_USU, $CEDULA_RUC_PASS_USU, $NOMBRES_USU, $APELLIDOS_USU,
                $FECH_NAC_USU, $CIUDAD_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $ID_USU));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

}