<?php

declare(strict_types=1);

use App\Entity\ItemOld;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testItemOnNotValidContent()
    {
        $content = 'ctetur, elit ac molestie pretium, ipsum felis 
        rutrum elit, ut congue metus metus in purus. Curabitur ultrices lacus non orci sagittis rutrum. Quisque eget sem nullam.';
        $item = new ItemOld('Item', $content, new DateTime());
        $this->assertFalse($item->isValid());
    }

    public function testItemOnValidContent()
    {
        $item = new ItemOld('Item', 'Lorem ipsum dolor sit amet', new DateTime());
        $this->assertTrue($item->isValid());
    }

}
