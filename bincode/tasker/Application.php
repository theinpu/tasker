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
        $app = $this;
        $this->slim->group('/github', function () use ($app) {
            $app->getSlim()->post('/hook', function() use ($app) {
                $log = fopen("/tmp/hook.log", "a+");
                $hookInfo = $app->getSlim()->request()->post("payload");
                fwrite($log, print_r($hookInfo, true)."\r\n");
                fclose($log);
            });
        });
    }

    public function run()
    {
        $this->slim->run();
    }

    /**
     * @return Slim
     */
    private function getSlim()
    {
        return $this->slim;
    }
}