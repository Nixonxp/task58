<?php
/**
 * Класс для работы с API
 *
 * @author		Илья Никифоров
 * @version		v.1.0 (21/03/2022)
 */
class Api
{
    public function __construct()
    {

    }


    /**
     * Заполняет строковый шаблон template данными из объекта object
     *
     * @author		User Name
     * @version		v.1.0 (21/03/2022)
     * @param		array $array
     * @param		string $template
     * @return		string
     */
    public function get_api_path(array $array, string $template) : string
    {
        $result = '';

        if (strlen($template) > 0) {
            $result = &$template;

            foreach ( $array as $k => $str){
                $template = preg_replace("/%$k%/", $str, $template);
            }
        }

        return $result;
    }
}

$user =
[
  'id'		=> 20,
  'name'		=> 'John Dow',
  'role'		=> 'QA',
  'salary'	=> 100
];

$api_path_templates =
[
	"/api/items/%id%/%name%",
	"/api/items/%id%/%role%",
	"/api/items/%id%/%salary%"
];

$api = new Api();

$api_paths = array_map(function ($api_path_template) use ($api, $user)
{
	return $api->get_api_path($user, $api_path_template);
}, $api_path_templates);

echo json_encode($api_paths, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);

$expected_result = ['/api/items/20/John%20Dow','/api/items/20/QA','/api/items/20/100'];
