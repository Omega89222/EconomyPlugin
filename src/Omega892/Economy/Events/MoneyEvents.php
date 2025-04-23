<?php

namespace Omega892\Economy\Events;

use pocketmine\entity\Zombie;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use Omega892\Economy\Main;

class MoneyEvents implements Listener {
    public function onJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $name = $player->getName();
        $config = Main::getInstance()->getConfig(); 
        if(!$config->exists($player->getName())){
            $config->set($player->getName());
            $config->set($name, [
                         "balance" => 0
                         ]);
            $config->save();
        }
    }
}