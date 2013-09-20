<?php
class DimensionTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup (each test)
     */
    public function setUp()
    {
        // Path to test assets
        $this->assetsDirectory = dirname(__DIR__) . '/assets';

        // Create stubbed storage instance
        $this->storage = $this->getMock(
            '\Upload\Storage\FileSystem',
            array('upload'),
            array($this->assetsDirectory)
        );
        $this->storage->expects($this->any())
                      ->method('upload')
                      ->will($this->returnValue(true));

        // Reset $_FILES superglobal
        $_FILES['foo'] = array(
            'name' => 'foo.txt',
            'tmp_name' => $this->assetsDirectory . '/foo.txt',
            'error' => 0
        );
    }

    public function testValidDimension()
    {
        $file = new \Upload\File('foo', $this->storage);
        $validation = new \Upload\Validation\Dimension(480, 640, 240, 320);
        $this->assertTrue($validation->validate($file));
    }
}
