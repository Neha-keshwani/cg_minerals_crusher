<?php
jimport( 'joomla.application.component.view');

class TwoLevelMenuViewMenus extends JViewLegacy
{
    function display($tpl = null)
    {
        Functions::ifNotLoginRedirect();
		$db= JFactory::getDBO();

		$query = "select mi.* from #__menuitems mi order by `parent`, `order`";
		$db->setQuery($query);
		$menu_rows = $db->loadObjectList();
		$menus = array();
		foreach ($menu_rows as $menu_row)
		{
            if (!isset($menus[$menu_row->id]))
            {
                $menus[$menu_row->id] = array(
                                            "id" => $menu_row->id,
                                            "name" => $menu_row->name,
                                            "parent" => $menu_row->parent,
                                            "order" => $menu_row->order,
                                            "option" => $menu_row->option,
                                            "view" => $menu_row->view,
                                            "task" => $menu_row->task,
                                            "additional_params" => $menu_row->additional_params,
                                            "direct_link" => $menu_row->direct_link,
                                            "target" => $menu_row->target,
                                            "children" => array(),
                                            "has_children" => false);
                if ($menu_row->parent > 0)
                {
                    if (!isset($menus[$menu_row->parent]))
                    {
                        $menus[$menu_row->parent] = array();
                        $menus[$menu_row->parent]["id"] = $menu_row->parent;
                        $menus[$menu_row->parent]["children"] = array();
                    }
                        $menus[$menu_row->parent]["children"][] = $menu_row->id;
                        $menus[$menu_row->parent]["has_children"] = true;
                }
            }
            else
            {
                $menus[$menu_row->id]["id"] = $menu_row->id;
                $menus[$menu_row->id]["name"] = $menu_row->name;
                $menus[$menu_row->id]["parent"] = $menu_row->parent;
                $menus[$menu_row->id]["order"] = $menu_row->order;
                $menus[$menu_row->id]["option"] = $menu_row->option;
                $menus[$menu_row->id]["view"] = $menu_row->view;
                $menus[$menu_row->id]["task"] = $menu_row->task;
                $menus[$menu_row->id]["additional_params"] = $menu_row->additional_params;
                $menus[$menu_row->id]["direct_link"] = $menu_row->direct_link;
                $menus[$menu_row->id]["target"] = $menu_row->target;
            }
		}
        $this->menus = $menus;
        parent::display($tpl);
    }
}
?>