<?php

declare(strict_types=1);

namespace Brick\DateTime\Doctrine\Types;

use Brick\DateTime\DayOfWeek;
use Brick\DateTime\Doctrine\UnexpectedValueException;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Doctrine type for DayOfWeek.
 *
 * Maps to a database small integer column.
 */
final class DayOfWeekType extends Type
{
    public function getName()
    {
        return 'DayOfWeek';
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getSmallIntTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof DayOfWeek) {
            return $value->getValue();
        }

        throw new UnexpectedValueException(DayOfWeek::class, $value);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        return DayOfWeek::of((int) $value);
    }

    public function getBindingType()
    {
        return \PDO::PARAM_INT;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
