<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'              => 'Organic & Herbal Powder',
                'slug'              => 'organic-herbal-powder',
                'short_description' => 'Premium quality organic and herbal powders for food, nutraceutical and cosmetic applications.',
                'description'       => '<p>Our organic and herbal powder range includes carefully processed botanical ingredients sourced from certified farms. Ideal for bulk B2B supply with consistent quality and export documentation.</p>',
                'image'             => null,
                'meta_title'        => 'Organic & Herbal Powder - Bulk Supplier',
                'meta_description'  => 'Export quality organic and herbal powders for global B2B buyers.',
                'meta_keywords'     => 'organic powder, herbal powder, bulk supplier',
                'sort_order'        => 1,
                'status'            => 'active',
            ],
            [
                'name'              => 'Essential Oils',
                'slug'              => 'essential-oils',
                'short_description' => 'Pure steam-distilled essential oils for aromatherapy, cosmetics and wellness industries.',
                'description'       => '<p>We manufacture and export a wide range of essential oils using advanced distillation processes to preserve natural properties and aroma profiles.</p>',
                'image'             => null,
                'meta_title'        => 'Essential Oils - Manufacturer & Exporter',
                'meta_description'  => 'Bulk essential oils with export quality standards.',
                'meta_keywords'     => 'essential oils, aromatherapy, bulk oils',
                'sort_order'        => 2,
                'status'            => 'active',
            ],
            [
                'name'              => 'Cold Pressed Oils',
                'slug'              => 'cold-pressed-oils',
                'short_description' => 'Nutrient-rich cold pressed carrier oils for food, skincare and pharmaceutical use.',
                'description'       => '<p>Our cold pressed oils retain natural vitamins and antioxidants, making them ideal for premium product formulations and bulk industrial applications.</p>',
                'image'             => null,
                'meta_title'        => 'Cold Pressed Oils - Bulk Exporter',
                'meta_description'  => 'High quality cold pressed oils for global distribution.',
                'meta_keywords'     => 'cold pressed oil, carrier oil, bulk export',
                'sort_order'        => 3,
                'status'            => 'active',
            ],
            [
                'name'              => 'Tea Bag Ingredients',
                'slug'              => 'tea-bag-ingredients',
                'short_description' => 'Specialty tea ingredients and blends for tea bag manufacturers and private label brands.',
                'description'       => '<p>Supplying premium tea ingredients including herbs, flowers and functional blends tailored for tea bag production and wellness beverage brands.</p>',
                'image'             => null,
                'meta_title'        => 'Tea Bag Ingredients - B2B Supplier',
                'meta_description'  => 'Bulk tea ingredients for manufacturers and blenders.',
                'meta_keywords'     => 'tea ingredients, herbal tea, bulk tea',
                'sort_order'        => 4,
                'status'            => 'active',
            ],
        ];

        $categoryIds = [];

        foreach ($categories as $category) {
            $category['created_at'] = date('Y-m-d H:i:s');
            $category['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('product_categories')->insert($category);
            $categoryIds[$category['slug']] = $this->db->insertID();
        }

        $productsByCategory = [
            'organic-herbal-powder' => [
                ['Organic Turmeric Powder', 'organic-turmeric-powder', 'Bright golden turmeric powder with high curcumin content.', '100 Kg', 'Kg'],
                ['Organic Ashwagandha Powder', 'organic-ashwagandha-powder', 'Premium adaptogenic herb powder for wellness formulations.', '50 Kg', 'Kg'],
                ['Organic Moringa Leaf Powder', 'organic-moringa-leaf-powder', 'Nutrient-dense green superfood powder for supplements.', '100 Kg', 'Kg'],
                ['Organic Amla Powder', 'organic-amla-powder', 'Vitamin C rich amla powder for food and cosmetic use.', '100 Kg', 'Kg'],
            ],
            'essential-oils' => [
                ['Lemongrass Essential Oil', 'lemongrass-essential-oil', 'Fresh citrus aroma oil for aromatherapy and cleaning products.', '25 Kg', 'Kg'],
                ['Eucalyptus Essential Oil', 'eucalyptus-essential-oil', 'Clear, camphoraceous oil widely used in wellness products.', '25 Kg', 'Kg'],
                ['Peppermint Essential Oil', 'peppermint-essential-oil', 'Cooling menthol-rich oil for personal care applications.', '10 Kg', 'Kg'],
                ['Tea Tree Essential Oil', 'tea-tree-essential-oil', 'Antiseptic grade oil for cosmetic and hygiene formulations.', '25 Kg', 'Kg'],
            ],
            'cold-pressed-oils' => [
                ['Cold Pressed Coconut Oil', 'cold-pressed-coconut-oil', 'Virgin coconut oil with natural aroma and medium chain triglycerides.', '200 L', 'Litre'],
                ['Cold Pressed Almond Oil', 'cold-pressed-almond-oil', 'Light, nourishing oil ideal for skincare and massage products.', '100 L', 'Litre'],
                ['Cold Pressed Sesame Oil', 'cold-pressed-sesame-oil', 'Traditional edible and cosmetic grade sesame oil.', '200 L', 'Litre'],
                ['Cold Pressed Castor Oil', 'cold-pressed-castor-oil', 'Thick carrier oil used in hair care and industrial applications.', '200 L', 'Litre'],
            ],
            'tea-bag-ingredients' => [
                ['Chamomile Flower Cut', 'chamomile-flower-cut', 'Premium chamomile flowers for calming herbal tea blends.', '500 Kg', 'Kg'],
                ['Peppermint Leaf Cut', 'peppermint-leaf-cut', 'Refreshing peppermint leaves for tea and functional beverages.', '500 Kg', 'Kg'],
                ['Hibiscus Flower Cut', 'hibiscus-flower-cut', 'Vibrant hibiscus petals for tart, antioxidant-rich infusions.', '500 Kg', 'Kg'],
                ['Green Tea Fanning', 'green-tea-fanning', 'High quality green tea fanning for bulk tea bag production.', '1000 Kg', 'Kg'],
            ],
        ];

        $specTemplates = [
            ['Form', 'Fine Powder'],
            ['Color', 'Natural'],
            ['Purity', '100% Natural'],
            ['Shelf Life', '12-24 Months'],
            ['Packaging Type', 'HDPE Drum / PP Bag'],
            ['Processing Method', 'Hygienic Processing'],
            ['Product Type', 'B2B Bulk'],
        ];

        foreach ($productsByCategory as $slug => $products) {
            $categoryId = $categoryIds[$slug];
            $featured   = 0;

            foreach ($products as $index => $productData) {
                $featured = $index < 2 ? 1 : 0;

                $product = [
                    'category_id'              => $categoryId,
                    'name'                     => $productData[0],
                    'slug'                     => $productData[1],
                    'short_description'        => $productData[2],
                    'description'              => '<p>' . $productData[2] . ' Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>',
                    'main_image'               => null,
                    'moq'                      => $productData[3],
                    'moq_unit'                 => $productData[4],
                    'applications'             => 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations',
                    'benefits'                 => 'Export quality, consistent batch quality, bulk supply capability, custom packaging available',
                    'packaging_information'    => 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.',
                    'availability_information' => 'Ready stock available. Lead time 7-15 days for large export orders.',
                    'meta_title'               => $productData[0] . ' - Bulk Supplier',
                    'meta_description'         => $productData[2],
                    'meta_keywords'            => strtolower($productData[0]) . ', bulk, B2B, exporter',
                    'is_featured'              => $featured,
                    'status'                   => 'active',
                    'created_at'               => date('Y-m-d H:i:s'),
                    'updated_at'               => date('Y-m-d H:i:s'),
                ];

                $this->db->table('products')->insert($product);
                $productId = $this->db->insertID();

                foreach ($specTemplates as $sort => $spec) {
                    $this->db->table('product_specifications')->insert([
                        'product_id'          => $productId,
                        'specification_name'  => $spec[0],
                        'specification_value' => $spec[1],
                        'sort_order'          => $sort,
                        'created_at'          => date('Y-m-d H:i:s'),
                        'updated_at'          => date('Y-m-d H:i:s'),
                    ]);
                }

                $this->db->table('product_specifications')->insert([
                    'product_id'          => $productId,
                    'specification_name'  => 'MOQ',
                    'specification_value' => $productData[3],
                    'sort_order'          => count($specTemplates),
                    'created_at'          => date('Y-m-d H:i:s'),
                    'updated_at'          => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
