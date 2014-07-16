<?php
/**
 * Unit tests for this question type.
 *
 * @copyright &copy; 2006 Turma Optativa I
 * @author gttonin@gmail.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package tipo_programado
 *//** */
    
require_once(dirname(__FILE__) . '/../../../../config.php');

global $CFG;
require_once($CFG->libdir . '/simpletestlib.php');
require_once($CFG->dirroot . '/question/type/programado/questiontype.php');

class programado_qtype_test extends UnitTestCase {
    var $qtype;
    
    function setUp() {
        $this->qtype = new programado_qtype();
    }
    
    function tearDown() {
        $this->qtype = null;    
    }

    function test_name() {
        $this->assertEqual($this->qtype->name(), 'programado');
    }
    
    function test_nao_aceita_funcao_invalida()
    {
        $funcao = "uydioasuidosa";
        $this->assertFalse($this->qtype->valida_funcao($funcao, "teste_um_invalido"));
        $this->assertFalse(function_exists("teste_um_invalido"));
    }

    function test_aceita_funcao_valida()
    {
        $funcao = <<<FUNC
function correcao($resposta, $arg1) {
    $teste = base_convert($arg1, 10, 16);

    if ($teste == $resposta) {
        return 1;
    }

    return 0;
}
FUNC;
        $this->assertTrue($this->qtype->valida_funcao($funcao, "teste_um_super_ultra_valido"));
        $this->assertTrue(function_exists("teste_um_super_ultra_valido"));
    }

    function test_lanca_excecao_nome_invalido() {
        $funcao = "usaioudoas";

        $this->expectException($this->qtype->valida_funcao($funcao, null));
    }
}