@extends('web.layouts2.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Default</li>
        </ol>
        <nav class="product-pager ml-auto" aria-label="Product">
            <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                <i class="icon-angle-left"></i>
                <span>Prev</span>
            </a>
            <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                <span>Next</span>
                <i class="icon-angle-right"></i>
            </a>
        </nav><!-- End .pager-nav -->
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="product-details-top">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery product-gallery-vertical">
                        <div class="row">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="{{ asset('public/assets/images/products/single/1.jpg') }}"
                                    data-zoom-image="{{ asset('public/assets/images/products/single/1-big.jpg') }}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                <a class="product-gallery-item active" href="#"
                                    data-image="{{ asset('public/assets/images/products/single/1.jpg') }}"
                                    data-zoom-image="{{ asset('public/assets/images/products/single/1-big.jpg') }}">
                                    <img src="{{ asset('public/assets/images/products/single/1-small.jpg') }}" alt="product side">
                                </a>

                                <a class="product-gallery-item" href="#"
                                    data-image="{{ asset('public/assets/images/products/single/2.jpg') }}"
                                    data-zoom-image="{{ asset('public/assets/images/products/single/2-big.jpg') }}">
                                    <img src="{{ asset('public/assets/images/products/single/2-small.jpg') }}" alt="product cross">
                                </a>

                                <a class="product-gallery-item" href="#"
                                    data-image="{{ asset('public/assets/images/products/single/3.jpg') }}"
                                    data-zoom-image="{{ asset('public/assets/images/products/single/3-big.jpg') }}">
                                    <img src="{{ asset('public/assets/images/products/single/3-small.jpg') }}" alt="product with model">
                                </a>

                                <a class="product-gallery-item" href="#"
                                    data-image="{{ asset('public/assets/images/products/single/4.jpg') }}"
                                    data-zoom-image="{{ asset('public/assets/images/products/single/4-big.jpg') }}">
                                    <img src="{{ asset('public/assets/images/products/single/4-small.jpg') }}" alt="product back">
                                </a>
                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .row -->
                    </div><!-- End .product-gallery -->
                </div><!-- End .col-md-6 -->

                @php
                    $attributeGroups = [];
                    if (!empty($product->variants)) {
                        foreach ($product->variants as $variant) {
                            foreach ($variant->attributeValues ?? [] as $attVal) {
                                $attributeGroups[$attVal->attribute->name][$attVal->id] = $attVal->value;
                            }
                        }
                    }
                @endphp

                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->name }}</h1>

                        <div class="product-price">
                            ₹{{ $product->variants->first()->price ?? '0.00' }}
                        </div>

                        @foreach ($attributeGroups as $attrName => $values)
                            <div class="details-filter-row details-row-size">
                                <label>{{ $attrName }}:</label>

                                @if ($attrName == 'Color')
                                    <div class="product-nav product-nav-thumbs">
                                        @foreach ($values as $id => $val)
                                            <a href="#" data-attr="{{ $attrName }}" data-val-id="{{ $id }}">
                                                <img src="{{ asset('public/assets/images/products/single/'.$id.'-thumb.jpg') }}" alt="{{ $val }}">
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="select-custom">
                                        <select name="{{ strtolower($attrName) }}" class="form-control">
                                            <option value="" selected>Select a {{ $attrName }}</option>
                                            @foreach ($values as $id => $val)
                                                <option value="{{ $id }}">{{ ucfirst($val) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="details-filter-row details-row-size">
                            <label for="qty">Qty:</label>
                            <div class="product-details-quantity">
                                <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" required>
                            </div>
                        </div>

                        <div class="product-details-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div>

                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                @foreach($product->categories as $category)
                                    <a href="#">{{ $category->name }}</a>{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- End .row -->
        </div><!-- End .product-details-top -->

        <div class="product-details-tab">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                        role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab"
                        aria-controls="product-info-tab" aria-selected="false">Additional
                        information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab"
                        role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab"
                        aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                    aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <h3>Product Information</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                            volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra
                            non,
                            semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis
                            fermentum.
                            Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
                            Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                            vulputate sem tristique cursus. </p>
                        <ul>
                            <li>Nunc nec porttitor turpis. In eu risus enim. In vitae mollis elit. </li>
                            <li>Vivamus finibus vel mauris ut vehicula.</li>
                            <li>Nullam a magna porttitor, dictum risus nec, faucibus sapien.</li>
                        </ul>

                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                            volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra
                            non,
                            semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis
                            fermentum.
                            Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
                            Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula
                            vulputate sem tristique cursus. </p>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <h3>Information</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                            volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra
                            non,
                            semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis
                            fermentum.
                            Aliquam porttitor mauris sit amet orci. </p>

                        <h3>Fabric & care</h3>
                        <ul>
                            <li>Faux suede fabric</li>
                            <li>Gold tone metal hoop handles.</li>
                            <li>RI branding</li>
                            <li>Snake print trim interior </li>
                            <li>Adjustable cross body strap</li>
                            <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                        </ul>

                        <h3>Size</h3>
                        <p>one size</p>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                    aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <h3>Delivery & returns</h3>
                        <p>We deliver to over 100 countries around the world. For full details of the
                            delivery
                            options we offer, please view our <a href="#">Delivery information</a><br>
                            We hope you'll love every purchase, but if you ever need to return an item you
                            can
                            do so within a month of receipt. For full details of how to make a return,
                            please
                            view our <a href="#">Returns information</a></p>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                    aria-labelledby="product-review-link">
                    <div class="reviews">
                        <h3>Reviews (2)</h3>
                        <div class="review">
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <h4><a href="#">Samanta J.</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div>
                                            <!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                    </div><!-- End .rating-container -->
                                    <span class="review-date">6 days ago</span>
                                </div><!-- End .col -->
                                <div class="col">
                                    <h4>Good, perfect size</h4>

                                    <div class="review-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus
                                            cum
                                            dolores assumenda asperiores facilis porro reprehenderit animi
                                            culpa
                                            atque blanditiis commodi perspiciatis doloremque, possimus,
                                            explicabo, autem fugit beatae quae voluptas!</p>
                                    </div><!-- End .review-content -->

                                    <div class="review-action">
                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                    </div><!-- End .review-action -->
                                </div><!-- End .col-auto -->
                            </div><!-- End .row -->
                        </div><!-- End .review -->

                        <div class="review">
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <h4><a href="#">John Doe</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 100%;"></div>
                                            <!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                    </div><!-- End .rating-container -->
                                    <span class="review-date">5 days ago</span>
                                </div><!-- End .col -->
                                <div class="col">
                                    <h4>Very good</h4>

                                    <div class="review-content">
                                        <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum
                                            blanditiis laudantium iste amet. Cum non voluptate eos enim, ab
                                            cumque nam, modi, quas iure illum repellendus, blanditiis
                                            perspiciatis beatae!</p>
                                    </div><!-- End .review-content -->

                                    <div class="review-action">
                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                    </div><!-- End .review-action -->
                                </div><!-- End .col-auto -->
                            </div><!-- End .row -->
                        </div><!-- End .review -->
                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-details-tab -->

        <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
            data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-new">New</span>
                    <a href="product.html">
                        <img src="{{ asset('public/assets/images/products/product-4.jpg') }}" alt="Product image"
                            class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                            title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Brown paperbag waist <br>pencil
                            skirt</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        $60.00
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div><!-- End .rating-container -->

                    <div class="product-nav product-nav-thumbs">
                        <a href="#" class="active">
                            <img src="{{ asset('public/assets/images/products/product-4-thumb.jpg') }}" alt="product desc">
                        </a>
                        <a href="#">
                            <img src="{{ asset('public/assets/images/products/product-4-2-thumb.jpg') }}" alt="product desc">
                        </a>
                        <a href="#">
                            <img src="{{ asset('public/assets/images/products/product-4-3-thumb.jpg') }}" alt="product desc">
                        </a>
                    </div><!-- End .product-nav -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-out">Out of Stock</span>
                    <a href="product.html">
                        <img src="{{ asset('public/assets/images/products/product-6.jpg') }}" alt="Product image"
                            class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                            title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Jackets</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Khaki utility boiler jumpsuit</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        <span class="out-price">$120.00</span>
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 6 Reviews )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-top">Top</span>
                    <a href="product.html">
                        <img src="{{ asset('public/assets/images/products/product-11.jpg') }}" alt="Product image"
                            class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                            title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Shoes</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Light brown studded Wide fit wedges</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        $110.00
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 1 Reviews )</span>
                    </div><!-- End .rating-container -->

                    <div class="product-nav product-nav-thumbs">
                        <a href="#" class="active">
                            <img src="{{ asset('public/assets/images/products/product-11-thumb.jpg') }}"
                                alt="product desc">
                        </a>
                        <a href="#">
                            <img src="{{ asset('public/assets/images/products/product-11-2-thumb.jpg') }}"
                                alt="product desc">
                        </a>

                        <a href="#">
                            <img src="{{ asset('public/assets/images/products/product-11-3-thumb.jpg') }}"
                                alt="product desc">
                        </a>
                    </div><!-- End .product-nav -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="{{ asset('public/assets/images/products/product-10.jpg') }}" alt="Product image"
                            class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                            title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Jumpers</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Yellow button front tea top</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        $56.00
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 0 Reviews )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="{{ asset('public/assets/images/products/product-7.jpg') }}" alt="Product image"
                            class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                            title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Jeans</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Blue utility pinafore denim dress</a>
                    </h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        $76.00
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->

            </div><!-- End .product -->
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
</div><!-- End .page-content -->

<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

@endsection
@section('javascript')
@endsection