<?php

use Illuminate\Database\Seeder;
use App\Location;
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estaciones = [];
        array_push($estaciones, array('name'=>'EM_Lago Fontana TECMES','latitud' => '-44.9816867', 'longitud' => '-71.3911234', 'description'=>'Precipitacion + Dir del Viento + velos del Viento + Humedad + Presion + Radiacion'));
        array_push($estaciones, array('name'=>'EM_Nacientes Rio Tecka TECMES','latitud' => '-43.8478333', 'longitud' => '-71.1795000', 'description'=>'Precipitacion + Dir del Viento + velos del Viento + Humedad + Presion + Radiacion'));
        array_push($estaciones, array('name'=>'EM_Pampa Salina El Molle TECMES','latitud' => '-42.2358333', 'longitud' => '-69.6080000', 'description'=>'Precipitacion + Dir del Viento + velos del Viento + Humedad + Presion + Radiacion'));
        array_push($estaciones, array('name'=>'Chubut Boca Toma','latitud' => '-43.4458094', 'longitud' => '-65.9454638', 'description'=>'Rio chubut y Canal Principal Norte en Boca Toma, Nivel rio +Nivel Canal Princ. Norte'));
        array_push($estaciones, array('name'=>'Puerto Rawson IPA','latitud' => '-43.3410965', 'longitud' => '-65.0560280', 'description'=>'Puerto Rawson en Playa Union (Dentro del predio del Muelle) Prec.+Temp.+hum.+Dir. Viento+Veloc. Viento+Nivel"'));
        array_push($estaciones, array('name'=>'Alto Chubut IPA','latitud' => '-41.6730835', 'longitud' => '-71.1142426', 'description'=>'Nacientes del Rio Chubut Nivel nieve+Prec.+Temp'));
        array_push($estaciones, array('name'=>'Chubut Gualjaina IPA','latitud' => '-42.6090934', 'longitud' => '-70.3855843', 'description'=>'Rio chubut cerca de Gualjaina Prec.+Temp.+Dir.+Veloc. Viento+Nivel rio Chubut'));
        array_push($estaciones, array('name'=>'Chubut Gaiman IPA','latitud' => '-43.2932287', 'longitud' => '-65.4979517', 'description'=>'Rio Chubut Gaiman (Muellle SORIANO) Nivel Rio Gaiman'));
        array_push($estaciones, array('name'=>'Chubut Dolavon IPA','latitud' => '-43.3515741', 'longitud' => '-65.7713766', 'description'=>'Rio Chubut y Canal en Dolavon (Dentro predio cooperativa) Prec.+Temp.+Humed.+Dir.+Veloc. Viento+Nivel Freatimetro+Nivel de Canal+Nivel Rio'));
        array_push($estaciones, array('name'=>'Lago Puelo IPA','latitud' => '-42.0967506', 'longitud' => '-71.6205485', 'description'=>'Parque Nacional Lago Puelo Prec.+Temp.+Hum.+Dir.+Veloc. Viento+Nivel Lago'));
        array_push($estaciones, array('name'=>'Cuesta del ternero IPA','latitud' => '-41.9460190', 'longitud' => '-71.3756028', 'description'=>'Cuesta del Ternero Camino a El Maiten Prec.+Temp.+Hum.'));
        array_push($estaciones, array('name'=>'Rio Azul Nacientes IPA','latitud' => '-41.8562519', 'longitud' => '-71.5579809', 'description'=>'Nacientes Rio AzulPrec.+Temp.+Hum.'));
        array_push($estaciones, array('name'=>'Quemquemtreu IPA','latitud' => '-41.9002878', 'longitud' => '-71.5044995', 'description'=>'Rio Quemquemtreu Puente Los AplausosNivel rio'));
        array_push($estaciones, array('name'=>'Rio Azul Pasarela IPA','latitud' => '-42.0406358', 'longitud' => '-71.6068045', 'description'=>'Pasarela Rio Azul Lago PueloNivel rio'));
        array_push($estaciones, array('name'=>'Rio Azul El Bolson','latitud' => '-41.9361470', 'longitud' => '-71.5615802', 'description'=>'Estacion Aforo Rio Azul, El BolsonNivel rio +Prec.'));
        array_push($estaciones, array('name'=>'EHidrom Rio Corinto (LP 09/10)','latitud' => '71.4580600', 'longitud' => '-43.0227400', 'description'=>'Nivel'));
        array_push($estaciones, array('name'=>'EM-1-corintos','latitud' => '-71.1465500', 'longitud' => '-43.2774600', 'description'=>'Prec. +Veloc Viento-Dir.viento-Humedad+humedad+Presion'));
        array_push($estaciones, array('name'=>'EHidrom Rio Corinto (LP 09/10)','latitud' => '-71.3299100', 'longitud' => '-43.0796900', 'description'=>'Nivel'));
        

        foreach ($estaciones as $key => $estacion) {
            $locacion = new Location($estacion);
            $locacion->save();
        }
    }
}
