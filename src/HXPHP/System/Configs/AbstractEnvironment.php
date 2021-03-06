<?php
namespace HXPHP\System\Configs;

abstract class AbstractEnvironment
{
    public $baseURI;

    public function __construct()
    {
        //Configurações variáveis por ambiente
        $this->baseURI = '/hxphp/';

        $load = new LoadModules;
        return $load->loadModules($this);
    }
}