<?php

function xmldb_qtype_programado_upgrade($oldversion = 0) {

    global $DB;
    $dbman = $DB->get_manager();

    $result = true;
  
    if ($result && $oldversion < 2014070200) {
        $table = new XMLDBTable('question_programado');
        $field = new XMLDBField('parametros_adicionais');
        $field->setAttributes(XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null, 'funcao_solucao');

        $result = $result && add_field($table, $field);
    }

    return $result;
}