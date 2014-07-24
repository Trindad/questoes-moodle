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

class programado_qtype extends question_shortanswer_qtype {

    function name() {
        return 'programado';
    }
    
    /**
     * @return boolean to indicate success of failure.
     */
    function get_question_options(&$question) {
    
        $temp = get_records('question_programado', 'question_id', $question->id, 'id ASC');
        $resultado = array_shift($temp);

        if ($resultado) {
            
            $question->valores_minimo_programado = $resultado->valor_minimo;
            $question->valores_maximo_programado = $resultado->valor_maximo;
            $question->regex_programado = $resultado->expressao_regular;
            $question->formato_resposta = $resultado->formato_resposta;
            $question->funcao_solucao = $resultado->funcao_solucao;
            $question->parametros_adicionais = unserialize($resultado->parametros_adicionais);
        }

        return true;
    }

     /**
     * Save the units and the answers associated with this question.
     * @return boolean to indicate success of failure.
     */
    function save_question_options($question) {
        
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

    function print_question_formulation_and_controls(&$question, &$state, $cmoptions, $options) {
    /// This implementation is also used by question type 'numerical'
        $readonly = empty($options->readonly) ? '' : 'readonly="readonly"';
        $formatoptions = new stdClass;
        $formatoptions->noclean = true;
        $formatoptions->para = false;
        $nameprefix = $question->name_prefix;

        /// Print question text and media

        $questiontext = format_text($question->questiontext,
                $question->questiontextformat,
                $formatoptions, $cmoptions->course);
        $image = get_question_image($question);

        /// Print input controls

        if (isset($state->responses['']) && $state->responses[''] != '') {
            $value = ' value="'.s($state->responses[''], true).'" ';
        } else {
            $value = ' value="" ';
        }
        $inputname = ' name="'.$nameprefix.'" ';

        $feedback = '';
        $class = '';
        $feedbackimg = '';

        if ($options->feedback) {
            $class = question_get_feedback_class(0);
            $feedbackimg = question_get_feedback_image(0);

            if (isset($state->raw_grade) && $state->raw_grade > 0) {
                // Answer was correct or partially correct.
                $class = question_get_feedback_class($state->raw_grade);
                $feedbackimg = question_get_feedback_image($state->raw_grade);
            }
        }

        /// Removed correct answer, to be displayed later MDL-7496
        include($this->get_display_html_path());
    }

    /**
     * Deletes question from the question-type specific tables
     *
     * @param integer $questionid The question being deleted
     * @return boolean to indicate success of failure.
     */
    function delete_question($questionid) {
        delete_records('question_programado', 'question_id', $questionid);
        return true;
    }


    // function create_session_and_responses(&$question, &$state, $cmoptions, $attempt) {
    //     // TODO create a blank repsonse in the $state->responses array, which    
    //     // represents the situation before the student has made a response.
    //     return true;
    // }

    // function restore_session_and_responses(&$question, &$state) {
    //     // TODO unpack $state->responses[''], which has just been loaded from the
    //     // database field question_states.answer into the $state->responses array.
    //     return true;
    // }
    
    // function save_session_and_responses(&$question, &$state) {
    //     // TODO package up the students response from the $state->responses
    //     // array into a string and save it in the question_states.answer field.
    
    //     $responses = '';
    
    //     return set_field('question_states', 'answer', $responses, 'id', $state->id);
    // }
    
    function grade_responses(&$question, &$state, $cmoptions) {
        $funcao = $question->funcao_solucao;
        $novoNome = "funcaoCorrecaoProgramado";

        $this->valida_funcao($funcao, $novoNome);

        $parametros = $question->parametros_adicionais;
        array_unshift($parametros, $state->responses['']);

        $state->raw_grade = call_user_func_array($novoNome, $parametros);
        $state->raw_grade = min(max((float) $state->raw_grade,
                            0.0), 1.0) * $question->maxgrade;
        $state->event = ($state->event ==  QUESTION_EVENTCLOSE) ? QUESTION_EVENTCLOSEANDGRADE : QUESTION_EVENTGRADE;

        return true;
    }

    public function valida_funcao($funcao,$novoNome) {

        if (!is_string($novoNome) || strlen($novoNome) < 1) {
            throw new InvalidArgumentException("Novo nome inválido!");
        }

        $copia = str_replace("function ", "", $funcao);
        $posicaoParentese = strpos($copia, "(");

        $nome = substr($copia, 0, $posicaoParentese);

        $novaFuncao = str_replace($nome, $novoNome, $funcao);

        return eval($novaFuncao);
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
