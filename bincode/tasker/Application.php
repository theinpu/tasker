<?php
/**
 * User: inpu
 * Date: 07.01.14
 * Time: 4:30
 */

namespace bincode\tasker;


use Slim\Slim;

class Application
{

    /**
     * @var \Slim\Slim
     */
    private $slim;

    public function __construct()
    {
        $this->slim = new Slim();

        $this->slim->group('/github', function () use ($this) {
            $this->slim->post('/hook', function() use ($this) {
                $log = fopen("hook.log", "a+");
                fwrite($log, print_r($_POST, true)."\r\n");
                fclose($log);
            });
        });
    }

    public function run()
    {
        $this->slim->run();
    }
}