<?php


namespace Konsulting\FormBuilder\Laravel;


use Illuminate\Contracts\Support\Htmlable;
use Konsulting\FormBuilder\Elements\ElementDecorator;

class HtmlableElementDecorator extends ElementDecorator implements Htmlable
{
    public function toHtml()
    {
        return $this->element->toHtml();
    }
}