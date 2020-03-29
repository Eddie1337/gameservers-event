<?php

namespace BGPanelDCD\GameConfig;

use BGPanelDCD\ConfigBuilder;

/**
 * Class UT4
 *
 * @package BGPanelDCD\GameConfig
 */
class UT4 extends ConfigBuilder
{
    protected $templatePath = "UT4";

    /**
     * @param array $gameserver
     */
    public function parseConfigToData(array $gameserver)
    {
        $templateData = [
        ];

        $this->gameserverPath = str_replace("/srcds_run", '', $gameserver['path']);

        $this->templateData = $templateData;
    }
}
