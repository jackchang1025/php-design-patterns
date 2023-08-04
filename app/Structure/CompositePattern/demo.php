<?php

namespace App\CompositePattern;

abstract class FormElement
{
    protected array $data;

    public function __construct(protected string $name, protected string $title)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    abstract public function render(): string;

}

class Input extends FormElement
{

    public function __construct(string $name, string $title, protected string $type)
    {
        parent::__construct($name, $title);
    }

    public function render(): string
    {
        return "<label for=\"{$this->name}\">{$this->title}</label>\n" .
            "<input name=\"{$this->name}\" type=\"{$this->type}\" value=\"{$this->data}\">\n";
    }
}


abstract class FieldComposite  extends FormElement
{
    protected array $fields = [];

    public function add(FormElement $element): void
    {
        $this->fields[$element->getName()] = $element;
    }

    public function remove(FormElement $element): void
    {
        $this->fields = array_filter($this->fields, function ($child) use ($element) {
            return $child != $element;
        });
    }

    /**
     * Whereas a Leaf's method just does the job, the Composite's method almost
     * always has to take its sub-objects into account.
     *
     * In this case, the composite can accept structured data.
     *
     * @param array $data
     */
    public function setData(array $data): void
    {
        foreach ($this->fields as $name => $field) {
            if (isset($data[$name])) {
                $field->setData($data[$name]);
            }
        }
    }

    /**
     * The same logic applies to the getter. It returns the structured data of
     * the composite itself (if any) and all the children data.
     */
    public function getData(): array
    {
        $data = [];

        foreach ($this->fields as $name => $field) {
            $data[$name] = $field->getData();
        }

        return $data;
    }

    /**
     * The base implementation of the Composite's rendering simply combines
     * results of all children. Concrete Composites will be able to reuse this
     * implementation in their real rendering implementations.
     */
    public function render(): string
    {
        $output = "";

        foreach ($this->fields as $field) {
            $output .= $field->render();
        }

        return $output;
    }
}


/**
 * The fieldset element is a Concrete Composite.
 */
class Fieldset extends FieldComposite
{
    public function render(): string
    {
        // Note how the combined rendering result of children is incorporated
        // into the fieldset tag.
        $output = parent::render();

        return "<fieldset><legend>{$this->title}</legend>\n$output</fieldset>\n";
    }
}

/**
 * And so is the form element.
 */
class Form extends FieldComposite
{
    public function __construct(string $name, string $title, protected string $url)
    {
        parent::__construct($name, $title);
    }

    public function render(): string
    {
        $output = parent::render();
        return "<form action=\"{$this->url}\">\n<h3>{$this->title}</h3>\n$output</form>\n";
    }
}

$form = new Form('product', "Add product", "/product/add");
$form->add(new Input('name', "Name", 'text'));
$form->add(new Input('description', "Description", 'text'));

$picture = new Fieldset('photo', "Product photo");
$picture->add(new Input('caption', "Caption", 'text'));
$picture->add(new Input('image', "Image", 'file'));
$form->add($picture);

return $form;


