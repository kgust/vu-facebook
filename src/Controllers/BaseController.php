<?php

namespace VU\App\Controllers;

class BaseController
{
    /**
     * Render a template.
     *
     * @param string $template Pathname of the template
     * @param array  $args     Array of arguments to pass in
     *
     * @return string
     */
    protected function render($template, array $args)
    {
        extract($args);

        ob_start();
        include $template;
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }
}
