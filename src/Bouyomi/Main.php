<?php


namespace Bouyomi;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
    public function onLoad()
    {
        $this->saveDefaultConfig();
    }

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        is_dir($this->getConfig()->get("path"))
            ? $this->getLogger()->notice("棒読みちゃん-PMを読み込みました。")
            : $this->nodir();
    }

    public function onChat(PlayerChatEvent $event)
    {
        exec($this->getConfig()->get("path") . "/RemoteTalk/RemoteTalk.exe /Talk " . $event->getMessage());
    }

    private function nodir(): void
    {
        $this->getLogger()->warning("フォルダを発見出来ませんでした。プラグインを終了します。");
        $this->getServer()->getPluginManager()->disablePlugin($this);
    }
}