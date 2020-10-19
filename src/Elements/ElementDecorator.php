<?php

namespace Konsulting\FormBuilder\Elements;

class ElementDecorator implements ElementInterface
{
    /**
     * The element instance to decorate.
     *
     * @var Element
     */
    protected $element;

    /**
     * FormBuilderTooltips constructor.
     *
     * @param Element $element
     */
    public function __construct(Element $element)
    {
        $this->element = $element;
    }

    /**
     * Defer all unknown methods to the decorated instance. If an element is returned, update the stored element and
     * return $this.
     *
     * @param string $method
     * @param array  $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        $result = $this->element->$method(...$args);

        if ($result instanceof ElementInterface) {
            $this->element = $result;

            return $this;
        }

        return $result;
    }

    /**
     * @param string $name
     * @return mixed
     */
    function __get($name)
    {
        return $this->element->$name;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    function __set($name, $value)
    {
        $this->element->$name = $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    function __isset($name)
    {
        return isset($this->element->$name);
    }

    /**
     * @param string $name
     */
    function __unset($name)
    {
        unset($this->element->$name);
    }

    public function withValue($value)
    {
        $this->element->withValue($value);

        return $this;
    }

    public function withLabel($label)
    {
        $this->element->withLabel($label);

        return $this;
    }

    public function withoutLabel()
    {
        $this->element->withoutLabel();

        return $this;
    }

    public function withHelp($label)
    {
        $this->element->withHelp($label);

        return $this;
    }

    public function withError($error)
    {
        $this->element->withError($error);

        return $this;
    }

    public function withoutError()
    {
        $this->element->withoutError();

        return $this;
    }

    public function withFeedback($type, $message)
    {
        $this->element->withFeedback($type, $message);

        return $this;
    }

    public function withoutFeedback()
    {
        $this->element = $this->element->withoutFeedback();

        return $this;
    }

    public function withAttribute($attribute, $value)
    {
        $this->element->withAttribute($attribute, $value);

        return $this;
    }

    public function withAttributes($attributes = [])
    {
        $this->element->withAttributes($attributes);

        return $this;
    }

    public function wire($action, $value)
    {
        return $this->element->wire($action, $value);
    }

    public function withAddon($content, $position = 'after')
    {
        $this->element->withAddon($content, $position);

        return $this;
    }

    public function prepend($prepend)
    {
        $this->element->prepend($prepend);

        return $this;
    }

    public function append($append)
    {
        $this->element->append($append);

        return $this;
    }

    public function __toString()
    {
        return $this->element->__toString();
    }

    public function attributes()
    {
        return $this->element->attributes();

    }

    public function attributesExcept()
    {
        return $this->element->attributesExcept();
    }

    public function getLabelFor()
    {
        return $this->element->getLabelFor();
    }

    public function withTooltip($text)
    {
        $this->element->withTooltip($text);

        return $this;
    }

    public function baseElement()
    {
        return $this->element instanceof ElementDecorator ? $this->element->baseElement() : $this->element;
    }
}
