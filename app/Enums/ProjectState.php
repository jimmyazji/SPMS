<?php

namespace App\Enums;

enum ProjectState: string
{
    case Proposition = 'proposition';
    case Approving = 'awaiting approval';
    case Incomplete = 'incomplete';
    case Evaluating = 'under evaluation';
    case Complete = 'complete';
}
