<?php
namespace himbeer\vipcmds;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\Config;
class Main extends PluginBase implements Listener{
     
     public function onEnable(){
          $this->getServer()->getPluginManager()->registerEvents($this,$this);
          $this->getLogger()->info("VIPcmds enabled!");
          @mkdir($this->getDataFolder());
          $this->config = new Config ($this->getDataFolder() . "config.yml" , Config::YAML, array(
               "novipmsg" => "§6Buy VIP now and get the ability to change gamemode and fly!",
               "vipmsg" => "§4Usage: /vip gmc|gms|fly",
               "gmc" => "Gamemode changed to §bCreative",
               "gms" => "Gamemode changed to §aSurvival",
               "flyon" => "You can fly now!",
               "flyoff" => "You landed!",
          ));
          $this->saveResource("config.yml");
     }
     
     public function onCommand(CommandSender $sender, Command $command, $label, array $args){
          switch($command->getName()){
               case "vip":
                    if($sender hasPermission("vipcmds.vip")){
                         $vipmsg = $this->config->get("vipmsg");
                         $sender->sendMessage($vipmsg);
                    }else{
                         $novipmsg = $this->config->get("novipmsg");
                         $sender->sendMessage($novipmsg);
                    }
          }
          return true;
     }
}
