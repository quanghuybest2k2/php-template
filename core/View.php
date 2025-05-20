<?php

namespace Core;
use Exception;

class View
{
    /**
     * Render a view file.
     *
     * @param string $view The name of the view file (without extension).
     * @param array $data An associative array of data to be passed to the view.
     * @return string The rendered view content.
     * @throws Exception If the view file does not exist.
     */
    public static function render($view, $data = [])
    {
        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new Exception("View file not found: $viewFile");
        }

        // Extract data to variables
        extract($data);

        ob_start();
        include $viewFile;
        return ob_get_clean();
    }

    /**
     * Render a view file with a layout.
     *
     * @param string $view The name of the view file (without extension).
     * @param array $data An associative array of data to be passed to the view.
     * @param string $layout The name of the layout file (without extension).
     * @return string The rendered view content with layout.
     */
    public static function renderWithLayout($view, $data = [], $layout = 'layout')
    {
        $content = self::render($view, $data);
        return self::render($layout, array_merge($data, ['content' => $content]));
    }
}
