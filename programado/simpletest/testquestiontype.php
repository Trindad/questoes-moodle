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
    
    function test_compare_responses() {
        $question = new stdClass;
        $state = new stdClass;
        $teststate = new stdClass;

        $state->responses = array();
        $teststate->responses = array();
        $this->assertTrue($this->qtype->compare_responses($question, $state, $teststate));

        $state->responses = array('' => 'frog');
        $teststate->responses = array('' => 'toad');
        $this->assertFalse($this->qtype->compare_responses($question, $state, $teststate));

        $state->responses = array('x' => 'frog');
        $teststate->responses = array('y' => 'frog');
        $this->assertFalse($this->qtype->compare_responses($question, $state, $teststate));

        $state->responses = array(1 => 1, 2 => 2);
        $teststate->responses = array(2 => 2, 1 => 1);
        $this->assertTrue($this->qtype->compare_responses($question, $state, $teststate));
    }
    
	function test_get_correct_responses() {
        $answer1 = new stdClass;
        $answer1->id = 17;
        $answer1->answer = "frog";
        $answer1->fraction = 1;
   
	}   
    // TODO write unit tests for the other methods of the question type class.
}

?>
