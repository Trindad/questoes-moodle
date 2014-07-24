<?php

function  xmldb_qtype_programado_upgrade($oldversion = 0) {

    global $DB;
    $dbman = $DB->get_manager();

    $result = true;

    if ($result && $oldversion < 20140609) {

        //exit("ERRO KKKKKKKKKKKKkkk");
        $table = new XMLDBTable('programado');

        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('question_id', XMLDB_TYPE_INTEGER, '20', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('valor_minimo', XMLDB_TYPE_NUMBER, '20, 5', null, null, null, null, null, null);
        $table->addFieldInfo('valor_maximo', XMLDB_TYPE_NUMBER, '20, 5', null, null, null, null, null, null);
        $table->addFieldInfo('expressao_regular', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null);
        $table->addFieldInfo('formato_resposta', XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('funcao_solucao', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null);

        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('question_programado_fk', XMLDB_KEY_FOREIGN, array('question_id'), 'question', array('id'));

        $result = $result && create_table($table);
    }

    return $result;
}