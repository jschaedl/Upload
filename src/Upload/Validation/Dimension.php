<?php
/**
 * Upload
 *
 * @author      Josh Lockhart <info@joshlockhart.com>
 * @copyright   2012 Josh Lockhart
 * @link        http://www.joshlockhart.com
 * @version     1.0.0
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Upload\Validation;

/**
 * Validate Upload File Size
 *
 * This class validates an uploads file size using maximum and (optionally)
 * minimum file size bounds (inclusive). Specify acceptable file sizes
 * as an integer (in bytes) or as a human-readable string (e.g. "5MB").
 *
 * @author  Jan Schädlich <info@janschaedlich.com>
 * @since   1.0.0
 * @package Upload
 */
class Dimension extends \Upload\Validation\Base
{
    /**
     * Minimum acceptable file size (bytes)
     * @var int
     */
    protected $minWidth;

    /**
     * Minimum acceptable file size (bytes)
     * @var int
     */
    protected $minHeight;

    /**
     * Maximum acceptable file size (bytes)
     * @var int
     */
    protected $maxWidth;

    /**
     * Maximum acceptable file size (bytes)
     * @var int
     */
    protected $maxHeight;

    /**
     * Error message
     * @var string
     */
    protected $message = 'Invalid image dimension';

    /**
     * Constructor
     * @param int $maxSize Maximum acceptable file size in bytes (inclusive)
     * @param int $minSize Minimum acceptable file size in bytes (inclusive)
     */
    public function __construct($maxWidth, $maxHeight, $minWidth = 0, $minHeight = 0)
    {
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
        $this->minWidth = $minWidth;
        $this->minHeight = $minHeight;
    }

    /**
     * Validate
     * @param  \Upload\File $file
     * @return bool
     */
    public function validate(\Upload\File $file)
    {
        $fileDimension = $file->getDimensions();

        $isValid = true;

        if ($fileDimension['width'] < $this->minWidth) {
            $this->setMessage('Image widths is too small');
            $isValid = false;
        }

        if($fileDimension['height'] < $this->minHeight) {
            $this->setMessage('Image heights is too small');
            $isValid = false;
        }

        if ($fileDimension['width'] > $this->maxWidth) {
            $this->setMessage('Image widths is too large');
            $isValid = false;
        }

        if($fileDimension['height'] > $this->maxHeight) {
            $this->setMessage('Image heights is too large');
            $isValid = false;
        }

        return $isValid;
    }
}
