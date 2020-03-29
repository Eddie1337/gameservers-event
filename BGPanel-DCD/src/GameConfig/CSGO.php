<?php

namespace BGPanelDCD\GameConfig;

use BGPanelDCD\ConfigBuilder;

/**
 * Class CSGO
 *
 * @package BGPanelDCD\GameConfig
 */
class CSGO extends ConfigBuilder
{
    protected $templatePath = "csgo/cfg";

    /**
     * @param array $gameserver
     */
    public function parseConfigToData(array $gameserver)
    {
        $templateData = [
            "esl5on5.cfg"              => [],
            "live.cfg"                 => [],
            "server.cfg"               => [
                'name'     => $gameserver['name'],
                'tv_port'  => $gameserver['port'] + 1,
                'serverid' => $gameserver['serverid'],

            ],
            "settings.cfg"             => [],
            "gamemode_competitive.cfg" => [],
        ];

        $this->gameserverPath = str_replace("/srcds_run", '', $gameserver['path']);

        $this->templateData = $templateData;
    }
}
