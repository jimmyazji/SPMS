<?php

namespace App\Enums;

enum ProjectState: string
{
    case Incomplete = 'incomplete';
    case Complete = 'complete';
    case Evaluating = 'under evaluation';
}
