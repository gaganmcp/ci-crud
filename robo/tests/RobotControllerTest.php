<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


class RobotControllerTest extends TestCase
{
	const FLOOR_HARD = 'hard';
    const FLOOR_CARPET = 'carpet';
	
	/**
     * @dataProvider floorTypeProvider
     */
    public function testClean(string $floorType, int $area)
    {
		$floorTypes = array(self::FLOOR_HARD, self::FLOOR_CARPET); 
          
        $this->assertNotEmpty($floorType, "Empty");
        $this->assertContains($floorType, $floorTypes, "Invalid FloorType.") ;
		
        
        $isValidate = $this->validateInput($floorType, $area);
		$this->assertSame($isValidate, true, 'Valid Output');
        
    }
	public function floorTypeProvider()
    {
        return [
            ['hard', 60],
            ['hard', 50],
            ['carpet', 60],
            ['carpet', 50]
        ];
    }

    private function validateInput($floorType, $area)
    {
        $isValidate = true;
        $floorType = strtolower($floorType);

        if (self::FLOOR_HARD !== $floorType && self::FLOOR_CARPET !== $floorType) {
            $isValidate = false;
        } elseif (self::FLOOR_HARD == $floorType && $area > 70) {
            $isValidate = false;
        } elseif (self::FLOOR_CARPET == $floorType && $area > 60) {
            $isValidate = false;
        }
        return $isValidate;
    }
}
