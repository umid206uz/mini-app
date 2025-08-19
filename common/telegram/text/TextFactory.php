<?php

namespace common\telegram\keyboards;

class TextFactory
{
    public static function helloAndAskPhoneText(): string
    {
        return "Assalomu alaykum!\nBuyurtma berish uchun telefon raqamingizni ulashing yoki 991234567 formatida kiriting:";
    }

    public static function askCodeText(): string
    {
        return "Kiritilgan telefon raqamga jo'natilgan kodni kiriting:";
    }
}
