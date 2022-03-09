<?php

/**
 * Balocco Inc.
 * ～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～
 * 株式会社バロッコはシステム設計・開発会社として、
 * 社員・顧客企業・パートナー企業と共に企業価値向上に全力を尽くします
 *
 * 1. プロフェッショナル集団として人間力・経験・知識を培う
 * 2. システム設計・開発を通じて、顧客企業の成長を活性化する
 * 3. 顧客企業・パートナー企業・弊社全てが社会的意義のある事業を営み、全てがwin-winとなるビジネスをする
 * ～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～
 * 本社所在地
 * 〒101-0032　東京都千代田区岩本町2-9-9 TSビル4F
 * TEL:03-6240-9877
 *
 * 大阪営業所
 * 〒530-0063　大阪府大阪市北区太融寺町2-17 太融寺ビル9F 902
 *
 * https://www.balocco.info/
 * © Balocco Inc. All Rights Reserved.
 */

namespace GitBalocco\CommonStructures\Value;

use GitBalocco\CommonStructures\Value\Exception\InitializeValueException;
use GitBalocco\CommonStructures\Value\Exception\InvalidValueValidatorException;
use GitBalocco\CommonStructures\Value\Validator\ValueValidatorInterface;

abstract class Value implements ValueInterface
{
    protected mixed $value;

    /**
     * @psalm-suppress MissingParamType
     * @param $valueCandidate
     */
    public function __construct($valueCandidate)
    {
        $validatorClassName = static::validatorClassName();

        if (!is_subclass_of($validatorClassName, ValueValidatorInterface::class)) {
            //バリデータが所定のインターフェースを実装してないのでNG
            throw new InvalidValueValidatorException($validatorClassName);
        }
        /** @var ValueValidatorInterface $validator */
        $validator = new $validatorClassName($valueCandidate);

        if (!$validator->__invoke()) {
            throw new InitializeValueException(static::class, $validator->getMessage());
        }
        $this->value = $valueCandidate;
    }

    abstract protected static function validatorClassName(): string;

    /**
     * getValue
     * @psalm-suppress MissingReturnType
     * @return mixed
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function getValue()
    {
        return $this->value;
    }
}
