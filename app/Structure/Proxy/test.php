<?php

interface Image
{
    public function display();
}

class RealImage implements Image
{

    public function __construct(protected readonly string $filename)
    {
        $this->loadFromDisk();
    }

    private function loadFromDisk(): void
    {
        echo "Loading image: $this->filename\n";
    }

    public function display(): void
    {
        echo "Displaying image: $this->filename\n";
    }
}

class ProxyImage implements Image
{
    private ?RealImage $realImage = null;

    public function __construct(protected readonly string $filename)
    {
    }

    public function display(): void
    {
        if ($this->realImage == null) {
            $this->realImage = new RealImage($this->filename);
        }
        $this->realImage->display();
    }
}

// Client code
$image1 = new ProxyImage("image1.jpg");
$image2 = new ProxyImage("image2.jpg");

// Image will be loaded and displayed
$image1->display();

// Image will be displayed without loading
$image1->display();

// Image will be loaded and displayed
$image2->display();

