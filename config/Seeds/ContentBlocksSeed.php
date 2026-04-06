<?php
declare(strict_types=1);

use Migrations\BaseSeed;
use Cake\ORM\TableRegistry;

/**
 * ContentBlocks seed.
 */
class ContentBlocksSeed extends BaseSeed
{
    public function run(): void
    {
        $table = $this->table('content_blocks');

        $table->insert([
            ['id'=>1,'page'=>'faq','parent_id'=>null,'type'=>'text','label'=>'Header','value'=>'Placing an Order','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>2,'page'=>'faq','parent_id'=>1,'type'=>'text','label'=>'Icon','value'=>'bi-cart-plus','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>3,'page'=>'faq','parent_id'=>1,'type'=>'text','label'=>'Question','value'=>'Do I need to create an account to place an order?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>4,'page'=>'faq','parent_id'=>3,'type'=>'text','label'=>'Answer','value'=>'You can order as a guest if you create an account. However, creating an account allows for faster checkout and order tracking.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>5,'page'=>'faq','parent_id'=>1,'type'=>'text','label'=>'Question','value'=>'Can I change or cancel my order after it\'s been placed?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>6,'page'=>'faq','parent_id'=>5,'type'=>'text','label'=>'Answer','value'=>'Orders can be modified or canceled within a short time after placing them. Contact our customer support as soon as possible to make any changes.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>7,'page'=>'faq','parent_id'=>1,'type'=>'text','label'=>'Question','value'=>'What payment methods do you accept?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>8,'page'=>'faq','parent_id'=>7,'type'=>'text','label'=>'Answer','value'=>'We accept various payment methods, including credit/debit cards, PayPal, and other online payment options. You can choose your preferred payment method during the checkout process.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>9,'page'=>'faq','parent_id'=>1,'type'=>'text','label'=>'Question','value'=>'Is my payment information secure?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>10,'page'=>'faq','parent_id'=>9,'type'=>'text','label'=>'Answer','value'=>'Yes, we take security seriously. We use industry-standard encryption to protect your payment information, and we do not store your payment details on our servers.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>11,'page'=>'faq','parent_id'=>1,'type'=>'text','label'=>'Question','value'=>'How do I track the status of my order?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>12,'page'=>'faq','parent_id'=>11,'type'=>'text','label'=>'Answer','value'=>'You can track your order by logging into your account (if you have one) and accessing the order history. We\'ll also send you email updates as your order progresses through the fulfillment process.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
        ])->save();

        $table->insert([
            ['id'=>13,'page'=>'faq','parent_id'=>null,'type'=>'text','label'=>'Header','value'=>'Refunds and Exchanges','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>14,'page'=>'faq','parent_id'=>13,'type'=>'text','label'=>'Icon','value'=>'bi-bag-dash','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>15,'page'=>'faq','parent_id'=>13,'type'=>'text','label'=>'Question','value'=>'How do I request a refund or exchange?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>16,'page'=>'faq','parent_id'=>15,'type'=>'text','label'=>'Answer','value'=>'To request a refund or exchange, please follow these steps: 1) Contact our customer support team within 30 days of the purchase. 2) Provide your order number and a detailed reason for the request. 3) Wait for our customer support team to assess your request and provide further instructions.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>17,'page'=>'faq','parent_id'=>13,'type'=>'text','label'=>'Question','value'=>'What items are eligible for a refund or exchange?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>18,'page'=>'faq','parent_id'=>17,'type'=>'text','label'=>'Answer','value'=>'Eligible items for a refund or exchange must meet the following criteria: • They are in their original condition, unused, and in their original packaging. • The request is made within the specified timeframe.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>19,'page'=>'faq','parent_id'=>13,'type'=>'text','label'=>'Question','value'=>'What if I receive a damaged or defective item?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>20,'page'=>'faq','parent_id'=>19,'type'=>'text','label'=>'Answer','value'=>'If you receive a damaged or defective item, please contact our customer support team immediately. We will guide you on the return process and offer a refund or replacement, as appropriate.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>21,'page'=>'faq','parent_id'=>13,'type'=>'text','label'=>'Question','value'=>'Who covers the shipping costs for exchanges?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>22,'page'=>'faq','parent_id'=>21,'type'=>'text','label'=>'Answer','value'=>'Shipping costs for returning the item for an exchange and sending the new item are usually the responsibility of the customer, unless the exchange is due to an error on our part.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],

            ['id'=>23,'page'=>'faq','parent_id'=>13,'type'=>'text','label'=>'Question','value'=>'Can I change my mind and cancel my refund or exchange request?','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
            ['id'=>24,'page'=>'faq','parent_id'=>23,'type'=>'text','label'=>'Answer','value'=>'If you change your mind about a refund or exchange request, please contact our customer support team as soon as possible. We will do our best to accommodate your request, but once a refund or exchange is processed, it may not be reversible.','previous_value'=>null,'created'=>date('Y-m-d H:i:s'),'updated'=>date('Y-m-d H:i:s')],
        ])->save();
    }
}
