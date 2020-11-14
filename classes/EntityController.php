<?php

namespace DigitFab\Core\Classes;

use DigitFab\Core\Classes\Contracts\Entity;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use October\Rain\Support\Facades\Twig;

abstract class EntityController
{
    protected $layouts;

    protected $itemPage;

    protected $archivePage;

    protected $categorySlug;

    protected $typeSlug;

    protected $isList = false;

    /**
     * @var Entity
     */
    protected $entity;

    abstract protected function getPluginSlug();

    public function __construct()
    {
        $this->layouts = Config::get("digitfab.{$this->getPluginSlug()}::layouts", []);

        $this->itemPage = Config::get(
            "digitfab.{$this->getPluginSlug()}::item_page",
            Config::get('digitfab.core::default_page', '')
        );

        $this->archivePage = Config::get(
            "digitfab.{$this->getPluginSlug()}::items_page",
            Config::get('digitfab.core::default_page', '')
        );

        $this->categorySlug = Config::get("digitfab.{$this->getPluginSlug()}::category_slug", '');
    }

    protected function setLayoutVars($vars = [])
    {
        $common['mainContent'] = $this->buildLayout();
        $common['title'] = $this->entity->getTitle();
        $common['breadcrumbs'] = $this->entity->getBreadcrumbs();
        $common['seo_title'] = $this->entity->getSeoTitle();
        $common['seo_description'] = $this->entity->getSeoDescription();
        $common['seo_keywords'] = $this->entity->getSeoKeywords();

        Event::listen('cms.page.beforeRenderPage', function ($controller) use ($common, $vars) {
            $controller->vars = array_merge($controller->vars, $common, $vars);
        });
    }

    protected function buildLayout()
    {
        $html = '';

        foreach ($this->getLayout() as $row) {
            $partPath = $this->getLayoutPartPath($row);
            if (file_exists($partPath)) {
                $html .= Twig::parse(file_get_contents($partPath), [
                    'entity' => $this->entity,
                ]);
            }
        }

        return $html;
    }

    protected function getLayout() {
        $arrayKey = $this->isList ? 'archive' : 'item';

        return !empty($this->layouts[$this->typeSlug][$arrayKey])
            ? $this->layouts[$this->typeSlug][$arrayKey]
            : ['content'];
    }

    protected function getLayoutPartPath($partName)
    {
        $pluginsPath = plugins_path();
        $themesPath = themes_path();

        $currentTheme = Config('cms.activeTheme');

        $themePartPath = "{$themesPath}/{$currentTheme}/views/digitfab/{$this->getPluginSlug()}/layout/_{$partName}.htm";

        if (file_exists($themePartPath)) {
            return $themePartPath;
        }

        return "{$pluginsPath}/digitfab/{$this->getPluginSlug()}/views/layout/_{$partName}.htm";
    }
}
