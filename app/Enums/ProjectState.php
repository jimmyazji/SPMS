<?php

namespace App\Enums;

enum ProjectState: string
{
    case Proposition = 'proposition';
    case Approving = 'awaiting approval';
    case Rejected = 'rejected';
    case Incomplete = 'under development';
    case Evaluating = 'under evaluation';
    case Complete = 'complete';
}
