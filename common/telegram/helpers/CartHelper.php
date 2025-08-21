<?php

namespace common\telegram\helpers;

use common\models\Cart;

class CartHelper
{
    /**
     * Savat yoki buyurtma textini generatsiya qiladi
     * @param Cart[] $items
     * @param string $title  Matn boshi (masalan: "🛒 Sizning savatingiz" yoki "🛒 Sizning buyurtmangiz")
     * @param bool $askConfirm  true bo‘lsa "Tasdiqlaysizmi?" qo‘shiladi
     * @return string
     */
    public static function generateCartText(array $items, string $title, bool $askConfirm = false): string
    {
        $lines = [];
        $total = 0;

        foreach ($items as $row) {
            /** @var Cart $row */
            $name  = $row->product->name_uz ?? 'Mahsulot';
            $qty   = (int)$row->quantity;
            $price = (int)$row->price;
            $sum   = $qty * $price;
            $total += $sum;
            $lines[] = "{$name} x {$qty} = {$sum} so‘m";
        }

        $text  = "{$title}:\n\n";
        $text .= implode("\n", $lines);
        $text .= "\n\n💴 Jami: {$total} so‘m";

        if ($askConfirm) {
            $text .= "\nTasdiqlaysizmi?";
        }

        return $text;
    }
}
