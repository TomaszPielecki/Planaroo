<?php

/**
 * Smarty compiler exception class
 *
 * @package Smarty
 */
class SmartyCompilerException extends SmartyException
{
    /**
     * The line number of the template error
     *
     * @type int|null
     */
    public int $line = 0;

    /**
     * The template source snippet relating to the error
     *
     * @type string|null
     */
    public $source = null;

    /**
     * The raw text of the error message
     *
     * @type string|null
     */
    public $desc = null;

    /**
     * The resource identifier or template name
     *
     * @type string|null
     */
    public $template = null;

    /**
     * Constructor
     *
     * @param string        $message exception message
     * @param int           $line    line number of error
     * @param Smarty_Source $source  source object
     */
    public function __construct($message, $line = null, $source = null)
    {
        parent::__construct($message);
        $this->line = ($line === null) ? 0 : $line;
        if (!$source && isset(\Smarty::$_current_file)) {
            $source = Smarty::$_current_file;
        }
        if ($source && $source->template_resource) {
            $this->template = $source->template_resource;
            if (!isset($this->source) && isset($source->name)) {
                $this->source = $source->name;
            }
        }
    }
    
    /**
     * String representation of the exception
     * 
     * @return string
     */
    public function __toString(): string
    {
        return ' --> Smarty Compiler: ' . $this->message . ' <-- ';
    }
}