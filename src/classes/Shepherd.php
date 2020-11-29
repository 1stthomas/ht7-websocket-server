<?php

namespace Ht7\WebsocketServer;

use \Ht7\WebsocketServer\AppDefinitionTypes;
use \Ht7\WebsocketServer\Defaults;

class Shepherd
{

    protected $config;
    protected $port;
    protected $scriptFileName;
    protected $route;

    public function __construct(array $argv)
    {
        $this->scriptFileName = $argv[0];
        $this->route = empty($argv[1]) ? Defaults::ROUTE : $argv[1];
        $this->port = empty($argv[2]) ? Defaults::PORT : $argv[2];
        $this->config = empty($argv[3]) ? Defaults::CONFIG : $this->getConfigFromDir($argv[3]);
    }

    public function getApps()
    {
        return $this->gatherApps();
    }

    public function getAppServer()
    {
        $config = $this->getConfig();

        if (empty($config) || empty($config['app_server'])) {
            $config['app_server'] = Defaults::APP_SERVER;
        }

        return $this->createAppServer($config);
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getConfigFromDir($dir)
    {
        return include $dir;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function validate(array $definition)
    {
        $types = [
            AppDefinitionTypes::IS_CLASS,
            AppDefinitionTypes::IS_INSTANCE,
            AppDefinitionTypes::IS_FACTORY
        ];

        if (!empty($definition['definition_type']) && !in_array($definition['definition_types'], $types)) {
            return 'Unknown definition type: ' . $definition['definition_type'] . '.';
        }

        if (empty($definition['app'])) {
            return 'Empty app definition.';
        }

        if (!empty($definition['definition_type']) && $definition['definition_type'] === AppDefinitionTypes::IS_FACTORY) {
            if (empty($definition['method'])) {
                return 'Undefined factory method.';
            }
        }

        return true;
    }

    protected function createAppServer(array $config)
    {
        return new $config['app_server']($this->getApps());
    }

    protected function createInstance(array $definition)
    {
        $validationResult = $this->validate($definition);

        if ($validationResult === true) {
            if (empty($definition['definition_type']) || $definition['definition_type'] === AppDefinitionTypes::IS_CLASS) {
                $args = empty($definition['args']) ? [] : $definition['args'];

                return new $definition['app']($args);
            } elseif ($definition['definition_type'] === AppDefinitionTypes::IS_INSTANCE) {
                return $definition['app'];
            } elseif ($definition['definition_type'] === AppDefinitionTypes::IS_FACTORY) {
                $args = empty($definition['args']) ? [] : $definition['args'];

                return $definition['app']::$definition['method']($args);
            }
        } else {
            throw new Exception($validationResult);
        }
    }

    protected function gatherApps()
    {
        $definitions = $this->getConfig();

        if (empty($definitions) || empty($definitions['apps'])) {
            return [];
        }

        $apps = [];

        foreach ($definitions['apps'] as $definition) {
            $apps[] = $this->createInstance($definition);
        }

        return $apps;
    }

}
