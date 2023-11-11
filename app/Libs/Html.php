<?php

if (!function_exists('svl_ismobile')) {

    function svl_ismobile()
    {
        $tablet_browser = 0;
        $mobile_browser = 0;

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
        );

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }

        if ($tablet_browser > 0) {
            // do something for tablet devices
            return 'is tablet';
        } else if ($mobile_browser > 0) {
            // do something for mobile devices
            return 'is mobile';
        } else {
            // do something for everything else
            return 'is desktop';
        }
    }
}
if (!function_exists('getImageUrl')) {
    function getImageUrl($module = '', $src = '', $type = '')
    {
        $path  = '';
        $dir = explode("/", $src);
        $file = collect($dir)->last();
        if (svl_ismobile() == 'is mobile') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else if (svl_ismobile() == 'is tablet') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else if (svl_ismobile() == 'is desktop') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else {
            $path = $src;
        }
        if (File::exists(base_path($path))) {
            $path = $path;
        } else {
            $path = $src;
        }
        return asset($path);
    }
}
if (!function_exists('getFunctions')) {
    function getFunctions()
    {
        $data = [];
        $getFunctions = \App\Models\Permission::select('title')->where('publish', 0)->where('parent_id', 0)->get()->pluck('title');
        if (!$getFunctions->isEmpty()) {

            foreach ($getFunctions as $v) {
                $data[] = $v;
            }
        }
        return $data;
    }
}
if (!function_exists('htmlArticle')) {
    function htmlArticle($item = [], $viewed = 'lượt xem')
    {
        $html = '';
        $html .= '<div class="md:flex space-x-0 md:space-x-8 ">
        <div class="w-full md:w-[220px] overflow-hidden">
            <a href="' . route('routerURL', ['slug' => $item->slug]) . '">
                <img src="' . asset($item->image) . '" alt="' . $item->title . '"
                    class="w-full h-[223px] md:h-[160px] object-cover">
            </a>
        </div>
        <div class="flex-1">
            <h3 class="font-bold text-base text-c8252c mt-2 md:mt-0">
                <a href="' . route('routerURL', ['slug' => $item->slug]) . '"
                    class="hover:text-d61c1f">' . $item->title . '
                </a>
            </h3>
            <div class="flex items-center space-x-5 my-1">
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>
                    <span>
                        ' . $item->created_at . '
                    </span>

                </div>
                <div class="flex items-center space-x-1">
                    

                </div>

            </div>
            <div class="line-clamp line-clamp-3">
                ' . $item->description . '
</div>
</div>
</div>';
        return $html;
    }
}
if (!function_exists('htmlAddress')) {
    function htmlAddress($data = [])
    {
        $html = '';
        if (isset($data)) {
            foreach ($data as $k => $v) {
                $html .= ' <li class="showroom-item loc_link result-item" data-brand="' . $v->title . '"
    data-address="' . $v->address . '" data-phone="' . $v->hotline . '" data-lat="' . $v->lat . '"
    data-long="' . $v->long . '">
    <div class="heading" style="display: flex">

        <p class="name-label" style="flex: 1">
            <strong>' . ($k + 1) . '. ' . $v->title . '</strong>
        </p>
    </div>
    <div class="details">
        <p class="address" style="flex:1"><em>' . $v->address . '</em>
        </p>

        <p class="button-desktop button-view hidden-xs">
            <a href="javascript:void(0)" onclick="return false;">Tìm đường</a>
            <a class="arrow-right"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </p>
        <p class="button-mobile button-view visible-xs">
            <a target="_blank" href="https://www.google.com/maps/dir//' . $v->lat . ',' . $v->long . '">Tìm đường</a>
            <a class="arrow-right" target="_blank"
                href="https://www.google.com/maps/dir//' . $v->lat . ',' . $v->long . '"><span><i
                        class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </p>
    </div>
</li>';
            }
        }
        return $html;
    }
}

/**HTML: item sản phẩm */
if (!function_exists('htmlItemProduct')) {
    function htmlItemProduct($key = '', $item = [], $class = 'group product-item bg-white rounded-2xl shadowC hover-box')
    {
        $html = '';

        if (!empty($item->product_customer_price_items)) {
            $price = array(
                'price_old' => '',
                'price_final_none_format' => $item->product_customer_price_items->price,
                'price_final' => !empty($item->product_customer_price_items->price > 0) ? number_format(floor($item->product_customer_price_items->price), 0, ',', '.') . 'đ' : 'Liên hệ',
                'percent' => '',
                'flag' => 1,
            );
        } else {
            $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>
            $item['price_contact']));
        }
        if (svl_ismobile() == 'is mobile') {
            $image = getImageUrl('products', $item['image'], 'small');
        } else {
            $image = getImageUrl('products', $item['image'], 'medium');
        }
        $html .= '<div class="' . $class . '">
                                <div class="img-box overflow-hidden rounded-t-2xl">
                                    <a href="' . route('routerURL', ['slug' => $item['slug']]) . '" class=" ">
                                        <img class=" w-full h-[193px] md:h-[216px] object-cover bg-white rounded-t-2xl" src="' . $image . '" alt="' . $item['title'] . '">
                                    </a>
                                </div>
                                <div class="p-[10px]">
                                    <div class="flex flex-wrap">';
        if (count($item['getTags']) > 0) {
            foreach ($item['getTags'] as $val) {
                $html .= '<a class="text-[#90908e] text-xs hover:text-green-500 mb-1" href="' . route('tagURL', ['slug' => $val->slug]) . '">#' . $val->title . '</a>';
            }
        }
        $html .= '</div>
                                    <div>
                                    <a class="text-sm font-bold clamp-2 group-hover:text-green-500 hover:text-green-500 h-10 clamp-2" href="' . route('routerURL', ['slug' => $item->slug]) . '">' . $item['title'] . '</a></div>
                                    <div class="flex justify-between items-center space-x- mt-2">
                                        <div class="flex-1">';
        if (!empty(Auth::guard('customer')->user())) {
            $html .= '<span class="text-green-500 font-semibold text-sm">' . $price['price_final'] . '</span>';
            $html .= '<span class="font-normal text-sm line-through">' . $price['price_old'] . '</span>';
        } else {
            $html .= '<span class="text-green-500 font-semibold text-sm">' . trans('index.Contact') . '</span>';
        }


        $html .= '</div>
                                        <a href="' . route('routerURL', ['slug' => $item['slug']]) . '" data-toggle="tooltip" data-placement="top" type="button" title="Thêm vào giỏ" class="hover:text-white text-green-500 rounded-full bg-[#e8f6ea] border border-green-500 w-10 h-10 text-center hover:bg-green-500 hover:border-green-500 flex items-center justify-center">
                                            <svg style="width:24px;height:24px" xmlns="http://www.w3.org/2000/svg" class="mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>';
        return $html;
    }
}
