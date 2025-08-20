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

    public static function openMenuText(): string
    {
        return 'Menyuni oching va savatchani to\'ldiring';
    }

    public static function emptyCartText(): string
    {
        return 'Sizning savatchangiz hozircha bo\'sh 😕';
    }

    public static function orderCancelledText(): string
    {
        return "Buyurtma bekor qilindi. 😕 Menyuni ochib savatchani to\'ldirishingiz mumkin ☺";
    }

    public static function mainMenuText(): string
    {
        return 'Endi asosiy menyu:';
    }

    public static function orderAcceptedText($order_id, $total): string
    {
        return "✅ Buyurtma qabul qilindi!\nBuyurtma raqami: #{$order_id}\nJami: {$total} so‘m";
    }
}
