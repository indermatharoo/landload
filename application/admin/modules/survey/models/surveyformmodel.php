<?php

class SurveyFormmodel extends CI_Model {

    private $input;
    private $label;
    private $radio;
    private $submit;
    private $password;
    private $textarea;
    private $dropdown;
    private $checkbox;

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->input = 'input';
        $this->radio = 'radio';
        $this->label = 'label';
        $this->submit = 'submit';
        $this->password = 'password';
        $this->textarea = 'textarea';
        $this->dropdown = 'dropdown';
        $this->checkbox = 'checkbox';
    }

    function getAvaialableElementList($inKeyComb = false) {

        $list = array(
            $this->input,
            $this->radio,
            $this->password,
            $this->textarea,
            $this->dropdown,
            $this->checkbox
        );
        if ($inKeyComb) {
            $list = array(
                $this->input => $this->input,
                $this->radio => $this->radio,
                $this->password => $this->password,
                $this->textarea => $this->textarea,
                $this->dropdown => $this->dropdown,
                $this->checkbox => $this->checkbox
            );
        }
        return $list;
    }

    function getElement($element = null, $param = array()) {

        if (!$element) {
            return false;
        }
        $edit = FALSE;
        if (count($param)) {
            $edit = true;
        }
        $uniqueid = time();
        if ($edit) {
            $uniqueid = $uniqueid . $param['id'];
        }
        $commonHtml = '<div class="panel panel-default" id="field' . $uniqueid . '">'
                . '<div class="panel-heading" style="height:40px;">
                            <h4 class="panel-title" style="float:left; margin:0 2px;">
                                <a aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#panel-' . $uniqueid . '">' . $element . '</a>
                            </h4>'
                . '<span data-id="#field' . $uniqueid . '" class="removefield" style="float:right; margin:0 2px;">Remove</span>'
                . '</div>'
                . '<div class="panel-body collapse in" id="panel-' . $uniqueid . '" aria-expanded="true" >'
                . '<input type="hidden" name="' . $uniqueid . '[question_type]" value="' . $element . '" />';
        if ($edit) {
            $commonHtml .= '<input type="hidden" name="' . $uniqueid . '[dbid]" value="' . $param['id'] . '" />';
        }

        switch ($element):
            case 'radio':case 'checkbox':
                $commonHtml .= $this->simpleInputBlockTemp(array(
                    'uniqueid' => $uniqueid,
                    'fortext' => 'Name',
                    'forElem' => 'question_text',
                    'placeholder' => 'Add Question',
                        ), $edit ? $param['question_text'] : '');
                /* $commonHtml .= $this->simpleInputBlockTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Class',
                  'forElem' => 'class',
                  'placeholder' => 'Add Css class if you want',
                  ), $edit ? $param['class'] : '');
                  $commonHtml .= $this->simpleInputBlockTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Id',
                  'forElem' => 'fieldid',
                  'placeholder' => 'Add Css Id if you want',
                  ), $edit ? $param['fieldid'] : '');
                  $commonHtml .= $this->simpleInputCheckTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Required',
                  'forElem' => 'required',
                  'tempVal' => '1'
                  ), $edit ? $param['required'] : '0');
                 * 
                 */
                $commonHtml .= $this->simpleMultiBlockTemp(array(
                    'uniqueid' => $uniqueid,
                    'fortext' => 'Multiple Options',
                    'forElem' => 'multiopt',
                    'placeholder' => 'Please add multi options with comma seperated',
                        ), $edit ? implode(',', unserialize($param['multiopt'])) : '');
                break;
            case 'input':
            case 'password':
            case 'textarea':
                $commonHtml .= $this->simpleInputBlockTemp(array(
                    'uniqueid' => $uniqueid,
                    'fortext' => 'Name',
                    'forElem' => 'question_text',
                    'placeholder' => 'Add Question',
                        ), $edit ? $param['question_text'] : '');
                $commonHtml .= $this->simpleInputBlockTemp(array(
                    'uniqueid' => $uniqueid,
                    'fortext' => 'Placeholder',
                    'forElem' => 'placeholder',
                    'placeholder' => 'add placeholder',
                        ), $edit ? $param['placeholder'] : '');
                /*
                  $commonHtml .= $this->simpleInputBlockTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Class',
                  'forElem' => 'class',
                  'placeholder' => 'Add Css class if you want',
                  ), $edit ? $param['class'] : '');
                  $commonHtml .= $this->simpleInputBlockTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Id',
                  'forElem' => 'fieldid',
                  'placeholder' => 'Add Css Id if you want',
                  ), $edit ? $param['fieldid'] : '');
                  $commonHtml .= $this->simpleInputCheckTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Required',
                  'forElem' => 'required',
                  'tempVal' => '1'
                  ), $edit ? $param['required'] : '0');
                 * 
                 */
                break;
            case 'dropdown':
                $commonHtml .= $this->simpleInputBlockTemp(array(
                    'uniqueid' => $uniqueid,
                    'fortext' => 'Name',
                    'forElem' => 'question_text',
                    'placeholder' => 'Add Question',
                        ), $edit ? $param['question_text'] : '');
                /* $commonHtml .= $this->simpleInputBlockTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Class',
                  'forElem' => 'class',
                  'placeholder' => 'Add Css class if you want',
                  ), $edit ? $param['class'] : '');
                  $commonHtml .= $this->simpleInputBlockTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Id',
                  'forElem' => 'fieldid',
                  'placeholder' => 'Add Css Id if you want',
                  ), $edit ? $param['fieldid'] : '');
                  $commonHtml .= $this->simpleInputCheckTemp(array(
                  'uniqueid' => $uniqueid,
                  'fortext' => 'Required',
                  'forElem' => 'required',
                  'tempVal' => '1'
                  ), $edit ? $param['required'] : '0');
                 * 
                 */
                $commonHtml .= $this->simpleInputCheckTemp(array(
                    'uniqueid' => $uniqueid,
                    'fortext' => 'Multiple',
                    'forElem' => 'ismulti',
                    'tempVal' => '1'
                        ), $edit ? $param['ismulti'] : '0');
                $commonHtml .= $this->simpleMultiBlockTemp(array(
                    'uniqueid' => $uniqueid,
                    'fortext' => 'Multiple Options',
                    'forElem' => 'multiopt',
                    'placeholder' => 'Please add multi options with comma seperated',
                        ), $edit ? implode(',', unserialize($param['multiopt'])) : '');
                break;
        endswitch;
        $commonHtml .= '</div></div>';
        $commonHtml .= "
                    <script>
                    jQuery(document).ready(function($) {
                    
                        $('.removefield').on('click', function(event){
                            if(event.handled !== true){ event.handled = true;
                            }else{ return false; }
                            var divid = $(this).attr('data-id');
                            $(divid).remove();
                        });
                    });
                    </script>
                    ";
        return $commonHtml;
    }

    function getCommonJs($element = null, $param = array()) {

        $jscript = null;
        $elemHtml = null;
        switch ($element):
            case 'input':
                break;
        endswitch;
        return $elemHtml;
    }

    function simpleInputBlockTemp($param = array(), $tempDbValue = null) {

        return '<div class="form-group" id="' . $param['uniqueid'] . $param['forElem'] . '" >'
                //. '<label class="col-md-2 control-label" for="' . $param['uniqueid'] . '[' . $param['forElem'] . ']">' . $param['fortext'] . '</label>'
                . '<div class="col-md-12">
                            <input type="text" name="' . $param['uniqueid'] . '[' . $param['forElem'] . ']" 
                                value="' . $tempDbValue . '" class="form-control" placeholder="' . $param['placeholder'] . '">
                            <span class="help-block" id="' . $param['uniqueid'] . $param['forElem'] . '-msg"></span>
                        </div>
                </div>';
    }

    function simpleInputCheckTemp($param = array(), $tempDbValue = null) {
        return '<div class="form-group" id="' . $param['uniqueid'] . $param['forElem'] . '" >'
                //. '<label class="col-md-2 control-label" for="' . $param['uniqueid'] . '[' . $param['forElem'] . ']">' . $param['fortext'] . '</label>'
                . '<div class="col-md-12">
                            <input ' . ( $tempDbValue ? 'checked' : '') . ' type="checkbox" value=' . ( $tempDbValue ? $tempDbValue : $param['tempVal']) . ' name="' . $param['uniqueid'] . '[' . $param['forElem'] . ']" 
                                class="form-control" >
                            <span class="help-block" id="' . $param['uniqueid'] . $param['forElem'] . '-msg"></span>
                        </div>
                </div>';
    }

    function simpleMultiBlockTemp($param = array(), $tempDbValue = null) {

        return '<div class="form-group" id="' . $param['uniqueid'] . $param['forElem'] . '" >'
                . '<div class="col-md-2"></div><div class="col-md-10">Please add options with comma as ex: a,b,c,.,.,</div>'
                //. '<label class="col-md-2 control-label" for="' . $param['uniqueid'] . '[' . $param['forElem'] . ']">' . $param['fortext'] . '</label>'
                . '<div class="col-md-12">
                            <textarea class="form-control field" 
                            placeholder="Please add options with comma as ex: a,b,c,.,.,"
                            data-type="textarea-split"
                            name="' . $param['uniqueid'] . '[' . $param['forElem'] . ']" >' . ($tempDbValue ? $tempDbValue : '') . '</textarea>
                            <span class="help-block" id="' . $param['uniqueid'] . $param['forElem'] . '-msg"></span>
                        </div>
                </div>';
    }

    function getElemVariableList($elem = null) {
        if (!$elem) {
            return false;
        }
        $elemVariableList = array();
        switch ($elem):
            case 'input': case 'password': case 'textarea':
                $elemVariableList = array('question_type', 'question_text', 'placeholder', 'class', 'fieldid', 'required', 'numeric');
                break;
            case 'dropdown':
                $elemVariableList = array('question_type', 'question_text', 'class', 'fieldid', 'required', 'ismulti', 'multiopt');
                break;
            case 'radio': case 'checkbox':
                $elemVariableList = array('question_type', 'question_text', 'class', 'fieldid', 'required', 'multiopt');
                break;
        endswitch;
        return $elemVariableList;
    }

    function getHtmlElement($elem = array()) {
        if (!$elem) {
            return false;
        }
        $elemhtml = null;
        $elemVariableList = null;
        $uniqueid = time();
        $element = $elem['val']['question_type'];
        $formelement = 'form_' . $element;
        $name = $uniqueid . $elem['raw']['id'];
        $attributes = array('class' => 'control-label',);
        $elemhtml .= '<div class="col-sm-12">' . form_label($elem['val']['question_text'], $name . '[fld]', $attributes) . '</div>';
        switch ($element):
            case 'input': case 'password': case 'textarea':
                $data = array(
                    'name' => $name . '[fld]',
                    'id' => $elem['val']['fieldid'],
                    'class' => 'form-control ' . $elem['val']['class'],
                    'value' => '',
                    'required' => ($elem['val']['required'] ? TRUE : FALSE),
                );
                if($element == 'textarea'){
                    $data['rows'] = '3';
                }
                $elemhtml .= '<div class="col-sm-12">' . $formelement($data) . '</div>';
                $data = array($name . '[id]' => $elem['raw']['id']);
                $elemhtml .= form_hidden($data);
                break;
            case 'radio': case 'checkbox':
                $options = $elem['val']['multiopt'];
                $internalHtml = null;
                foreach ($options as $key => $val) {
                    $data = array(
                        'name' => $name . '[fld]',
                        'id' => $elem['val']['fieldid'],
                        'class' => $elem['val']['class'],
                        'required' => ($elem['val']['required'] ? TRUE : FALSE),
                        'value' => $key,
                    );

                    $attributes = array();
                    // Would produce: <label for="username" class="mycustomclass" style="color: #000;">What is your Name</label>
                    $internalHtml .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$formelement($data).'&nbsp;&nbsp;';
                    $internalHtml .= form_label($val, $name . '[fld][' . $key . ']', $attributes) . '</br>';
                }
                $data = array($name . '[id]' => $elem['raw']['id']);
                $internalHtml .= form_hidden($data);
                $elemhtml .='<div class="col-sm-12">' . $internalHtml . '</div>';
                $internalHtml = null;
                break;
            case 'dropdown':
                $data = array(
                    'name' => $name . '[fld]',
                    'id' => $elem['val']['fieldid'],
                    'class' => 'form-control ' . $elem['val']['class'],
                    'required' => ($elem['val']['required'] ? TRUE : FALSE),
                    'ismulti' => ($elem['val']['required'] ? TRUE : FALSE),
                );
                $options = $elem['val']['multiopt'];
                $attr = $options;
                $jsLocal = ' class="form-control" ';
                $elemhtml .= '<div class="col-sm-12">' . $formelement($name . '[fld]', $attr, ' ', $jsLocal) . '</div>';
                $data = array($name . '[id]' => $elem['raw']['id']);
                $elemhtml .= form_hidden($data);
                break;
            default:
                break;
        endswitch;
        $elemhtml = '<div class="form-group ">' . $elemhtml . '</div>';
        return $elemhtml;
    }

    function getQuestionVariableDet() {
        return array(
            'question_type' => 'fieldtype',
            'question_text' => 'fieldvalue',
            'class' => 'class',
            'fieldid' => 'id',
            'required' => 'required',
            'ismulti' => 'multiple',
            'multiopt' => 'multi',
        );
    }

    function getExistingQuestionTemp($param = array()) {
        $questionsHtml = null;
        if (!$param)
            return null;
        foreach ($param as $key => $value) {
            $questionsHtml .= $this->getElement($value['question_type'], $value);
        }
        return $questionsHtml;
    }

    function getHtmlFormOfQuestion($param = array()) {
        if (!$param) {
            return FALSE;
        }
        $elementHtml = '';
        foreach ($param as $key => $keyVal) {
            $data = array();
            $data['raw'] = $keyVal;
            $data['val'] = $this->SurveyQuestionmodel->getQuestionInsertArray($keyVal, true);
            $elementHtml .= $this->getHtmlElement($data);
        }
        return $elementHtml;
    }

}
