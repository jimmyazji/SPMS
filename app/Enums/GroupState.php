<?php

namespace App\Enums;

enum GroupState: string
{
    case Recruiting = 'looking for members';
    case Invites = 'invites only';
    case Full = 'full';
}
