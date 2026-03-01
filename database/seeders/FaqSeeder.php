<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'question' => 'How do I make payment?',
            'answer' => 'After we receive your delivery request, you will get an invoice through which you can make payments. The invoice offers you the option of making secured payments through a third-party payment platform (Paystack/Flutterwave), or your Bank Card.',
        ]);

        Faq::create([
            'question' => 'Will my parcel be delivered to my final destination anywhere in Nigeria?',
            'answer' => 'Yes. We will deliver anywhere in Nigeria, so long as your preferred address is listed in delivery locations.',
        ]);

        Faq::create([
            'question' => 'Do you ship all kind of items?',
            'answer' => 'Yes, excluding items prohibited by law enforcement agencies. The size of your item is no barrier as special arrangements are available for supersized items',
        ]);
    }
}
