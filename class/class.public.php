<?php



include('../../admin/app/class/connect.class.php');

class Main extends connect
{
    public function ListExit()
    {
        $datePublic = date('Y-m-d');

        $query ="SELECT * FROM salidas AS sa
        INNER JOIN conductores AS con
        ON sa.id_conductor = con.id_conductor
        INNER JOIN carros AS car
        ON car.id_unidad = sa.id_unidad
        INNER JOIN rutas AS rut
        ON rut.id_rutas = sa.id_ruta
        INNER JOIN usuarios AS usuC
        ON usuC.id_usuario = sa.id_usuario_creador
        INNER JOIN usuarios AS usuE
        ON usuE.id_usuario = sa.id_usuario_editor
        WHERE estatus_publicacion  NOT LIKE '0%' AND fecha_publicar ='$datePublic'
        "; 
   
        return $this->select($query);
    }
    public function tableRoutes($id_routes=false,$status =false){
        
        $query = "SELECT TR. id_rutas, TR. km, TR. tiempo_ruta, TD1.city as city_origen , TD2.city as city_interme, TD3.city as city_destin
         FROM rutas TR 
         INNER JOIN direcciones TD1 ON TR. id_direccion_origen    = TD1. id_direccion 
         INNER JOIN direcciones TD2 ON TR. id_direccion_intermedia = TD2. id_direccion
         INNER JOIN direcciones TD3 ON TR. id_direccion_destino    = TD3. id_direccion
         WHERE TR. estatus_ruta='$status'
         ";
        
        if(!empty($id_routes)){
            $query.=" AND TR . id_rutas='$id_routes'";
        }
        return $this->select($query); 
    }

    public function stops($origen,$intermedia = false,$destin)
    {
        $query ="SELECT * FROM `paradas` WHERE estatus_parada   LIKE '%activo%' AND id_direcciones = $origen OR ";
        if(!empty($intermedia)){
            $query.= " id_direcciones = $intermedia OR ";
        }
        $query .= " id_direcciones = $destin";
          
        return $this->select($query); 
    }

}
