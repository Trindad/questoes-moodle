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

	echo "This is my first test with the plugin moodle UFFS WAW!";
    
    // TODO write unit tests for the other methods of the question type class.
}

?>
