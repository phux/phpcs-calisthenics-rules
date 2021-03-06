<?php declare(strict_types=1);

namespace ObjectCalisthenics\Tests\Helper;

use ObjectCalisthenics\Helper\ClassAnalyzer;
use ObjectCalisthenics\Tests\FileFactory;
use PHP_CodeSniffer\Files\File;
use PHPUnit\Framework\TestCase;

final class ClassAnalyzerTest extends TestCase
{
    /**
     * @var int
     */
    private const CLASS_POSITION = 3;

    /**
     * @var File
     */
    private $file;

    protected function setUp()
    {
        $fileFactory = new FileFactory();
        $this->file = $fileFactory->createFile(__DIR__.'/ClassAnalyzerSource/SomeFile.php.inc');
    }

    public function testMethodCount()
    {
        $this->assertSame(2, ClassAnalyzer::getClassMethodCount($this->file, self::CLASS_POSITION));
    }

    public function testProperties()
    {
        $properties = ClassAnalyzer::getClassProperties($this->file, self::CLASS_POSITION);

        $this->assertCount(1, $properties);

        $this->assertArrayHasKey(0, $properties);
        $this->assertArrayHasKey('type', $properties[0]);
        $this->assertSame('int', $properties[0]['type']);
    }

    public function testPropertyCount()
    {
        $this->assertSame(1, ClassAnalyzer::getClassPropertiesCount($this->file, self::CLASS_POSITION));
    }
}
