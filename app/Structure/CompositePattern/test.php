<?php

interface FileSystemNode
{
    public function getName();

    public function getSize();
}

class File implements FileSystemNode{

    public function __construct(protected readonly string $name,protected readonly float $size)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }

}

class Directorys  implements FileSystemNode{

    public function __construct(protected string $name,protected array $nodes = [])
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getNode(): array
    {
        return $this->nodes;
    }

    public function addNode(FileSystemNode $node): void
    {
        $this->nodes[] = $node;
    }

    public function getSize(): int
    {
        $size = 0;
        foreach ($this->nodes as $node) {
            $size += $node->getSize();
        }
        return $size;
    }
}

$root = new Directorys("root");
$home = new Directorys("home");
$document = new Directorys("document");
$file1 = new File("file1", 100);
$file2 = new File("file2", 200);

$root->addNode($home);
$home->addNode($document);
$document->addNode($file1);
$document->addNode($file2);

echo $root->getName();  // Output: root
echo $root->getSize();  // Output: 300