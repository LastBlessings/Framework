<?php
/**

 * User: Arthur
 * Date: 29.03.11
 * Time: 20:17
 * View Class
 */

class View
{

    private $vars = array();
    private $vars_type = 'PHP_STYLE';
    private $templates = array();

    public function __construct()
    {

    }

    /**
     * @param string $var_type PHP_STYLE (default) or SMARTY_STYLE
     * @return void
     */
    public function set_vars_type($var_type = 'PHP_STYLE')
    {
        $this->vars_type = $var_type;
    }

    /**
     * @param  $name required Might be either a string with the name of the var or an array in ($name => $value) form.
     * @param null $value If the first param was a string, must contain the value for the var
     * @return bool
     */
    public function set_vars($name, $value = NULL)
    {
        if (is_array($name)) {
            foreach ($name as $k => $v) {
                $this->vars[$k] = $v;
            }
        } else {
            if ($value != NULL) {
                $this->vars[$name] = $value;
                return TRUE;
            }
            return FALSE;
        }
        return FALSE;
    }

    /**
     * @param  $name array|string Array array($name1, $name2) or string with variable names to be removed
     * @return bool
     */
    public function unset_vars($name)
    {
        if (is_array($name)) {
            foreach ($name as $k) {
                unset($this->vars[$k]);
            }
            return TRUE;
        } else {
            unset($this->vars[$name]);
            return TRUE;
        }
    }

    /**
     * @param  $name The name of the required var
     * @return array/string
     */
    public function get_vars($name)
    {
        return $this->vars[$name];
    }

    /**
     * @param  $path_to_the_template string The absolute path to the template
     * @return bool|int
     */
    public function add_template($path_to_the_template)
    {
        if ($this->check_path($path_to_the_template)) {
            return array_push($this->templates, $path_to_the_template);
        } else {
            return FALSE;
        }
    }

    /**
     * Checks whether template file exists
     * @param  $path_to_the_template string The absolute path to the template
     * @return bool
     */
    private function check_path($path_to_the_template)
    {
        if (file_exists($path_to_the_template)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @param  $path_to_the_template The absolute path to the template
     * @return bool
     */
    public function remove_template($path_to_the_template)
    {
        if ($key = array_search($path_to_the_template, $this->templates)) {
            unset($this->templates[$key]);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @return array The array of templates
     */
    public function get_templates()
    {
        return $this->templates;
    }

    public function render()
    {
        if ($this->vars_type == 'PHP_STYLE') {

            extract($this->vars); //TODO: Might add a prefix from config file to vars
            ob_start();
            foreach ($this->templates as $template)
            {
                include $template;
            }
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;

        } elseif ($this->vars_type == 'SMARTY_STYLE') {

        } else {
            return new Exception("Sorry, but this class does not provide this variable type: $this->vars_type");
        }
    }

    /**
     * @return Renders and display the template directly to the browser.
     */
    public function display() {
        echo $this->render();
        return;
    }
}