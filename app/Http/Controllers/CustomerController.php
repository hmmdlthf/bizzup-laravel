<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\NfcCard;
use App\Models\Social;
use App\Models\SocialType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer): View
    {
        function findMatchingItem($array, $condition)
        {
            foreach ($array as $item) {
                if ($condition($item)) {
                    return $item;
                }
            }
            return null; // Return null if no matching item is found
        }

        $socialTypes = SocialType::select('id', 'name', 'icon', 'default-link', 'prefix', 'suffix')->get();

        $socials = $customer->socials;

        $social_btns = [];

        foreach ($socialTypes as $socialType) {
            $foundSocial = findMatchingItem($socials, function ($social) use ($socialType) {
                return $social->name == $socialType->name;
            });

            if ($foundSocial) {
                $social_btns[] = $foundSocial;
            } else {
                $social_btns[] = $socialType;
            }
        }

        $directory_path = 'bizzup-laravel/public/storage/';
        $laravel_root_path = '/bizzup-laravel';

        $phones = $customer->phones->toArray();
        $emails = $customer->emails->toArray();
        $whatsapps = $customer->whatsapps->toArray();
        $websites = $customer->websites->toArray();
        $products = $customer->products->toArray();
        $other_images = $customer->other_images->toArray();

        function addFieldToArray($array, $additionalItemsArray)
        {
            $final_array = [];
            foreach ($array as $item) {
                $newItem = $item + $additionalItemsArray; // Merge the arrays
                $final_array[] = $newItem;
            }
            return $final_array;
        }

        $contact_us_content = [];

        if (isset($phones) && !empty($phones)) {
            $phone_fields = ['title' => 'primary', 'type' => 'link', 'link_type' => 'tel'];
            $phones = addFieldToArray($phones, $phone_fields);
            $phonePrimary = str_replace(' ', '', $phones[0]['value']);
            $contact_us_content[] = [
                "icon" => "<svg xmlns=\"http=>//www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 512 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https=>//fontawesome.com License - https=>//fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30.0 11.6-46.3l-40-96z\" fill=\"currentColor\"/></svg>",
                "items" => $phones
            ];
        }

        if (isset($whatsapps) && !empty($whatsapps)) {
            $whatsapp_fields = ['title' => 'primary', 'type' => 'link', 'link_type' => 'whatsapp'];
            $whatsapps = addFieldToArray($whatsapps, $whatsapp_fields);
            $whatsappOffernumber = str_replace(' ', '', $whatsapps[0]['value']);
            $whatsappPrimary = str_replace(' ', '', $whatsapps[0]['value']);
            $contact_us_content[] = [
                "icon" => "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 448 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49.0 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13.0 4.6-24.1 3.2-26.4-1.3-2.5-5.0-3.9-10.5-6.6z\" fill=\"currentColor\"/></svg>",
                "items" => $whatsapps
            ];
        }

        $whatsappOffernumber = isset($whatsappOffernumber) ? $whatsappOffernumber : $phonePrimary;
        $whatsappPrimary = isset($whatsappPrimary) ? $whatsappPrimary : $phonePrimary;

        if (isset($emails) && !empty($emails)) {
            $email_fields = ['title' => 'primary', 'type' => 'link', 'link_type' => 'mail'];
            $emails = addFieldToArray($emails, $email_fields);
            $primaryEmail = $emails[0]['value'];
            $contact_us_content[] = [
                "icon" => "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 512 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z\" fill=\"currentColor\"/></svg>",
                "items" => $emails
            ];
        }

        if (isset($websites) && !empty($websites)) {
            $website_fields = ['title' => 'primary', 'type' => 'link', 'link_type' => 'website'];
            $websites = addFieldToArray($websites, $website_fields);
            $contact_us_content[] = [
                "icon" => "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 512 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27.0 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z\" fill=\"currentColor\"/></svg>",
                "items" => $websites
            ];
        }

        if (isset($customer->address) && !empty($customer->address)) {
            $contact_us_content[] = [
                "icon" => "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 384 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z\" fill=\"currentColor\"/></svg>",
                "items" => [
                    [
                        'type' => 'text',
                        'value' => $customer->address
                    ]
                ]
            ];
        }

        $section_items = [
            [
                "title" => "contact us",
                "icon" => "<svg xmlns=\"http=>//www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 448 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https=>//fontawesome.com License - https=>//fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z\" fill=\"currentColor\"/></svg>",
                "type" => "icon-items",
                "content" => $contact_us_content
            ],
            [
                "title" => "offers & updates",
                "icon" => "<svg xmlns=\"http=>//www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 448 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https=>//fontawesome.com License - https=>//fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z\" fill=\"currentColor\"/></svg>",
                "type" => "des-cta",
                "content" => [
                    "des" => "If you want to get our latest offers and updates send us a message",
                    "button" => [
                        "text" => !empty($whatsappOffernumber) ? $whatsappOffernumber : $phonePrimary,
                        "type" => "btn-icon-text",
                        "link" => "https://wa.me/" . '' . "?text=offers%20and%20updates",
                        "icon" => "<svg xmlns=\"http=>//www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 448 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https=>//fontawesome.com License - https=>//fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z\" fill=\"currentColor\"/></svg>"
                    ]
                ]
            ]
        ];

        if (isset($customer->about) && !empty($customer->about)) {
            $section_items[] = [
                "title" => "about us",
                "icon" => "<svg xmlns=\"http=>//www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 448 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https=>//fontawesome.com License - https=>//fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z\" fill=\"currentColor\"/></svg>",
                "type" => "markdown",
                "content" => $customer->about
            ];
        }

        if (isset($products) && !empty($products)) {
            $section_items[] = [
                "title" => "products",
                "icon" => "<svg xmlns=\"http=>//www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 448 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https=>//fontawesome.com License - https=>//fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z\" fill=\"currentColor\"/></svg>",
                "type" => "products",
                "content" => $products
            ];
        }

        if (isset($other_images) && !empty($other_images)) {
            $section_items[] = [
                "title" => "Images",
                "icon" => "<svg xmlns=\"http=>//www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 448 512\"><!--! Font Awesome Free 6.4.2 by @fontawesome - https=>//fontawesome.com License - https=>//fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d=\"M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z\" fill=\"currentColor\"/></svg>",
                "type" => "products-only-images",
                "content" => $other_images
            ];
        }

        $location = findMatchingItem($social_btns, function ($x) {
            return $x['name'] == 'location';
        });

        $qrcode_data = NfcCard::select('uid', 'url', 'qrcode')->where('customer_id', $customer->id)->get()[0];

        $footer_btns = [
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" fill="currentColor"/></svg>',
                'link' => "tel:$phonePrimary",
                'prefix' => 'tel:',
                'name' => 'phone'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" fill="currentColor"/></svg>',
                'link' => "https://wa.me/$whatsappPrimary?text=Hi",
                'prefix' => 'https://wa.me/',
                'suffix' => '?text=Hi',
                'name' => 'whatsapp'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" fill="currentColor"/></svg>',
                'link' => isset($location['value']) ? $location['value'] : $location['default-link'],
                'name' => 'Direction'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 80C0 53.5 21.5 32 48 32h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80zM64 96v64h64V96H64zM0 336c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V336zm64 16v64h64V352H64zM304 32h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H304c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48zm80 64H320v64h64V96zM256 304c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s7.2-16 16-16s16 7.2 16 16v96c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s-7.2-16-16-16s-16 7.2-16 16v64c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V304zM368 480a16 16 0 1 1 0-32 16 16 0 1 1 0 32zm64 0a16 16 0 1 1 0-32 16 16 0 1 1 0 32z" fill="currentColor"/></svg>',
                'name' => 'QR Code'
            ]
        ];


        return view('customers.profile', compact('customer', 'social_btns', 'directory_path', 'laravel_root_path', 'section_items', 'footer_btns', 'qrcode_data', 'location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer): View
    {
        $this->authorize('update', $customer);
        
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $this->authorize('update', $customer);

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'city_id' => 'required|integer'
        ]);

        $customer->update($validated);

        return redirect(route('customers.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
