<?php
/**
 * Created by PhpStorm.
 * User: Your Inspiration
 * Date: 12/05/2015
 * Time: 17:07
 */
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 1,
    'orderby'   => 'rand'
);


switch( $product_from ){
    case 'product':
        if( !empty( $products) ){
            $args['post__in'] = $products;
        }
        break;
    case 'category':
        if( !empty($category) ){
            $args['tax_query']  = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category,
                    'operator' => 'IN',
                ),
            );
        }
        break;
    case 'onsale':
        $args['post__in'] = wc_get_product_ids_on_sale();
        break;
    case 'featured':
        $args['post__in'] = wc_get_featured_product_ids();
        break;

    default:
}

$products = get_posts( $args );
if( empty( $products) ) return;

$product_id = 0;
foreach( $products as $product ){
    $product_id = $product->ID;
}

$product = wc_get_product( $product_id );


$product_type = $product->product_type;
if( $product_type == "simple" ){
    $yit_addtocart_url = add_query_arg('add-to-cart', $product->id, home_url());
}
elseif( $product_type == 'variation' ){
    $yit_addtocart_url = add_query_arg('add-to-cart', $product->id, home_url());
    $yit_addtocart_url = add_query_arg('variation_id', $product->id, $yit_addtocart_url);
    $yit_addtocart_url = add_query_arg('product_id', $product->id, $yit_addtocart_url);
    $yit_addtocart_url = add_query_arg('quantity', 1, $yit_addtocart_url);

    if( !empty( $product->variation_data ) ) {
        foreach( $product->variation_data as $attribute => $value ) {
            $yit_addtocart_url = add_query_arg($attribute, $value, $yit_addtocart_url);
        }
    }
}

?>

<div class="ypop-product-wrapper woocommerce">
    <?php if( $show_title == 'yes'): ?>
        <h4><?php echo  $product->get_title() ?></h4>
    <?php  endif  ?>
    <?php if( $show_thumbnail == 'yes'): ?>
        <div class="ypop-woo-thumb">
            <figure id="yit-popup-image"><img src="<?php echo wp_get_attachment_url( $product->get_image_id() ) ?>" alt="<?php echo $product->get_title();?>" /></figure>
        </div>
    <?php  endif  ?>
    <div class="product-info">
    <?php if( $show_price == 'yes'): ?>
        <div class="price"><?php echo $product->get_price_html() ?></div>
    <?php  endif  ?>
    <?php if( $show_add_to_cart == 'yes'): ?>
        <div class="add_to_cart"><a class="btn btn-flat" href="<?php echo esc_url( $yit_addtocart_url ) ?>"><?php echo $add_to_cart_label?></a></div>
    <?php  endif  ?>

    <?php if( $show_summary == 'yes'): ?>
        <div class="summary"><?php echo $product->post->post_excerpt ?></div>
    <?php  endif  ?>
    </div>
</div>