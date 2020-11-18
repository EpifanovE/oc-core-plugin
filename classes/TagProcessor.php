<?php

namespace DigitFab\Core\Classes;

class TagProcessor
{
    protected $sources;

    protected $tagStart = '\[\[';

    protected $tagEnd = '\]\]';

    protected $divider = '-';

    public function __construct($sources = [])
    {
        $this->sources = $sources;
    }

    public function get($template, $tagsSource)
    {
        $this->sources = $this->prepareTagsSource($tagsSource);

        $patterns = array_map(function($tagName) {
            return "/{$tagName}/";
        }, array_keys($this->sources));

        ksort($patterns);

        $dividerTag = "{$this->tagStart}divider{$this->tagEnd}";

        $result = preg_replace($patterns, $this->getValues(), $template);
        $result = preg_replace("/{$dividerTag}/", $this->divider, $result);
        $result = preg_replace("/{$this->divider}\s+{$this->divider}/", $this->divider, $result);
        $result = preg_replace("/{$this->tagStart}.+{$this->tagEnd}/", '', $result);

        return trim($result, "{$this->divider} ");
    }

    protected function getValues() {
        return array_values(array_map(function ($value) {
            if (is_array($value)) {
                return implode(" {$this->divider} ", $value);
            }

            return $value;
        }, $this->sources));
    }

    protected function prepareTagsSource($tagsSource) {
        $array = array_merge($this->sources, $tagsSource);

        foreach ($array as $key => $value) {
            $array["{$this->tagStart}{$key}{$this->tagEnd}"] = $value;
            unset($array[$key]);
        }

        ksort($array);

        return $array;
    }
}
