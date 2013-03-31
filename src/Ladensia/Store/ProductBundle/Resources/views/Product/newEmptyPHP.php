{% extends 'LadensiaStoreWebshopBundle:Default:index.html.twig' %}


{% block right_column %}
<div class="right_column">
    <div id="product_box">
    {% if product %}
        {% for product_detail in product %}
        <h2>{{ product_detail.name }}</h2>
        <h3 style="width: 280px;">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, 
                sed diam nonumy eirmod</h3>

        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, 
        sed diam nonumy eirmod tempor invidunt ut labore et dolore magna 
        aliquyam erat, sed diam voluptua. At vero eos et accusam et justo 
        duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata 
        sanctus est Lorem ipsum dolor sit amet.</p>

        <div class="product_images">
            <img src="/uploads/{{ product_detail.image }}" alt="{{ product_detail.name }}" height="210" />

            <img src="{{ asset('/bundles/ladensiastorewebshop/images/lupe.png') }}" alt="Zoom" class="product_image_loupe " />
        </div>
        
        <div class="bottom_box">
            <div class="product_details">
                <h3>Produktspezifikationen</h3>
                <ul>
                    <li><img src="{{ asset('/bundles/ladensiastorewebshop/images/arrow_green.png') }}" alt="check" /> Lorem ipsum dolor sit amet</li>
                    <li><img src="{{ asset('/bundles/ladensiastorewebshop/images/arrow_green.png') }}" alt="check" /> Lorem ipsum dolor sit amet</li>
                    <li><img src="{{ asset('/bundles/ladensiastorewebshop/images/arrow_green.png') }}" alt="check" /> Lorem ipsum dolor sit amet</li>
                    <li><img src="{{ asset('/bundles/ladensiastorewebshop/images/arrow_green.png') }}" alt="check" /> Lorem ipsum dolor sit amet</li>
                    <li><img src="{{ asset('/bundles/ladensiastorewebshop/images/arrow_green.png') }}" alt="check" /> Lorem ipsum dolor sit amet</li>
                </ul>
            </div>
            <div class="product_slider">
                <img src="{{ asset('/bundles/ladensiastorewebshop/images/arrow_slide_left.gif') }}" alt="" />
                <div class="product_slide_pics">
                    <img src="/uploads/{{ product_detail.image }}" alt="{{ product_detail.name }}" height="70" />
                    <img src="{{ asset('/bundles/ladensiastorewebshop/images/product_detail_small.png') }}" alt="" />
                    <img src="{{ asset('/bundles/ladensiastorewebshop/images/product_detail_small.png') }}" alt="" />
                </div>
                <img src="{{ asset('/bundles/ladensiastorewebshop/images/arrow_slide_right.gif') }}" alt="" />
            </div>
            <div class="clr"></div>
         </div>
         <div class="product_footer_box">
         {% if product %}
            {% for product_detail in product %}
         <span class="product_buy"><a href="{{ path('LadensiaStoreCartBundle_show_cart', {'productId' : product_detail.id}) }}"><img src="{{ asset('/bundles/ladensiastorewebshop/images/icons/cart.png') }}" alt="Bestellen" /> Bestellen</a></span>
            {% endfor %}
         {% endif %}
         </div>
        
        
        {% endfor %}
    {% endif %}
    </div>
    
</div>
<script type="text/javascript">
            var gallerific = '';
</script>
{% endblock %}