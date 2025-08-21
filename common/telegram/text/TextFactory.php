<?php

namespace common\telegram\text;

use common\models\Cart;

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
        return "Buyurtma bekor qilindi. 😕 Menyuni ochib savatchani to'ldirishingiz mumkin ☺";
    }

    public static function mainMenuText(): string
    {
        return 'Endi asosiy menyu:';
    }

    public static function orderAcceptedText($order_id, $lines, $total): string
    {
        $text = "✅ Buyurtma qabul qilindi!\n\n";
        $text .= "Buyurtma raqami: #{$order_id}\n\n";
        $text .= implode("\n", $lines);
        $text .= "\n\nJami: {$total} so‘m";
        return $text;
    }

    public static function cartText($cart): string
    {
        $lines = [];
        $total = 0;
        foreach ($cart as $row) {
            /** @var Cart $row */
            $name = $row->product->name_uz ?? 'Mahsulot';
            $qty  = (int)$row->quantity;
            $price = (int)$row->price;
            $sum = $qty * $price;
            $total += $sum;
            $lines[] = "{$name} x {$qty} = {$sum} so‘m";
        }
        $text = "🛒 Sizning savatingiz:\n\n";
        $text .= implode("\n", $lines);
        $text .= "\n\n💴Jami: {$total} so‘m";
        return $text;
    }
}
