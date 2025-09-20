<?php
namespace App\Enums;

enum ColorEnum: string
{
    case Blue = 'blue';
    case Green = 'green';
    case Red = 'red';
    case Yellow = 'yellow';
    case Purple = 'purple';
    case Pink = 'pink';
    case Gray = 'gray';
    case Orange = 'orange';
    case Teal = 'teal';
    case Cyan = 'cyan';

    public function label(): string
    {
        return match ($this) {
            self::Blue => 'Blue',
            self::Green => 'Green',
            self::Red => 'Red',
            self::Yellow => 'Yellow',
            self::Purple => 'Purple',
            self::Pink => 'Pink',
            self::Gray => 'Gray',
            self::Orange => 'Orange',
            self::Teal => 'Teal',
            self::Cyan => 'Cyan',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
