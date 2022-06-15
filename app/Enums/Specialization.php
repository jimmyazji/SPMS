<?php

namespace App\Enums;

enum Specialization: string
{
    case None = 'none';
    case Software = 'software engineering';
    case Communication = 'communications and networking';
    case AI = "artificial intelligence";
    case Security = "security";
}
