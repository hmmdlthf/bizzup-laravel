<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example Profile - Bizzup.in</title>

    <link rel="stylesheet" href="/scss/variables.css">
    <link rel="stylesheet" href="/scss/styles.css">
    <link rel="stylesheet" href="/scss/profile.css">
    <link rel="stylesheet" href="/scss/markdown.css">
    <link rel="stylesheet" href="/scss/modal.css">

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>

<body>
    <div class="main">
        <div class="pic">
            <div class="cover-pic">
                <img src="{{ asset('storage/' . $customer->cover_pic) }}" alt="">
            </div>
            <div class="profile-pic">
                <img src="{{ $customer->profile_type == 'personal' ? asset('storage/' . $customer->profile_pic) : asset('storage/' . $customer->company_logo)  }}" alt="">

                <?php if ($customer->profile_pic) { ?>
                    <div class="company-logo">
                        <img src="{{ asset('storage/' . $customer->company_logo) }}" alt="">
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="profile-top">
            <div class="column">
                <div class="name">{{ $customer->profile_type == 'personal' ? $customer->name : $customer->company_name }}</div>
                @if($customer->position)
                    <div class="position">
                        {{ $customer->position }} @ <span class="company">{{ $customer->company_name }}</span>
                    </div>
                @endif
                <div class="location">
                    <div class="city">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" fill="currentColor" />
                        </svg>
                        <span>{{ $customer->city->name }}</span>
                    </div>
                    <div class="state">{{ $customer->city->state->name }}</div>
                    <div class="country">{{ $customer->city->state->country->name }}</div>

                </div>
            </div>
        </div>
        <div class="profile-info">
            <div class="square-btns">
                @foreach ($social_btns as $btn)
                    <div class="btn btn-square {{ $btn['name'] }}-btn" id="{{ $btn['name'] }}-btn">
                        <a href="{{ isset($btn['prefix']) ? $btn['prefix'] : '' }}{{ isset($btn['value']) ? str_replace(' ', '', $btn['value']) : $btn['default-link'] }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $laravel_root_path . $btn['icon'] }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="icon-text-btns">
                <button class="btn-icon-text" id="save-btn">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" fill="currentColor" />
                        </svg>
                    </span>
                    <span class="text">
                        Save contact
                    </span>
                </button>
                <div class="btn-icon-text" id="share-btn">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 50 50">
                            <path d="M 40 0 C 34.535156 0 30.078125 4.398438 30 9.84375 C 30 9.894531 30 9.949219 30 10 C 30 13.6875 31.996094 16.890625 34.96875 18.625 C 36.445313 19.488281 38.167969 20 40 20 C 45.515625 20 50 15.515625 50 10 C 50 4.484375 45.515625 0 40 0 Z M 28.0625 10.84375 L 17.84375 15.96875 C 20.222656 18.03125 21.785156 21 21.96875 24.34375 L 32.3125 19.15625 C 29.898438 17.128906 28.300781 14.175781 28.0625 10.84375 Z M 10 15 C 4.484375 15 0 19.484375 0 25 C 0 30.515625 4.484375 35 10 35 C 12.050781 35 13.941406 34.375 15.53125 33.3125 C 18.214844 31.519531 20 28.472656 20 25 C 20 21.410156 18.089844 18.265625 15.25 16.5 C 13.71875 15.546875 11.929688 15 10 15 Z M 21.96875 25.65625 C 21.785156 28.996094 20.25 31.996094 17.875 34.0625 L 28.0625 39.15625 C 28.300781 35.824219 29.871094 32.875 32.28125 30.84375 Z M 40 30 C 37.9375 30 36.03125 30.644531 34.4375 31.71875 C 31.769531 33.515625 30 36.542969 30 40 C 30 40.015625 30 40.015625 30 40.03125 C 29.957031 40.035156 29.917969 40.058594 29.875 40.0625 L 30 40.125 C 30.066406 45.582031 34.527344 50 40 50 C 45.515625 50 50 45.515625 50 40 C 50 34.484375 45.515625 30 40 30 Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <span class="text">
                        Share
                    </span>
                </div>
                <script>
                    var contact = {
                        name: "{{ $customer->profile_type == 'personal' ? $customer->name : $customer->company_name }}",
                        phone: "{{ $customer->phones[0] }}",
                        email: "{{ count($customer->emails) > 0 ? $customer->emails[0] : '' }}"
                    };

                    // create a vcard file
                    var vcard = "BEGIN:VCARD\nVERSION:3.0\nFN:" + contact.name + "\nTEL;TYPE=WORK,VOICE:" + contact.phone + "\nEMAIL:" + contact.email + "\nEND:VCARD";
                    var blob = new Blob([vcard], {
                        type: "text/vcard"
                    });
                    var url = URL.createObjectURL(blob);
                    var shareObject = {
                        title: 'New Contacts',
                        text: 'Save contacts',
                        files: [new File([blob], 'newcontact.vcf', {
                            type: 'text/vcard'
                        })],
                    }

                    var saveBtn = document.getElementById("save-btn");
                    saveBtn.addEventListener("click", function() {
                        // Get the contact information from the website
                        const newLink = document.createElement('a');
                        newLink.download = contact.name + ".vcf";
                        newLink.textContent = contact.name;
                        newLink.href = url;
                        newLink.click();

                    });


                    // Check if the browser supports the Web Share API
                    if (navigator.share) {
                        // The browser supports the Web Share API
                        const shareButton = document.getElementById('share-btn');

                        shareButton.addEventListener('click', async () => {
                            try {
                                await navigator.share({
                                    title: '{{ $customer->profile_type == 'personal' ? $customer->name : $customer->company_name }}',
                                    text: 'check out my digital business profile',
                                    url: window.location.href,
                                });
                            } catch (error) {
                                console.error('Sharing failed:', error);
                            }
                        });
                    } else {}
                </script>
            </div>

            @foreach ($section_items as $section_item)
            <div class="section">
                <div class="section-head">
                    <div class="head-icon">
                        <?php echo $section_item['icon']; ?>
                    </div>
                    <div class="head-title">
                        <?php echo $section_item['title']; ?>
                    </div>
                </div>
                <div class="section-items">
                    @if ($section_item['type'] == 'icon-items')
                        @foreach ($section_item['content'] as $item)
                            <div class="section-item">
                                <div class="item-icon">
                                    {!! $item['icon'] !!}
                                </div>
                                <div class="item-content">
                                    @foreach ($item['items'] as $value)
                                        <div class="item-value">
                                            @if (isset($value['title']))
                                                <div class="value-title">{{ $value['title'] }}</div>
                                            @endif
                
                                            <div class="value-value">
                                                @if ($value['type'] == 'link')
                                                    @if ($value['link_type'] == 'tel')
                                                        <a href="tel:{{ $value['value'] }}">{{ $value['value'] }}</a>
                                                    @elseif ($value['link_type'] == 'whatsapp')
                                                        <a href="https://wa.me/{{ $value['value'] }}?text=Hi">{{ $value['value'] }}</a>
                                                    @elseif ($value['link_type'] == 'mail')
                                                        <a href="mailto:{{ $value['value'] }}">{{ $value['value'] }}</a>
                                                    @elseif ($value['link_type'] == 'website')
                                                        <a href="https://{{ $value['value'] }}">{{ $value['value'] }}</a>
                                                    @elseif ($value['link_type'] == 'text')
                                                        {{ $value['value'] }}
                                                    @endif
                                                @else
                                                    {{ $value['value'] }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @elseif ($section_item['type'] == 'des-cta')
                        <p>{{ $section_item['content']['des'] }}</p>
                        @if ($section_item['content']['button']['type'] == 'btn-icon-text')
                            <a href="{{ $section_item['content']['button']['link'] }}">
                                <div class="btn-icon-text">
                                    <span class="icon">
                                        {!! $section_item['content']['button']['icon'] !!}
                                    </span>
                                    <span class="text">
                                        {{ $section_item['content']['button']['text'] }}
                                    </span>
                                </div>
                            </a>
                        @endif
                    @elseif ($section_item['type'] == 'markdown')
                        {!! $section_item['content'] !!}
                    @elseif ($section_item['type'] == 'products')
                        <div class="products">
                            @foreach ($section_item['content'] as $product)
                                <div class="product" id="product_{{ $product['id'] }}">
                                    <div class="product-image">
                                        <img src="{{ asset('storage/' . $product['image']) }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <script>
                            var products = @json($section_item['content']);
                        </script>
                    @elseif ($section_item['type'] == 'products-only-images')
                        <div class="products">
                            @foreach ($section_item['content'] as $product)
                                <div class="product-list-item" id="product_image_{{ $product['id'] }}">
                                    <div class="product-image">
                                        <img src="{{ asset('storage/' . $product['image']) }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <script>
                            var product_images = @json($section_item['content']);
                        </script>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="modal product-modal" id="product-modal">
            <div class="modal-back" onclick="toggleProductModal()"></div>
            <div class="modal-box">
                <div class="modal-close" onclick="toggleProductModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" fill="currentColor" />
                    </svg>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
            </div>
        </div>


        <div class="footer">
            <div class="footer-btns">
                @foreach ($footer_btns as $footer_btn)
                    @if ($footer_btn['name'] == 'QR Code')
                        <a onclick="showQrCode()">
                            <div class="footer-btn">
                                <div class="icon">{!! $footer_btn['icon'] !!}</div>
                                <div class="text">{{ $footer_btn['name'] }}</div>
                            </div>
                        </a>
                    @else
                        <a href="{{ $footer_btn['link'] }}" target="_blank" rel="noopener noreferrer">
                            <div class="footer-btn">
                                <div class="icon">{!! $footer_btn['icon'] !!}</div>
                                <div class="text">{{ $footer_btn['name'] }}</div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <script>
            var product_elements = document.querySelectorAll('.product');
            product_elements.forEach((x) => {
                x.addEventListener('click', (e) => {
                    // Get the product ID from the element's ID attribute
                    // alert('clicked')
                    var productId = x.id.split('_')[1];

                    // Call your function with the product ID or perform any other action
                    handleProductClick(productId);
                    toggleProductModal()
                });
            });

            function toggleProductModal() {
                document.getElementById('product-modal').classList.toggle('show');
            }

            function handleProductClick(id) {
                var modal_body = document.getElementById('modal-body');
                modal_body.innerHTML = ''
                var product = {}
                products.forEach((x) => {
                    if (x['id'] == id) {
                        product = x;
                    }
                })

                var title = document.createElement('div');
                title.className = 'title'
                title.innerHTML = product['title']

                var image = document.createElement('div');
                image.className = 'image'
                var img = document.createElement('img');
                img.src = `{{ $directory_path }}${product['image']}`

                var text = document.createElement('div')
                text.className = 'text'

                modal_body.appendChild(title)
                modal_body.appendChild(image)
                image.appendChild(img)
                modal_body.appendChild(text)

                if (product.hasOwnProperty('discount-price') && product['discount-price'] != "") {
                    var price = document.createElement('div')
                    price.className = 'price'
                    var price_name = document.createElement('div')
                    price_name.className = 'name'
                    price_name.innerHTML = 'Price'
                    var price_values = document.createElement('div')
                    price_values.className = 'values'
                    text.appendChild(price)
                    price.appendChild(price_name)
                    price.appendChild(price_values)

                    if (product.hasOwnProperty('price') && product['price'].trim() != "") {
                        var price_value = document.createElement('div')
                        price_value.className = 'price-value'
                        price_value.innerHTML = `Rs ${product['price']}`
                        price_values.appendChild(price_value)
                    }

                    var discount_price = document.createElement('div')
                    discount_price.className = 'discount-price'
                    discount_price.innerHTML = `Rs ${product['discount-price']}`
                    price_values.appendChild(discount_price)

                }

                if (product.hasOwnProperty('des') && product['des'].trim() != "") {
                    var des = document.createElement('div')
                    des.className = 'description'
                    des.innerHTML = marked.parse(product['des'])
                    text.appendChild(des)
                }
            }
        </script>

        <script>
            var product_elements = document.querySelectorAll('.product-list-item');
            product_elements.forEach((x) => {
                x.addEventListener('click', (e) => {
                    // Get the product ID from the element's ID attribute
                    // alert('clicked')
                    var productId = x.id.split('_')[2];

                    // Call your function with the product ID or perform any other action
                    handleProductImageClick(productId);
                    toggleProductModal()
                });
            });

            function handleProductImageClick(id) {
                var modal_body = document.getElementById('modal-body');
                modal_body.innerHTML = ''
                var product = {}
                product_images.forEach((x, i) => {
                    if (x['id'] == id) {
                        product = x;
                    }
                })

                var image = document.createElement('div');
                image.className = 'image'
                var img = document.createElement('img');
                img.src = `{{ $directory_path }}${product['image']}`;

                modal_body.appendChild(image)
                image.appendChild(img)
            }
        </script>

        <script>
            function showQrCode() {
                toggleProductModal()

                var qrcode_data = @json($qrcode_data);

                var modal_body = document.getElementById('modal-body');
                modal_body.innerHTML = ''

                var title = document.createElement('div');
                title.className = 'title'
                title.innerHTML = 'Qrcode'
                modal_body.appendChild(title)

                if (qrcode_data) {
                    var image = document.createElement('div');
                    image.className = 'image'
                    modal_body.appendChild(image)

                    var img = document.createElement('img');
                    img.style.objectFit = 'contain'
                    img.style.width = '200px';
                    img.style.height = 'auto';
                    img.src = `{{ $directory_path }}${qrcode_data['qrcode']}`;
                    image.appendChild(img)

                    var text = document.createElement('div');
                    text.className = 'text'
                    text.innerHTML = `<a href="${qrcode_data['url']}" target="_blank">${qrcode_data['url']}</a>`
                    modal_body.appendChild(text)
                } else {
                    var text = document.createElement('div');
                    text.className = 'text-center'
                    text.innerHTML = 'No QrCode Provided'
                    modal_body.appendChild(text)
                }
            }
        </script>
        
    </div>



</body>

</html>