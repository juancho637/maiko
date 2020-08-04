<?php

use App\Question;
use App\Status;
use Illuminate\Database\Seeder;


class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create(['module' => 'inspación interna', 'question' => 'El manhole presenta grietas', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'El manhole presenta deformaciones', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'El tanque  está libre de corrosión visible', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'El tanque está libre de golpes', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'El tanque presenta grietas o fisuras', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'El tanque presenta abombamientos', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'El tanque presenta abolladuras', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'Las juntas de soldadura presentan grietas o porosidad', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'Existen defectos resanados con masilla, polímeros, epóxicos o pinturas', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'Tiene Rotogage', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'El rotogage se encuentra en buenas condiciones', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'Los bafles se encuentran soldados', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'Los bafles presentan grietas', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspación interna', 'question' => 'Los bafles se encuetran rotos', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);

        Question::create(['module' => 'inspación interna', 'question' => 'Las cabezas están libres de corrosión visible', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO']);
        Question::create(['module' => 'inspación interna', 'question' => 'Las cabezas están libres de golpes', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO']);
        Question::create(['module' => 'inspación interna', 'question' => 'Las cabezas presentan grietas', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO']);
        Question::create(['module' => 'inspación interna', 'question' => 'Existen defectos resanados con masilla, polímeros, epóxicos o pinturas', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO']);
        Question::create(['module' => 'inspación interna', 'question' => 'Las juntas de soldadura presentan grietas o porosidad', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO']);
        Question::create(['module' => 'inspación interna', 'question' => 'El manhole presenta grietas(si lo posee)', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO']);

        Question::create(['module' => 'abolladura', 'question' => 'El tanque estacionario debe ser reachazado y destriudo cunado la abolladura compromete una soldadura o cuando la abolladura esta en la zona afectada por el calor en un soldadura (distancia de 3 cms a partir del borde del cordon).', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'RECHAZO,NO RECHAZO']);
        Question::create(['module' => 'abolladura', 'question' => 'El tanque estacionario sera rechazado y destruido cuando su profundidad exceda de 6,35 mm (1/4 de pulgada).', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'RECHAZO,NO RECHAZO']);
        Question::create(['module' => 'abolladura', 'question' => 'El tanque estacionario sera rechazado y destruido cuando su profundidad exceda de 1/10 del diametro promedio de la abolladura*.', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'RECHAZO,NO RECHAZO']);

        Question::create(['module' => 'corrosión', 'question' => 'Los datos anteriores se encuentran en placa de identificación', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO']);
        Question::create(['module' => 'corrosión', 'question' => 'Los datos anteriores fueron calculados a partir de la medición del tanque y la aplicación de la formula de calculo.', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO']);

        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta placa de identificacion, legible y que corresponde al tanque', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'Las tuercas y espárragos están en buenas condiciones', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta oxidacion visible', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta corrosión general', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta corrosion aislada', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta corrosion en linea', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presentan grietas, fisuras o escapes', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta abolladuras', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta abombamientos', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta daños o evidencias de accion del fuego', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta daños o defectos en sus bridas', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'Las roscas y conexiones del tanque estan en buen estado', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'Las soldaduras del tanque se evidencian lisas, de aspecto uniforme', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'Las soldaduras del tanque evidencian poros, agrietamientos, salpicaduras o socavado', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'Los soportes y los sobresanos se encuentran en buen estado', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'Se evidencian defectos  resanados con masilla, polimeros, epoxicos o pinturas', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'La Pintura del tanque se encuentra en buenas condiciones', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El indicador de Presion y nivel se encuentran en buen estado y operan correctamente', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El indicador de temperatura se encuentran en buen estado y opera correctamente', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'El tanque presenta algun tipo de fuga', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'Las valvulas de globo y cierre rapido operan correctamente', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);
        Question::create(['module' => 'inspección externa', 'question' => 'Las tuberias que se conectan al tanque se encuentran en buen estado', 'response_type' => 'opción múltiple con respuesta única', 'possible_response' => 'SI,NO,N/A']);

        /*foreach (Question::MODULES as $module) {
            factory(Question::class, 7)->create([
                'module' => $module,
            ]);
        }*/
    }
}
