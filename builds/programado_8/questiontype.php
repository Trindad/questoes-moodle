<?php
/**
 * The question type class for the Programado question type.
 *
 * @copyright &copy; 2014 Turma Optativa I
 * @author gttonin@gmail.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package tipo_programado
 *//** */

/**
 * The Programado question class
 *
 * TODO give an overview of how the class works here.
 */
class programado_qtype extends default_questiontype {

    function name() {
        return 'programado';
    }
    
    /**
     * @return boolean to indicate success of failure.
     */
    function get_question_options(&$question) {
    
        $resultado = get_records('question_programado', 'question', $question->id, 'id ASC');

        if (isset($resultado[0])) {
            
            $question->valores_minimo_programado = $resultado[0]->valor_minimo;
            $question->valores_maximo_programado = $resultado[0]->valor_maximo;
            $question->regex_programado = $resultado[0]->expressao_regular;
            $question->formato_resposta = $resultado[0]->formato_resposta;
            $question->funcao_solucao = $resultado[0]->funcao_solucao;
            $question->parametros_adicionais = unserialize($resultado[0]->parametros_adicionais);
        }

        return true;
    }

     /**
     * Save the units and the answers associated with this question.
     * @return boolean to indicate success of failure.
     */
    function save_question_options($question) {
        
        echo "<pre>";

        $dados = new StdClass();
        $dados->funcao_solucao = $question->funcao_solucao;
        $dados->formato_resposta = $question->formato_resposta;
        $dados->valor_minimo = $question->valores_minimo_programado;
        $dados->valor_maximo = $question->valores_maximo_programado;
        $dados->expressao_regular = $question->regex_programado;
        $dados->question_id = $question->id;
        $dados->parametros_adicionais = serialize($question->parametros_adicionais);
        // se existe já no banco
        // faz update
        // senão
        // faz insert
        $ifexists = get_records('question_programado', 'question_id', $question->id, 'id ASC');
        if ($ifexists) {
            $antigo = array_pop($ifexists);
            $dados->id = $antigo->id;
            //var_dump($dados);
            update_record("question_programado", $dados);
            //exit;
        }
        else{
            insert_record('question_programado', $dados);
        }          
                    
        //exit;
        return true;
    }

    /**
     * Deletes question from the question-type specific tables
     *
     * @param integer $questionid The question being deleted
     * @return boolean to indicate success of failure.
     */
    function delete_question($questionid) {
        delete_records('question_programado', 'question_id', $questionid);
        // TODO delete any    
        return true;
    }


    function create_session_and_responses(&$question, &$state, $cmoptions, $attempt) {
        // TODO create a blank repsonse in the $state->responses array, which    
        // represents the situation before the student has made a response.
        return true;
    }

    function restore_session_and_responses(&$question, &$state) {
        // TODO unpack $state->responses[''], which has just been loaded from the
        // database field question_states.answer into the $state->responses array.
        return true;
    }
    
    function save_session_and_responses(&$question, &$state) {
        // TODO package up the students response from the $state->responses
        // array into a string and save it in the question_states.answer field.
    
        $responses = '';
    
        return set_field('question_states', 'answer', $responses, 'id', $state->id);
    }
    
    function print_question_formulation_and_controls(&$question, &$state, $cmoptions, $options) {
        global $CFG;

        $readonly = empty($options->readonly) ? '' : 'disabled="disabled"';

        // Print formulation
        $questiontext = $this->format_text($question->questiontext,$question->questiontextformat, $cmoptions);
        $image = get_question_image($question, $cmoptions->course);
    
        // TODO prepare any other data necessary. For instance
        $feedback = '';
        if ($options->feedback) {
    
        }
    
        include("$CFG->dirroot/question/type/programado/display.html");
    }
    
    function grade_responses(&$question, &$state, $cmoptions) {
        // TODO assign a grade to the response in state.
    }
    
    function compare_responses($question, $state, $teststate) {
        // TODO write the code to return two different student responses, and
        // return two if the should be considered the same.
        return false;
    }

    /**
     * Checks whether a response matches a given answer, taking the tolerance
     * and units into account. Returns a true for if a response matches the
     * answer, false if it doesn't.
     */
    function test_response(&$question, &$state, $answer) {
        // TODO if your code uses the question_answer table, write a method to
        // determine whether the student's response in $state matches the    
        // answer in $answer.
        return false;
    }

    function check_response(&$question, &$state){
        // TODO
        return false;
    }

    function get_correct_responses(&$question, &$state) {
        // TODO
        return false;
    }

    function get_all_responses(&$question, &$state) {
        $result = new stdClass;
        // TODO
        return $result;
    }

    function get_actual_response($question, $state) {
        // TODO
        $responses = '';
        return $responses;
    }

    /**
     * Backup the data in the question
     *
     * This is used in question/backuplib.php
     */
    function backup($bf,$preferences,$question,$level=6) {
        $status = true;

        // TODO write code to backup an instance of your question type.

        return $status;
    }

    /**
     * Restores the data in the question
     *
     * This is used in question/restorelib.php
     */
    function restore($old_question_id,$new_question_id,$info,$restore) {
        $status = true;

        // TODO write code to restore an instance of your question type.

        return $status;
    }

}

// Register this question type with the system.
question_register_questiontype(new programado_qtype());
?>
