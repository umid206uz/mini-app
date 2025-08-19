<?php

namespace common\telegram\text;

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

    public static function invalidVerificationCodeText(): string
    {
        return "Kiritilgan kod xato qaytadan urinib ko'ring!";
    }

    public static function invalidPhoneNumberText(): string
    {
        return "❌ Iltimos, to‘g‘ri formatda telefon yuboring";
    }

    public static function phoneNumberText($phone): string
    {
        return "✅ Sizning telefon raqamingiz:\n" . $phone;
    }

    public static function sendVerificationCodeText($verification_code): string
    {
        return 'Sugo bot uchun tasdiqlash kodingiz: ' . $verification_code . '. Ushbu kodni hech kimga bermang!';
    }
}
