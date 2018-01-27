<?php
namespace WhitelistMessage;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!file_exists($this->getDataFolder())){
            mkdir($this-dataFolder, 0744, true);
        }
        $this->conf = new Config($this->getDataFolder() . "message.yml", Config::YAML, ["message"=> "You are not whitelisted on this server!"]);
    }

    public function onPlayerPreLogin(PlayerPreLoginEvent $event)
    {
        $player = $event->getPlayer();
        if(!$this->getServer()->isWhitelisted($player->getName()) && $this->getServer()->getWhitelisted()){
            $player->kick($this->conf->get("message"),true);
        }
    }
}
