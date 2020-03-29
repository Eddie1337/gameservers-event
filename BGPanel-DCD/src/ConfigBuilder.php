<?php

namespace BGPanelDCD;

use BGPanelDCD\GameConfig\CoD4;
use BGPanelDCD\GameConfig\UT4;
use Exception;
use Twig_Environment;
use Twig_Loader_Filesystem;
use BGPanelDCD\GameConfig\CSGO;

/**
 * Class ConfigBuilder
 *
 * @package BGPanelDCD
 */
abstract class ConfigBuilder
{

    protected $templatePath = "";

    protected $templateData = [];

    protected $gameserverPath = "";

    /**
     * @return string
     */
    public function getTemplatePath(): string
    {
        return $this->templatePath;
    }

    /**
     * @return array
     */
    public function getTemplateData(): array
    {
        return $this->templateData;
    }

    /**
     * @return string
     */
    public function getGameserverPath(): string
    {
        return $this->gameserverPath;
    }

    /**
     * lame but temp
     *
     * @param int $gameId
     * @return ConfigBuilder
     * @throws Exception
     */
    public static function getByBGGameId(int $gameId)
    {
        switch ($gameId) {
            case 9:
                return new CoD4();
            case 17:
                return new CSGO();
            case 24:
                return new UT4();
            default:
                throw new Exception("gameMapping not defined for gameId[={$gameId}]");
        }
    }

    /**
     * @param array $gameservers
     * @return array
     */
    public static function buildForGameservers(array $gameservers): array
    {
        $config = [];
        foreach ($gameservers as $gameserver) {
            $configBuilder = ConfigBuilder::getByBGGameId($gameserver['gameid']);
            $configBuilder->parseConfigToData($gameserver);
            $gameserverPath          = "{$configBuilder->getGameserverPath()}";
            $config[$gameserverPath] = $configBuilder->render();
        }

        return $config;
    }

    /**
     * @return array
     */
    public function render()
    {
        $configs = [];
        $loader  = new Twig_Loader_Filesystem('templates/');
        $twig    = new Twig_Environment($loader);

        $templateData = $this->getTemplateData();

        foreach ($templateData as $templateFile => $data) {
            $templatePath           = "{$this->getTemplatePath()}/{$templateFile}";
            $serverTemplatePath     = $this->getServerConfigPath($this->getTemplatePath(), $templateFile);
            $configs[$serverTemplatePath] = $twig->render("{$templatePath}.twig", $data);
        }

        return $configs;
    }

    /**
     * get path on server, default same, can be overwritten.
     *
     * @param string $templatePath
     * @param string $templateFile
     * @return string
     */
    public function getServerConfigPath(string $templatePath, string $templateFile)
    {
        return "{$templatePath}/{$templateFile}";
    }

    /**
     * @param array $gameserver
     */
    abstract function parseConfigToData(array $gameserver);

}
