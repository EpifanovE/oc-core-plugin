<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use DigitFab\Core\Classes\Company\SocialType;
use DigitFab\Core\Models\Social;

class Socials extends WidgetType
{
    protected $name = self::SOCIALS;

    protected $items;

    protected function setData()
    {
        $this->items = Social::orderBy('sort_order', 'ASC')->active()->get();
        $this->data['content'] = $this->items();
    }

    public function items()
    {

        $html = '';

        if ($this->items->count() === 0) {
            return $html;
        }

        foreach ($this->items as $item) {
            $html .= $this->getItem($item);
        }

        return $html;
    }

    protected function getItem($item)
    {
        $html = "";

        if ( ! empty($item->link)) {
            $html .= '<a href="' . $this->getLink($item) . '" class="Icon Socials__Item" target="_blank" rel="nofollow">';
        } else {
            $html .= '<span class="Icon Socials__Item">';
        }

        $icon = $this->getIconClass($item) ? ' ' . $this->getIconClass($item) : '';

        $html .= "<i class='Icon__Inner{$icon}'></i>";

        if ( ! empty($item->link)) {
            $html .= '</a>';
        } else {
            $html .= '</span>';
        }

        return $html;
    }

    protected function getIconClass($item)
    {
        if ( ! empty($item->icon_class)) {
            return $item->icon_class;
        }

        if (isset(SocialType::all()[$item->type]) && isset(SocialType::all()[$item->type]['icon-class'])) {
            return SocialType::all()[$item->type]['icon-class'];
        }

        return '';
    }

    protected function getLink($item)
    {
        return $item->link;
    }
}
