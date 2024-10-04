<?php

require_once dirname(__FILE__) . '/Site/Processor/SiteProductItem.php';
require_once dirname(__FILE__) . '/Site/Processor/SiteProductListProcessor.php';
require_once dirname(__FILE__) . '/Site/Processor/SiteProductDetailsProcessor.php';
require_once dirname(__FILE__) . '/Woocommerce/Processor/WooProductItem.php';
require_once dirname(__FILE__) . '/Woocommerce/Processor/WooProductListProcessor.php';
require_once dirname(__FILE__) . '/Woocommerce/Processor/WooProductDetailsProcessor.php';

abstract class ProductItem {

    protected $_options;
    public $products = array();
    public $productVariationId = 0;
    public $tabItemIndex = 0;
    public $tabContentIndex = 0;
    public $productData;

    /**
     * @param array $options Global parameters
     */
    protected function __construct( $options ) {
        // Initialization:
        $this->_options = $options;
    }

    /**
     * Replace placeholder for product gallery
     *
     * @param string $content
     *
     * @return string $content
     */
    protected function _replaceGallery($content) {
        return preg_replace_callback(
            '/<!--product_gallery-->([\s\S]+?)<!--\/product_gallery-->/',
            function ($galleryMatch) {
                $galleryHtml = $galleryMatch[1];
                $galleryData = array();
                $attachment_ids = isset($this->productData['gallery_images_ids']) ? $this->productData['gallery_images_ids'] : array();
                foreach ($attachment_ids as $attachment_id) {
                    array_push($galleryData, wp_get_attachment_url($attachment_id));
                }
                if ($this->_options['siteProductsProcess']) {
                    $galleryData = isset($this->productData['gallery_images']) ? $this->productData['gallery_images'] : array();
                }

                if (count($galleryData) < 1) {
                    return '';
                }

                $controlOptions = array();
                if (preg_match('/<\!--options_json--><\!--([\s\S]+?)--><\!--\/options_json-->/', $galleryHtml, $matches)) {
                    $controlOptions = json_decode($matches[1], true);
                    $galleryHtml = str_replace($matches[0], '', $galleryHtml);
                }

                $maxItems = -1;
                if (isset($controlOptions['maxItems']) && $controlOptions['maxItems']) {
                    $maxItems = (int) $controlOptions['maxItems'];
                }

                if ($maxItems !== -1 && count($galleryData) > $maxItems) {
                    $galleryData = array_slice($galleryData, 0, $maxItems);
                }

                $galleryItemRe = '/<\!--product_gallery_item-->([\s\S]+?)<\!--\/product_gallery_item-->/';
                preg_match($galleryItemRe, $galleryHtml, $galleryItemMatch);
                $galleryItemHtml = str_replace('u-active', '', $galleryItemMatch[1]);

                $galleryThumbnailRe = '/<\!--product_gallery_thumbnail-->([\s\S]+?)<\!--\/product_gallery_thumbnail-->/';
                $galleryThumbnailHtml = '';
                if (preg_match($galleryThumbnailRe, $galleryHtml, $galleryThumbnailMatch)) {
                    $galleryThumbnailHtml = $galleryThumbnailMatch[1];
                }

                $newGalleryItemListHtml = '';
                $newThumbnailListHtml = '';
                foreach ($galleryData as $key => $img) {
                    $newGalleryItemHtml = $key == 0 ? str_replace('u-gallery-item', 'u-gallery-item u-active', $galleryItemHtml) : $galleryItemHtml;
                    $newGalleryItemListHtml .= preg_replace('/(src=[\'"])([\s\S]+?)([\'"])/', '$1' . $img . '$3', $newGalleryItemHtml);
                    if ($galleryThumbnailHtml) {
                        $newThumbnailHtml = preg_replace('/data-u-slide-to=([\'"])([\s\S]+?)([\'"])/', 'data-u-slide-to="' . $key . '"', $galleryThumbnailHtml);
                        $newThumbnailListHtml .= preg_replace('/(src=[\'"])([\s\S]+?)([\'"])/', '$1' . $img . '$3', $newThumbnailHtml);
                    }
                }

                $galleryParts = preg_split($galleryItemRe, $galleryHtml, -1, PREG_SPLIT_NO_EMPTY);
                $newGalleryHtml = $galleryParts[0] . $newGalleryItemListHtml . $galleryParts[1];

                $newGalleryParts = preg_split($galleryThumbnailRe, $newGalleryHtml, -1, PREG_SPLIT_NO_EMPTY);
                return $newGalleryParts[0] . $newThumbnailListHtml . $newGalleryParts[1];
            },
            $content
        );
    }

    /**
     * Replace placeholder for product variations
     *
     * @param string $content
     *
     * @return string $content
     */
    protected function _replaceVariations($content) {
        return preg_replace_callback(
            '/<!--product_variations-->([\s\S]+?)<!--\/product_variations-->/',
            function ($product_variations) {
                if ($this->_options['siteProductsProcess']) {
                    return '';
                }
                $productVariationsHtml = $product_variations[1];
                $productVariationsHtml = str_replace('u-product-variations ', 'u-product-variations variations ', $productVariationsHtml);
                preg_match('/<!--product_variation-->([\s\S]+?)<!--\/product_variation-->/', $productVariationsHtml, $productVariations);
                $firstVariationHtml = $productVariations[0];
                $productVariationsHtml = preg_replace('/<!--product_variation-->([\s\S]+)<!--\/product_variation-->/', $firstVariationHtml, $productVariationsHtml);
                $newVariationHtml = '';
                $productAttributes = $this->productData['attributes'];
                $product_type = $this->productData['type'];
                if ($product_type == 'variable') {
                    $variation_attributes = $this->productData['variations_attributes'];
                    if (count($variation_attributes) > 0) {
                        foreach ($variation_attributes as $name => $variation_attribute) {
                            $doubleVariationHtml = $firstVariationHtml;
                            $optionsHtml = '<option value="">' . __('Choose an option', 'woocommerce') . '</option>';
                            $productAttribute = $productAttributes[strtolower($name)] ? $productAttributes[strtolower($name)] : $productAttributes[wc_attribute_taxonomy_slug($name)];
                            $variation_title = $productAttribute['name'];
                            $variation_options = $productAttribute['options'];
                            $select_id = strtolower($variation_title);
                            if (isset($productAttribute['id']) && $productAttribute['id'] > 0) {
                                $attribute = NpDataProduct::getProductAttribute($productAttribute['id']);
                                $variation_options = $productAttribute->get_terms();
                                $variation_title = NpDataProduct::getProductVariationTitle($attribute, $productAttribute);
                            }
                            $doubleVariationHtml = $this->_replaceVariationLabel($doubleVariationHtml, $variation_title);
                            $doubleVariationHtml = preg_replace('/for=[\'"][\s\S]+?[\'"]/', 'for="' . $select_id . '"', $doubleVariationHtml);
                            $doubleVariationHtml = preg_replace('/(select[\s\S]+?id=[\'"])([\s\S]+?)([\'"])/', '$1' . $select_id . '$3' . ' name="attribute_' . $select_id . '" data-attribute_name="attribute_' . $select_id . '" data-show_option_none="yes"', $doubleVariationHtml);
                            preg_match('/<option([\s\S]*?)<\/option>/', $doubleVariationHtml, $productOptions);
                            $firstOptionHtml = $productOptions[0];
                            if (is_array($variation_options)) {
                                foreach ($variation_options as $variation_option) {
                                    $optionsHtml = $this->_constructVariationOptions($firstOptionHtml, $variation_option, $optionsHtml);
                                }
                            }
                            $doubleVariationHtml = $this->_replaceVariationOptionHtml($doubleVariationHtml, $optionsHtml);
                            $newVariationHtml .= $this->_replaceVariationSelectContent($doubleVariationHtml, $optionsHtml);
                            $this->productVariationId++;
                        }
                    }
                    $productVariationsHtml = $this->_replaceDefaultVariationsHtml($productVariationsHtml, $newVariationHtml);
                    global $product;
                    $product = $this->productData['product'];
                    $productVariationsHtml = str_replace('u-form-select-wrapper', 'u-form-select-wrapper value', $productVariationsHtml);
                    if ($product->is_in_stock() && $product->is_purchasable()) {
                        return $form = $this->_constructFormWithVariations($productVariationsHtml);
                    } else {
                        return $productVariationsHtml = '';
                    }
                } else {
                    $productVariationsHtml = '';
                }
                return $productVariationsHtml;
            },
            $content
        );
    }

    /**
     * Replace label product variation
     *
     * @param string $content
     * @param string $variation_title
     *
     * @return string $content
     */
    private function _replaceVariationLabel($content, $variation_title) {
        return preg_replace('/<!--product_variation_label_content-->([\s\S]*?)<!--\/product_variation_label_content-->/', $variation_title, $content);
    }

    /**
     * Construct variation options
     *
     * @param string $firstOptionHtml
     * @param string $variation_option
     * @param string $optionsHtml
     *
     * @return string $optionsHtml
     */
    private function _constructVariationOptions($firstOptionHtml, $variation_option, $optionsHtml) {
        $variation_option_title = NpDataProduct::getProductVariationOptionTitle($variation_option);
        $doubleOptionHtml = $firstOptionHtml;
        $doubleOptionHtml = preg_replace('/value=[\'"][\s\S]+?[\'"]/', 'value="' . $variation_option_title . '"', $doubleOptionHtml);
        $doubleOptionHtml = $this->_replaceVariationOptionContent($doubleOptionHtml, $variation_option_title);
        $optionsHtml .= $doubleOptionHtml;
        return $optionsHtml;
    }

    /**
     * Replace default option content for select product variation
     *
     * @param string $content
     * @param string $optionTitle
     *
     * @return string $content
     */
    private function _replaceVariationOptionContent($content, $optionTitle) {
        return preg_replace('/(<option[\s\S]*?>)[\s\S]+(<\/option>)/', '$1' . $optionTitle . '$2', $content);
    }

    /**
     * Replace default option html for select product variation
     *
     * @param string $content
     * @param string $option
     *
     * @return string $content
     */
    private function _replaceVariationOptionHtml($content, $option) {
        return preg_replace('/<option([\s\S]+)<\/option>/', $option, $content);
    }

    /**
     * Replace default options for select product variation
     *
     * @param string $content
     * @param string $option
     *
     * @return string $content
     */
    private function _replaceVariationSelectContent($content, $option) {
        return preg_replace('/<!--product_variation_select_content-->([\s\S]*?)<!--\/product_variation_select_content-->/', $option, $content);
    }

    /**
     * Replace default variations html
     *
     * @param string $content
     * @param string $variations html
     *
     * @return string $content
     */
    private function _replaceDefaultVariationsHtml($content, $variations) {
        return preg_replace('/<!--product_variation-->([\s\S]*?)<!--\/product_variation-->/', $variations, $content);
    }

    /**
     * Replace placeholder for variations html
     *
     * @param string $content html variations
     *
     * @return string $content form variations
     */
    private function _constructFormWithVariations($content) {
        ob_start();
        woocommerce_template_single_add_to_cart();
        $form = ob_get_clean();
        $add_to_cart = '<div class="single_variation_wrap-np" style="display: none">
			<div class="woocommerce-variation single_variation" style="display: none;"></div>
			<div class="woocommerce-variation-add-to-cart variations_button woocommerce-variation-add-to-cart-enabled">
	
		<div class="quantity">
		<input type="number" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" size="4" placeholder="" inputmode="numeric">
			</div>
			<button type="submit" class="np-submit single_add_to_cart_button button alt disabled wc-variation-selection-needed">Add to cart</button>
	<input type="hidden" name="add-to-cart" value="'. $this->productData['product']->id .'">
	<input type="hidden" name="product_id" value="' . $this->productData['product']->id .'">
	<input type="hidden" name="variation_id" class="variation_id" value="0">
</div>
		</div>';
        return preg_replace('/(<form[\s\S]*?>)([\s\S]+?)(<\/form>)/', '$1' . $content . $add_to_cart . '$3', $form);
    }

    /**
     * Replace placeholder for product tabs
     *
     * @param string $content
     *
     * @return string $content
     */
    protected function _replaceTabs($content) {
        return preg_replace_callback(
            '/<!--product_tabs-->([\s\S]+?)<!--\/product_tabs-->/',
            function ($product_tabs) {
                if ($this->_options['siteProductsProcess']) {
                    return '';
                }
                $productTabsHtml = $product_tabs[1];
                $productTabsHtml = $this->_replaceTabItem($productTabsHtml);
                $productTabsHtml = $this->_replaceTabPane($productTabsHtml);
                return $productTabsHtml;
            },
            $content
        );
    }

    /**
     * Replace placeholder for product tab item
     *
     * @param string $content
     *
     * @return string $content
     */
    private function _replaceTabItem($content) {
        return preg_replace_callback(
            '/<!--product_tabitem-->([\s\S]+?)<!--\/product_tabitem-->/',
            function ($productTabsHtml) {
                $productTabsHtml = $productTabsHtml[1];
                if (isset($this->productData['tabs'][$this->tabItemIndex])) {
                    $productTabsHtml = $this->_replaceTabItemTitle($productTabsHtml);
                } else {
                    return '';
                }
                $this->tabItemIndex++;
                return $productTabsHtml;
            },
            $content
        );
    }

    /**
     * Replace placeholder for product tab item title
     *
     * @param string $content
     *
     * @return string $content
     */
    private function _replaceTabItemTitle($content) {
        $title = sprintf(__('%s', 'woocommerce'), $this->productData['tabs'][$this->tabItemIndex]['title']);
        return preg_replace('/<!--product_tabitem_title-->([\s\S]*)<!--\/product_tabitem_title-->/', $title, $content);
    }

    /**
     * Replace placeholder for product tab panel
     *
     * @param string $content
     *
     * @return string $content
     */
    private function _replaceTabPane($content) {
        return preg_replace_callback(
            '/<!--product_tabpane-->([\s\S]+?)<!--\/product_tabpane-->/',
            function ($productTabsHtml) {
                $productTabsHtml = $productTabsHtml[1];
                if (isset($this->productData['tabs'][$this->tabContentIndex])) {
                    $productTabsHtml = $this->_replaceTabPaneContent($productTabsHtml);
                } else {
                    return '';
                }
                $this->tabContentIndex++;
                return $productTabsHtml;
            },
            $content
        );
    }

    /**
     * Replace placeholder for product tab panel content
     *
     * @param string $content
     *
     * @return string $content
     */
    private function _replaceTabPaneContent($content) {
        return preg_replace('/<!--product_tabpane_content-->([\s\S]*)<!--\/product_tabpane_content-->/', $this->productData['tabs'][$this->tabContentIndex]['content'], $content);
    }

    /**
     * Replace placeholder for quantity
     *
     * @param string $content
     *
     * @return string $content
     */
    protected function _replaceQuantity($content) {
        return preg_replace_callback(
            '/<!--product_quantity-->([\s\S]+?)<!--\/product_quantity-->/',
            function ($quantityHtml) {
                if ($this->_options['siteProductsProcess']) {
                    return '';
                }
                $quantityHtml = $quantityHtml[1];
                $quantityHtml = $this->_replaceQuantityLabel($quantityHtml);
                $quantityHtml = $this->_replaceQuantityInput($quantityHtml);
                return $quantityHtml;
            },
            $content
        );
    }

    /**
     * Replace placeholder for quantity label
     *
     * @param string $content
     *
     * @return string $content
     */
    private function _replaceQuantityLabel($content) {
        return preg_replace('/<!--product_quantity_label_content-->([\s\S]*?)<!--\/product_quantity_label_content-->/', esc_html__('Quantity', 'woocommerce'), $content);
    }

    /**
     * Replace placeholder for quantity input
     *
     * @param string $content
     *
     * @return string $content
     */
    private function _replaceQuantityInput($content) {
        return preg_replace_callback(
            '/<\!--product_quantity_input-->([\s\S]+?)<\!--\/product_quantity_input-->/',
            function ($quantityHtml) {
                $product = $this->productData['product'];
                $quantityHtml = $quantityHtml[1];
                preg_match('/<input[\s\S]+?class=[\'"]([\s\S]+?)[\'"]/', $quantityHtml, $quantityClasses);
                $max = $product->get_max_purchase_quantity();
                $quantityHtml = '<input 
	    class="' . $quantityClasses[1] . '" 
	    type="text" 
	    value="1" 
	    step="' . esc_attr(apply_filters('woocommerce_quantity_input_step', '1', $product)) . '" 
	    min="' . esc_attr($product->get_min_purchase_quantity()) . '" 
	    max="' . esc_attr(0 < $max ? $max : '') . '"
	    title="' . esc_attr_x('Qty', 'Product quantity input tooltip', 'woocommerce') . '" 
	    size="4" 
	    pattern="[0-9]+">';
                return $quantityHtml;
            },
            $content
        );
    }

    /**
     * Replace placeholder for category
     *
     * @param string $content
     *
     * @return string $content
     */
    protected function _replaceCategory($content) {
        return preg_replace_callback(
            '/<!--product_category-->([\s\S]+?)<!--\/product_category-->/',
            function ($product_category) {
                $productCategoryHtml = $product_category[1];
                preg_match('/<a.+?>(.+?)<\/a>/', $productCategoryHtml, $productCategoriesLinks);
                $firstCategoryLinkHtml = isset($productCategoriesLinks[0]) ? $productCategoriesLinks[0] : '';
                $productCategoryHtml = preg_replace('/(<div\b[^>]*>).*?(<\/div>)/s', '$1{ProductCategoriesLinks}$2', $productCategoryHtml);
                $categoriesHtml = '';
                if (isset($this->productData['categories']) && $this->productData['categories']) {
                    foreach ($this->productData['categories'] as $index => $category) {
                        $doubleCategoryLinkHtml = $firstCategoryLinkHtml;
                        $category_title = isset($category['title']) ? $category['title'] : 'Uncategorized';
                        $category_link = isset($category['link']) ? $category['link'] : '#';
                        $doubleCategoryLinkHtml = preg_replace('/href=[\'"][\s\S]+?[\'"]/', 'href="' . $category_link . '"', $doubleCategoryLinkHtml);
                        $doubleCategoryLinkHtml = preg_replace('/(<a\b[^>]*>).*?(<\/a>)/s', '$1' . $category_title . '$2', $doubleCategoryLinkHtml);
                        if ($index > 0) {
                            $categoriesHtml .= ', ';
                        }
                        $categoriesHtml .= $doubleCategoryLinkHtml;
                    }
                }
                return str_replace('{ProductCategoriesLinks}', $categoriesHtml, $productCategoryHtml);
            },
            $content
        );
    }

    /**
     * Set product badge
     *
     * @param string $content
     *
     * @return string $content
     */
    protected function _setProductBadge($content) {
        return preg_replace_callback(
            '/<!--product_badge-->([\s\S]+?)<!--\/product_badge-->/',
            function ($badgeMatch) {
                $badgeHtml = $badgeMatch[1];
                if (preg_match('/data-badge-source="sale"/', $badgeHtml)) {
                    if ($this->productData['product-sale']) {
                        return preg_replace('/([\s\S]+?>).*?(<\/[\s\S]+?>)/s', '$1' . $this->productData['product-sale'] . '$2', $badgeHtml);
                    }
                } else {
                    if ($this->productData['product-is-new']) {
                        return $badgeHtml;
                    }
                }
                return str_replace('class="', 'class="u-hidden-block ', $badgeHtml);
            },
            $content
        );
    }

    /**
     * Set product out of stock
     *
     * @param string $content
     *
     * @return string $content
     */
    protected function _replaceOutOfStock($content) {
        return preg_replace_callback(
            '/<!--product_outofstock-->([\s\S]+?)<!--\/product_outofstock-->/',
            function ($outOfStockMatch) {
                $outOfStockHtml = $outOfStockMatch[1];
                if ($this->productData['product-out-of-stock']) {
                    return str_replace('u-hidden-block', '', $outOfStockHtml);
                }
                if (strpos($outOfStockHtml, 'u-hidden-block') === false) {
                    $outOfStockHtml = str_replace('class="', 'class="u-hidden-block ', $outOfStockHtml);
                }
                return $outOfStockHtml;
            },
            $content
        );
    }

    /**
     * Set product sku
     *
     * @param string $content
     *
     * @return string $content
     */
    protected function _replaceSku($content) {
        return preg_replace_callback(
            '/<!--product_sku-->([\s\S]+?)<!--\/product_sku-->/',
            function ($skuMatch) {
                $skuHtml = $skuMatch[1];
                if ($this->productData['product-sku']) {
                    if (strpos($skuHtml, 'product_sku_content') !== false) {
                        $skuHtml = preg_replace('/<\!--product_sku_content-->([\s\S]+?)<\!--\/product_sku_content-->/', $this->productData['product-sku'], $skuHtml);
                    } else {
                        $skuHtml = preg_replace('/([\s\S]+?>).*?(<\/[\s\S]+?>)/s', '$1{sku}$2', $skuHtml);
                        $skuHtml = str_replace('{sku}', $this->productData['product-sku'], $skuHtml);
                    }
                    return str_replace('u-hidden-block', '', $skuHtml);
                }
                if (strpos($skuHtml, 'u-hidden-block') === false) {
                    $skuHtml = str_replace('class="', 'class="u-hidden-block ', $skuHtml);
                }
                return $skuHtml;
            },
            $content
        );
    }

    /**
     * Build Grid Auto Rows
     *
     * @param $products
     * @param $productsOptions
     * @param $productsHtml
     *
     * @return string
     */
    protected function _buildGridAutoRows($products, $productsOptions, $productsHtml) {
        $productsGridProps = isset($productsOptions['gridProps']) ? $productsOptions['gridProps'] : array();
        if ($products) {
            $productsHtml .= GridHelper::buildGridAutoRowsStyles($productsGridProps, count($products));
        }
        return $productsHtml;
    }

    /**
     * Process categories filter for products controls
     *
     * @param string $content
     *
     * @return string $content
     */
    public function processCategoriesFilter($content) {
        $content = preg_replace_callback(
            '/<\!--products_categories_filter_select-->([\s\S]+?)<\!--\/products_categories_filter_select-->/',
            function ($selectMatch) {
                $selectHtml = $selectMatch[1];
                preg_match('/<option[\s\S]*?>[\s\S]+?<\/option>/', $selectHtml, $selectOptions);
                $firstOptionHtml = $selectOptions[0];
                $selectHtml = preg_replace('/<option[\s\S]*?>[\s\S]*<\/option>/', '{categoriesFilterOptions}', $selectHtml);
                if ($this->_options['siteProductsProcess']) {
                    $categories = isset($this->_options['productsJson']['categories']) ? $this->_options['productsJson']['categories'] : array();
                } else {
                    $categories = class_exists('Woocommerce') ? get_terms('product_cat', array('hide_empty' => false)) : array();
                }
                $selectOptionsHtml = '';
                // add item all
                $activeFilter = isset($_GET['categoryId']) ? $_GET['categoryId'] : false;
                $OptionAllProducts = preg_replace('/value=[\'"][\s\S]*?[\'"]/', 'value=""', $firstOptionHtml);
                $OptionAllProducts = preg_replace('/(<option[\s\S]*?>)[\s\S]+?<\/option>/', '$1' . __('All', 'nicepage') . '</option>', $OptionAllProducts);
                $selectOptionsHtml .= $OptionAllProducts;
                // add item featured
                $OptionFeaturedProducts = preg_replace('/value=[\'"][\s\S]*?[\'"]/', 'value="featured"', $firstOptionHtml);
                $OptionFeaturedProducts = preg_replace('/(<option[\s\S]*?>)[\s\S]+?<\/option>/', '$1' . __('Featured', 'nicepage') . '</option>', $OptionFeaturedProducts);
                if (!$this->_options['siteProductsProcess'] && $activeFilter && 'featured' === $activeFilter) {
                    $OptionFeaturedProducts = str_replace('<option', '<option selected="selected"', $OptionFeaturedProducts);
                }
                $selectOptionsHtml .= $OptionFeaturedProducts;
                // add all categories with hierarchy
                $selectOptionsHtml .= $this->_generate_category_options($categories, $firstOptionHtml);
                $selectHtml = str_replace('{categoriesFilterOptions}', $selectOptionsHtml, $selectHtml);
                return $selectHtml;
            },
            $content
        );
        return $content;
    }

    /**
     * Generate categories filter options with hierarchy
     *
     * @param array  $categories
     * @param string $itemTemplate
     * @param int    $parent
     * @param string $prefix
     *
     * @return string $result
     */
    private function _generate_category_options( $categories, $itemTemplate, $parent = 0, $prefix = '' ) {
        $result = '';
        $activeFilter = isset($_GET['categoryId']) ? $_GET['categoryId'] : false;
        foreach ($categories as $category) {
            $parentId = $this->_options['siteProductsProcess'] ? $category['categoryId'] : $category->parent;
            $catId = $this->_options['siteProductsProcess'] ? $category['id'] : $category->term_id;
            $catName = $this->_options['siteProductsProcess'] ? $category['title'] : $category->name;
            if ($parentId == $parent) {
                $doubleOptionHtml = $itemTemplate;
                $doubleOptionHtml = preg_replace('/value=[\'"][\s\S]*?[\'"]/', 'value="' . $catId . '"', $doubleOptionHtml);
                $doubleOptionHtml = preg_replace('/(<option[\s\S]*?>)[\s\S]+?<\/option>/', '$1' . $prefix . $catName . '</option>', $doubleOptionHtml);
                if (!$this->_options['siteProductsProcess'] && $activeFilter && (int)$catId === (int)$activeFilter) {
                    $doubleOptionHtml = str_replace('<option', '<option selected="selected"', $doubleOptionHtml);
                }
                $result .= $doubleOptionHtml;
                $result .= $this->_generate_category_options($categories, $itemTemplate, $catId, $prefix . '-');
            }
        }
        return $result;
    }
}