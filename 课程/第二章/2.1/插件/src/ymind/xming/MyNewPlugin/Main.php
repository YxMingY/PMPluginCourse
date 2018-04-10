<?php
//命名空间
namespace ymind\xming\MyNewPlugin;
//调用PluginBase类，方便继承
use pocketmine\plugin\PluginBase;
//调用Listener接口，方便继承
use pocketmine\event\Listener;
//主类 继承了PluginBase类，Listener接口
class Main extends PluginBase implements Listener{
   public function onLoad(){
      //插件加载时执行
      //用Logger在控制台显示普通消息(白字)
      $this->getLogger()->info("MyNewPlugin 正在加载!");
   }
   public function onEnable(){
      //插件启动时执行
      //用Logger在控制台显示公告消息(蓝字)
      $this->getLogger()->notice("MyNewPlugin 已启动! 作者:xMing");
      //为主类注册事件，有了这段代码后，主类就可以监听事件了
      $this->getServer()->getPluginManager()->registerEvents($this,$this);
   }
   public function onDisable(){
      //插件关闭时执行
      //用Logger在控制台显示警告消息(黄/红字)
      $this->getLogger()->warning("MyNewPlugin 已关闭!");
   }
}