<?
Class BlocksModulesLogic extends Base
{
    public $block;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function __destruct()
    {
        $this->deInit();
    }

    private function getModuleOptionValue($option_name){
        foreach($this->block->options as $option){
            if($option->name == $option_name){
                return $option->value;
            }
        }
    }

    //Module logic router
    public function getBlockModuleData($block){
        $this->block = $block;

        //String method runner
        //turn this naming 'module.mode.submode' into this 'ModuleModeSubmode' to call methods directly by the module/mode/submode name
        $name_parts = explode('.', $block->module_mode->name);

        $fnc_name = '__getBlockModule__';

        foreach($name_parts as $part){
            $fnc_name .= ucfirst($part);
        }

        if(is_callable(array($this, $fnc_name))){
            return $this->$fnc_name();
        }else{
            return null;
        }
    }

    private function __getBlockModule__PagesSimple(){
        return $this->getSimplePageContent($this->block->content_id);
    }

    private function __getBlockModule__NavigationLevelOne(){
        return $this->getMenu($this->block->content_id, $this->block->menu_parent_id);
    }

    private function __getBlockModule__NavigationTree(){
        return $this->getMenuTree($this->block->content_id, $this->block->menu_parent_id);
    }

    private function __getBlockModule__NavigationBreadcrumbs(){
        return $this->getBreadCrumbs($this->page->data->id);
    }

    private function __getBlockModule__NavigationSitemap(){
        return $this->getMenuTree();
    }

    private function __getBlockModule__NewsAll(){
        return $this->sectionctrl->getList(
            $this->block->module_mode->table,
            'id',
            false,
            array('id', 'ASC'),
            intval($this->getModuleOptionValue('limit'))
        );
    }

    private function __getBlockModule__NewsLinesAll(){
        return $this->sectionctrl->getList(
            $this->block->module_mode->table,
            'id',
            false,
            array('id', 'ASC'),
            false
        );
    }
}