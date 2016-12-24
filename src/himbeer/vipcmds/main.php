<?php
namespace himbeer\vipcmds;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\permission\Permission;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerGameModeChangeEvent;
class main extends PluginBase implements Listener{
     
     public function onEnable(){
          $this->getServer()->getPluginManager()->registerEvents($this,$this);
          $this->getLogger()->info("VIPcmds enabled!");
          @mkdir($this->getDataFolder());
          $this->config = new Config ($this->getDataFolder() . "config.yml" , Config::YAML, array(
               "novip" => "§6Buy VIP now and get the ability to change gamemode and fly!",
               "vip" => "§4Usage: /vip gmc|gms|fly",
               "gmc" => "Gamemode changed to §bCreative",
               "gms" => "Gamemode changed to §aSurvival",
               "flyon" => "You can fly now!",
               "flyoff" => "You landed!",
               "noperm" => "§4You don't have the permission to use this command!",
               "already_in_gamemode" => "§4You are already in this gamemode!",
          ));
          $this->saveResource("config.yml");
     }
     
     public function onCommand(CommandSender $sender, Command $command, $label, array $args){
          switch($command->getName()){
               case "vip":
                    if(!($sender instanceof player)){
                         $sender->sendMessage("Use this command in-game!");
                    }else{
                         if(!isset($args[0])){
                              if($sender->hasPermission("vipcmds.vip")){
                                   $vip = $this->config->get("vip");
                                   $sender->sendMessage($vip);
                              }else{
                                   $novip = $this->config->get("novip");
                                   $sender->sendMessage($novip);
                              }
                         }else{
                              switch ($args[0]){
                                   case "gmc":
                                        if($sender->hasPermission("vipcmds.gm")){
                                             if($sender->getGamemode() == 1){
                                                  $already_in_gamemode = $this->config->get("already_in_gamemode");
                                                  $sender->sendMessage($already_in_gamemode);
                                             }else{
                                                  $sender->setGamemode(1);
                                                  $gmc = $this->config->get("gmc");
                                                  $sender->sendMessage($gmc);
                                             }
                                        }else{
                                             $noperm = $this->config->get("noperm");
                                             $sender->sendMessage($noperm);
                                        }
                                             break;
                                   case "gms":
                                        if($sender->hasPermission("vipcmds.gm")){
                                             if($sender->getGamemode() == 0){
                                                  $already_in_gamemode = $this->config->get("already_in_gamemode");
                                                  $sender->sendMessage($already_in_gamemode);
                                             }else{
                                                  $sender->setGamemode(0);
                                                  $gms = $this->config->get("gms");
                                                  $sender->sendMessage($gms);
                                             }
                                        }else{
                                             $noperm = $this->config->get("noperm");
                                             $sender->sendMessage($noperm);
                                        }
                                             break;
                                   case "fly":
                                        if($sender->hasPermission("vipcmds.fly")){
                                             if($sender->getAllowFlight()){
                                                  $flyoff = $this->config->get("flyoff");
                                                  $sender->sendMessage($flyoff);
                                                  $sender->setAllowFlight(false);
                                             }else{
                                                  $flyon = $this->config->get("flyon");
                                                  $sender->sendMessage($flyon);
                                                  $sender->setAllowFlight(true);
                                             }
                                        }else{
                                             $noperm = $this->config->get("noperm");
                                             $sender->sendMessage($noperm);
                                       }
                                             break;
                              }
                         }
                    }
          }
          return true;
     }
}
