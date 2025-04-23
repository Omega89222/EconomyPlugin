<?php

namespace Omega892\Economy\Commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use Omega892\Economy\Main;

class SeeMoney extends Command {

    public function __construct() {
        parent::__construct("seemoney", "Joueur -> Voir son argent", "/seemoney");
        $this->setPermission("pocketmine.group.user");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$sender instanceof Player) {
            $sender->sendMessage("Cette commande est réservée aux joueurs !");
            return;
        }
        if (!isset($args[0])){
            $targetName = $sender->getName();
        }
        if (isset($args[0])) {
            $targetName = $args[0];
        } elseif ($sender instanceof Player) {
            $targetName = $sender->getName();
        } else {
            $sender->sendMessage("§cTu dois spécifier un joueur si tu n'es pas en jeu !");
            return;
        }
        $config = Main::getInstance()->getConfig(); 
        if (!$config->exists($targetName)) {
            return;
        }

        $money = $config->getNested("{$targetName}.balance", 0);

        $sender->sendMessage("§aArgent de $targetName : $money");
    }
}






