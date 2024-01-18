<?php
class Route
{
    public function __construct()
    {
    }

    function handleRoute($url)
    {
        global $routes;
        unset($routes['default_controller']);
        $url = trim($url, '/');
        $handleUrl = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match('~' . $key . '~is', $url)) {
                    $handleUrl = preg_replace('~' . $key . '~', $value, $url);
                }
            }
        }
        return $handleUrl;
        // return $url;
    }
}
