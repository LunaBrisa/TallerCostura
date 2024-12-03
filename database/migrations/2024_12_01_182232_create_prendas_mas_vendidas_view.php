<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW PrendasMasVendidas AS
            SELECT 
                prendas_confecciones.ruta_imagen,
                prendas_confecciones.nombre_prenda,
                prendas_confecciones.genero,
                prendas_confecciones.descripcion
            FROM prendas_confecciones
            JOIN detalles_confecciones 
                ON prendas_confecciones.id = detalles_confecciones.prenda_confeccion_id
            WHERE prendas_confecciones.genero IS NOT NULL
          GROUP BY prendas_confecciones.ruta_imagen, prendas_confecciones.nombre_prenda, prendas_confecciones.id, prendas_confecciones.genero, prendas_confecciones.descripcion
            HAVING (prendas_confecciones.genero, SUM(detalles_confecciones.cantidad_prenda)) IN (
                SELECT res.genero, MAX(res.total_ventas)
                FROM (
                    SELECT 
                        prendas_confecciones.genero AS genero,
                        prendas_confecciones.id AS prenda_id,
                        SUM(detalles_confecciones.cantidad_prenda) AS total_ventas
                    FROM prendas_confecciones
                    JOIN detalles_confecciones 
                        ON prendas_confecciones.id = detalles_confecciones.prenda_confeccion_id
                    WHERE prendas_confecciones.genero IS NOT NULL
                    GROUP BY prendas_confecciones.genero, prendas_confecciones.id
                ) AS res
                GROUP BY res.genero
            );
        ");
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS PrendasMasVendidas;");
    }
    
};
