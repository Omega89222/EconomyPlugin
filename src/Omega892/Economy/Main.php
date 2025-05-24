<?php

namespace Omega892\Economy;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

use Omega892\Economy\Commands\SeeMoney;
use Omega892\Economy\Commands\AddMoney;
use Omega892\Economy\Commands\RemoveMoney;
use Omega892\Economy\Events\MoneyEvents;

class Main extends PluginBase {

    use SingletonTrait;
    public Config $config;

    public function onEnable(): void {
        self::setInstance($this);
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();

        $this->getServer()->getCommandMap()->register("seemoney", new SeeMoney());
        $this->getServer()->getCommandMap()->register("addmoney", new AddMoney());
        $this->getServer()->getCommandMap()->register("removemoney", new RemoveMoney());

        $this->getServer()->getPluginManager()->registerEvents(new MoneyEvents(),$this);
    }
}
