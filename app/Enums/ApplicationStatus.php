<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case Applied = 'applied';
    case Interview = 'interview';
    case Offer = 'offer';
    case Rejected = 'rejected';

    public function label(): string
    {
        return ucfirst($this->value);
    }

    public function color():string
    {
        return match ($this)
        {
            self::Offer => 'bg-green-100 text-green-800',
            self::Interview => 'bg-yellow-100 text-yellow-800',
            self::Rejected => 'bg-red-100 text-red-800',
            self::Applied => 'bg-gray-100 text-gray-800',
        };
    }
}
