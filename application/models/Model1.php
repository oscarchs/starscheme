<?php
class model1 extends CI_Model {

        public function __construct(){
                $this->load->database();

        }

        public function get_table($slug = FALSE){
          if ($slug === FALSE){
                  $query = $this->db->get('wkf_activity');
                  return $query->result_array();
          }
        $query = $this->db->get_where('wkf_activity', array('slug' => $slug));
        return $query->row_array();
        }

        public function get_dims(){
          $dim_producto = $this->db->list_fields('_dim_producto_final');
          $dim_tienda = $this->db->list_fields('_dim_tienda_final');
          $dim_medida = $this->db->list_fields('_dim_tiempo_final');
          return array('dim_producto' => $dim_producto,'dim_tienda' => $dim_tienda, 'dim_medida' => $dim_medida);
        }

        public function get_meta_data(){
          $tiempo = $this->db->query("select nom_columna,nombre_jer,nombre,level_jer  from _jerarquia_final inner join _dimensiones_final on _jerarquia_final.id_dimension =
_dimensiones_final.id_dimension where nombre='tiempo'");

$producto = $this->db->query("select nom_columna,nombre_jer,nombre,level_jer  from _jerarquia_final inner join _dimensiones_final on _jerarquia_final.id_dimension =
_dimensiones_final.id_dimension where nombre='producto'");

$tienda = $this->db->query("select nom_columna,nombre_jer,nombre,level_jer  from _jerarquia_final inner join _dimensiones_final on _jerarquia_final.id_dimension =
_dimensiones_final.id_dimension where nombre='tienda'");

          return array('tiempo' => $tiempo->result_array(),'producto' => $producto->result_array(), 'tienda' => $tienda->result_array());

        }

        public function process_query($data){
            $meta_data = $this->get_meta_data();
            $resulting_query = "select ";
            $joins ="";
            $parenthesis ="(((";
            $closing ="";
            $where_conditions ="where ";
            $group_by ="group by ";
            $joins .= "inner join _dim_tiempo_final on _dim_tiempo_final.id_jer_tiempo = _hechos_ventas_final.id_jer_tiempo)";
            $joins .= "inner join _dim_producto_final on _dim_producto_final.id_jer_producto = _hechos_ventas_final.id_jer_producto)";
            $joins .= "inner join _dim_tienda_final on _dim_tienda_final.id_jer_tienda = _hechos_ventas_final.id_jer_tienda)";
            if ($data['tiempo']){
              $resulting_query = $resulting_query . $data['tiempo'];
              $group_by .= $data['tiempo'];
              if($data['tiempo'] == "dia"){
                $where_conditions .= $data['tiempo'] . " is not null and mes is not null and anho is not null";

              }
              else if($data['tiempo'] == "mes"){
                $where_conditions .= $data['tiempo'] . " is not null and anho is not null and dia is null ";
              }
              else if($data['tiempo'] == "anho"){
                $where_conditions .= $data['tiempo'] . " is not null and mes is  null and dia is null ";
              }
            }
            else{
              $where_conditions .= " anho is null and mes is null and dia is null ";
            }
            if ($data['producto']){
              $where_conditions .= " and ";
              if($group_by != "group by "){
                $group_by .= ",";
              }
              $group_by .= $data['producto'];
              if($resulting_query != "select "){
                $resulting_query .= ",";
              }
              $resulting_query.= $data['producto'];
              if( $data['producto'] == "tipo"){
                    $where_conditions .= $data['producto'] . " is not null and categoria is null and producto is null ";
              }
              else if( $data['producto'] == "categoria"){
                    $where_conditions .= $data['producto'] . " is not null and tipo is not null and producto is null ";
              }
              else if( $data['producto'] == "producto"){
                    $where_conditions .= $data['producto'] . " is not null and categoria is not null and producto is not null ";
              }
            }
            else{
              $where_conditions .= " and producto is null and categoria is null and tipo is null ";
            }
            if ($data['tienda']){
              if($resulting_query != "select "){
                $resulting_query .= ",";
              }
              if($group_by != "group by "){
                $group_by .= ",";
              }
              if($data['tienda'] == "tienda"){
                $where_conditions .= " and tienda is not null ";
              }
              $group_by .= $data['tienda'];
              $resulting_query .= $data['tienda'];

            }
            else{
              $where_conditions .= " and tienda is null ";
            }

            if($resulting_query == "select "){
              $resulting_query .= " * ";

              $parenthesis = "(((";
              $group_by = "";
              $closing .= ";";
              $resulting_query .= " from " .$parenthesis . "_hechos_ventas_final ";
              $resulting_query .= $joins;
              $resulting_query .= $where_conditions;
              $resulting_query .= $group_by;
              $resulting_query .= $closing;
              return array('q' => $resulting_query, 'datos' => $this->db->query($resulting_query)->result_array());
            }
            else{
              $resulting_query .= ",cantidad,sum(montot) ";

            }
            $closing .= ";";
            $resulting_query .= " from " .$parenthesis . "_hechos_ventas_final ";
            $resulting_query .= $joins;
            $resulting_query .= $where_conditions;
            if( $group_by !="group by "){
              $group_by .=", ";
            }
            $group_by .= "cantidad ";
            $resulting_query .= $group_by;
            $resulting_query .= $closing;

            $tiempo = $meta_data['tiempo'];
            $producto =$meta_data['producto'];
            $tienda = $meta_data['tienda'];

          return array('q' => $resulting_query, 'datos' => $this->db->query($resulting_query)->result_array());
          //return $this->db->query($resulting_query)->result_array();
          //  return $resulting_query;
        }


        public function any_table($table_name){
          $query = $this->db->get($table_name);
          return $query->result_array();
        }
}
