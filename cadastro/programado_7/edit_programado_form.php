<?php
/**
 * The editing form code for this question type.
 *
 * @copyright &copy; 2006 Turma Optativa I
 * @author gttonin@gmail.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package tipo_programado
 *//** */

require_once($CFG->dirroot.'/question/type/edit_question_form.php');

/**
 * Programado editing form definition.
 * 
 * See http://docs.moodle.org/en/Development:lib/formslib.php for information
 * about the Moodle forms library, which is based on the HTML Quickform PEAR library.
 */
class question_edit_programado_form extends question_edit_form {
    function definition_inner(&$mform) {
       

       $opcoes = array(
            'texto'=>'Texto Livre',
            'valores'=>'Faixa de valores',
            'letras'=>'Somente letras',
            'numeros'=>'Somente números',
            'lenum'=>'Somente letras e números',
            'regex'=>'Expressão regular'
        );

        /**
         * Adicionando campos
         */
        $mform->addElement('textarea', 'funcao_solucao', get_string('funcao_solucao', 'qtype_programado'), 'wrap="virtual" rows="20" cols="50"');
        $mform->addElement('button', 'add_parametro', get_string('add_parametro','qtype_programado'),$button->id);
        
        $mform->addElement('html', '<div id="parametros-adicionais"></div>');

        $mform->addElement('select', 'formato_resposta', get_string('formato_resposta', 'qtype_programado'),$opcoes);
        $mform->addElement('text', 'regex_programado', get_string('regex_programado', 'qtype_programado'), 'size="51"');
        $mform->addElement('text', 'valores_minimo_programado', get_string('valores_minimo_programado', 'qtype_programado'), 'size="51"');
        $mform->addElement('text', 'valores_maximo_programado', get_string('valores_maximo_programado', 'qtype_programado'), 'size="51"');
    
        /**
         * Habilitando campos
         */
        
        $mform->disabledIf('regex_programado', 'formato_resposta', 'neq', 'regex');
        $mform->disabledIf('valores_maximo_programado', 'formato_resposta', 'neq', 'valores');
        $mform->disabledIf('valores_minimo_programado', 'formato_resposta', 'neq', 'valores');

        /**
         * Ajudas
         */

        $mform->setHelpButton('funcao_solucao', array('funcao_solucao', get_string('funcao_solucao_help', 'qtype_programado'), 'qtype_programado'));
        $mform->setHelpButton('formato_resposta', array('formato_resposta', get_string('formato_resposta_help', 'qtype_programado'), 'qtype_programado'));
        $mform->setHelpButton('regex_programado', array('regex_programado', get_string('regex_programado_help', 'qtype_programado'), 'qtype_programado'));
        $mform->setHelpButton('valores_minimo_programado', array('valores_minimo_programado', get_string('valores_minimo_programado_help', 'qtype_programado'), 'qtype_programado'));
        $mform->setHelpButton('valores_maximo_programado', array('valores_maximo_programado', get_string('valores_maximo_programado_help', 'qtype_programado'), 'qtype_programado'));
    }

    function set_data($question) {
        // TODO, preprocess the question definition so the data is ready to load into the form.
        // You may not need this method at all, in which case you can delete it.

        // For example:
        // if (!empty($question->options)) {
        //     $question->customfield = $question->options->customfield;
        // }
        parent::set_data($question);
    }

    function validation($data) {
        $errors = array();

        // TODO, do extra validation on the data that came back from the form. E.g.
        // if (/* Some test on $data['customfield']*/) {
        //     $errors['customfield'] = get_string( ... );
        // }

        if ($errors) {
            return $errors;
        } else {
            return true;
        }
    }

    function qtype() {
        return 'programado';
    }
}
?>
