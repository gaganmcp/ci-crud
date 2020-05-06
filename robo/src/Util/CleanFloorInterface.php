<?php

namespace App\Util;

/**
 * An interface that will use for clean floor.
 */
interface CleanFloorInterface
{
    public function hardClean(int $area);

    public function carpetClean(int $area);
}
