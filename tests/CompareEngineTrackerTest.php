<?php

namespace CompareEngineTracker\tests;

require __DIR__."/../lib/CompareEngineTracker/Service/CompareEngineTracker.php";

use Doctrine\Common\Annotations\AnnotationReader;
use CompareEngineTracker\Services\CompareEngineTracker;
use PHPUnit\Framework\TestCase;

/**
 * Class CompareEngineTrackerTest
 *
 * @package Tests\MarketPlaceBundle\Services
 */
class CompareEngineTrackerTest extends TestCase
{
    public function testCompareTwoEqualObjects()
    {
        $samePersonPhone = [
            'number'      => '01000000000',
            'countryCode' => '+02',
        ];
        $oldObject = new PersonModel();
        $oldObject->setName("sameName");
        $oldObject->setPhone($samePersonPhone);
        $newObject = new PersonModel();
        $newObject->setName("sameName");
        $newObject->setPhone($samePersonPhone);
        $reader = new AnnotationReader();
        $compareEngine = new CompareEngineTracker($reader);
        $result        = $compareEngine->compare($oldObject, $newObject);
        $this->assertFalse( $result['isChanged']);
    }

    public function testCompareTwoNotEqualEmbeddedObjects()
    {
        $firstPersonPhone = [
            'number'      => '01000000000',
            'countryCode' => '+02',
        ];
        $secondPersonPhone = [
            'number'      => '01111111111',
            'countryCode' => '+099',
        ];
        $oldObject = new PersonModel();
        $oldObject->setPhone($firstPersonPhone);
        $newObject = new PersonModel();
        $newObject->setPhone($secondPersonPhone);
        $reader        = new AnnotationReader();
        $compareEngine = new CompareEngineTracker($reader);
        $result        = $compareEngine->compare($oldObject, $newObject);
        $this->assertTrue($result['isChanged']);
    }

    public function testCompareTwoNotEqualFlatObjects()
    {
        $oldObject = new PersonModel();
        $oldObject->setName("firstPersonName");
        $newObject = new PersonModel();
        $newObject->setName("secondPersonName");
        $reader = new AnnotationReader();
        $compareEngine = new CompareEngineTracker($reader);
        $result        = $compareEngine->compare($oldObject, $newObject);
        $this->assertTrue($result['isChanged']);
    }

    public function testCompareTwoNotEqualObjects()
    {
        $firstPersonPhone = [
            'number'      => '01000000000',
            'countryCode' => '+02',
        ];
        $secondPersonPhone = [
            'number'      => '01111111111',
            'countryCode' => '+099',
        ];
        $oldObject = new PersonModel();
        $oldObject->setName('firstPersonName');
        $oldObject->setPhone($firstPersonPhone);
        $newObject = new PersonModel();
        $newObject->setName('secondPersonName');
        $newObject->setPhone($secondPersonPhone);
        $reader        = new AnnotationReader();
        $compareEngine = new CompareEngineTracker($reader);
        $result        = $compareEngine->compare($oldObject, $newObject);
        $this->assertTrue($result['isChanged']);
    }

}
