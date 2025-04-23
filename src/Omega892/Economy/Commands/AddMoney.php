<?php

namespace Omega892\Economy\Commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use Omega892\Economy\Main;

class AddMoney extends Command {

    public function __construct() {
        parent::__construct("addmoney", "Operateur -> Ajouter de l'argent à un joueur", "/addmoney");
        $this->setPermission("addmoney.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$sender instanceof Player) {
            $sender->sendMessage("Cette commande est réservée aux joueurs !");
            return;
        }
        if (!isset($args[0]) || !isset($args[1])) {
            $sender->sendMessage("§cUsage : /addmoney <player> <money>");
            return;
        }
        if (isset($args[0])) {
            $targetName = $args[0];
        } else {
            $sender->sendMessage("§cTu dois mentionné un joueur .");
            return;
        }
        $config = Main::getInstance()->getConfig(); 
        if (!$config->exists($targetName)) {
            return;
        }
        $money = $config->getNested("{$targetName}.balance", 0);
        $config->setNested("{$targetName}.balance", $money + $args[1]);
        $config->save();
        $sender->sendMessage("§aVous avez ajouté §2$args[1]$ §aà §2$targetName §a.");
    }
}






