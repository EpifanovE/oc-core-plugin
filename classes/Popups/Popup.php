<?php

namespace EEV\Core\Classes\Popups;

use Illuminate\Support\Facades\Config;

class Popup
{
    const TYPE_IMAGE = 'image';
    const TYPE_INLINE = 'inline';

    protected $name;

    protected $title;

    protected $partial;

    protected $type = self::TYPE_IMAGE;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function make($name): Popup
    {
        return new self($name);
    }

    public static function get($name)
    {
        $popupsArray = Config::get('eev.core::popups');

        if (empty($popupsArray)) {
            return null;
        }

        foreach ($popupsArray as $popup) {
            /**
             * @var Popup $popup
             */
            if ($popup->getName() === $name) {
                return $popup;
            }
        }

        return null;
    }

    public static function getFormsList(): array
    {
        $popupsArray = Config::get('eev.core::popups');

        if (empty($popupsArray)) {
            return [];
        }

        $list = [];

        foreach ($popupsArray as $popup) {
            /**
             * @var Popup $popup
             */
            $list[$popup->getName()] = ($popup->getTitle()) ? $popup->getTitle() : $popup->getName();
        }

        return $list;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setPartial($partial)
    {
        $this->partial = $partial;
        return $this;
    }

    public function getPartial(): string
    {
        return $this->partial;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }
}