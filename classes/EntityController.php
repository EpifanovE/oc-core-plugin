<?php

namespace DigitFab\Core\Classes;

use DigitFab\Core\Classes\Contracts\Entity;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use October\Rain\Support\Facades\Twig;

abstract class EntityController
{
    protected $layout;

    protected $itemPage;

    protected $itemsPage;

    /**
     * @var Entity
     */
    protected $entity;

    abstract protected function getPluginSlug();

    public function __construct()
    {
        $this->layout = Config::get("digitfab.{$this->getPluginSlug()}::product.layout", ['content']);

        $this->itemPage = Config::get(
            "digitfab.{$this->getPluginSlug()}::item_page",
            Config::get('digitfab.core::default_page', '')
        );

        $this->itemsPage = Config::get(
            "digitfab.{$this->getPluginSlug()}::items_page",
            Config::get('digitfab.core::default_page', '')
        );
    }

    protected function setLayoutVars($vars = [])
    {
        $common['mainContent'] = $this->buildEntityLayout();
        $common['title'] = $this->entity->getTitle();
        $common['breadcrumbs'] = $this->entity->getBreadcrumbs();
        $common['seo_title'] = $this->entity->getSeoTitle();
        $common['seo_description'] = $this->entity->getSeoDescription();
        $common['seo_keywords'] = $this->entity->getSeoKeywords();

        Event::listen('cms.page.beforeRenderPage', function ($controller) use ($common, $vars) {
            $controller->vars = array_merge($controller->vars, $common, $vars);
        });
    }

    protected function buildEntityLayout()
    {
        $html = '';

        foreach ($this->layout as $row) {
            $partPath = $this->getLayoutPartPath($row);
            if (file_exists($partPath)) {
                $html .= Twig::parse(file_get_contents($partPath), [
                    'entity' => $this->entity,
                ]);
            }
        }

        return $html;
    }

    protected function getLayoutPartPath($partName)
    {
        $pluginsPath = plugins_path();
        $themesPath = themes_path();

        $currentTheme = Config('cms.activeTheme');

        $themePartPath = "{$themesPath}/{$currentTheme}/views/digitfab/{$this->getPluginSlug()}/item/_{$partName}.htm";

        if (file_exists($themePartPath)) {
            return $themePartPath;
        }

        return "{$pluginsPath}/digitfab/{$this->getPluginSlug()}/views/item/_{$partName}.htm";
    }
}
