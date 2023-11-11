<?php $__env->startPush('javascript'); ?>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<link href="<?php echo e(asset('library/select2/select2.min.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('library/select2/select2.full.min.js')); ?>"></script>
<script>
    new TomSelect(".tom-select-field", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        },
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        }
    });
    new TomSelect(".tom-select-multiple", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        }
    });
    new TomSelect(".tom-select-brand", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        }
    });
    new TomSelect(".tom-select-tag", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        }
    });
</script>
<script>
    var attributes = new Array();
    $(document).ready(function() {
        $('.block-attribute input[name="checkbox[]"]').each(function() {
            if ($(this).is(':checked')) {
                var _this = $(this).parent().parent();
                var id = _this.find('select[name="attribute_catalogue[]"]').val();
                attributes[id] = [];
                var index = _this.find('td:first-child').attr('data-index');
                _this.find('select[name="attribute[' + index + '][]"] option:selected').each(function() {
                    attributes[id].push($(this).text());
                });
            }
        })
    })
</script>
<script>
    $('.select2').select2();
    $('.select3').select2();

    function selectMultipe(object, select = "title") {
        let condition = object.attr('data-condition');
        let title = object.attr('data-title');
        let module = object.attr('data-module');
        let key = object.attr('data-key');
        object.select2({
            minimumInputLength: 0,
            placeholder: title,
            ajax: {
                url: BASE_URL_AJAX + 'ajax/select2',
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                deley: 250,
                data: function(params) {
                    return {
                        locationVal: params.term,
                        module: module,
                        key: key,
                        select: select,
                        condition: condition,
                    };
                },
                processResults: function(data) {
                    // console.log(data);
                    return {
                        results: $.map(data, function(obj, i) {
                            return obj
                        })
                    }

                },
                cache: true,
            }
        });
    }

    $('.selectMultipe').each(function(key1, index) {
        let _this = $(this);
        let select = _this.attr('data-select');
        select = (typeof select == 'undefined') ? 'title' : select;
        let key = _this.attr('data-key');
        key = (typeof key == 'undefined') ? 'id' : key;
        let module = _this.attr('data-module');
        let json = _this.attr('data-json');
        value = (typeof json != "undefined") ? window.atob(json) : '';
        let parse = JSON.parse(value);
        if (parse != 'undefined' && parse.length) {
            for (let i = 0; i < parse.length; i++) {
                var option = new Option(parse[i].text, parse[i].id, true, true);
                _this.append(option).trigger('change');
            }
        }
        selectMultipe($(this), select);
    });
</script>
<script>
    function check_customer_price() {
        var arraysCustomerTmp = [];
        let index = $('.block-customer-price tbody tr').length;
        for (var i = 0; i < index; i++) {
            $('.block-customer-price select[name="customers[' + i + '][]"]').each(function() {
                let val = $(this).val();
                arraysCustomerTmp.push(val);
            });
        }
        // // xóa hết disable đi
        // arraysCustomerTmp.forEach(function(item, index) {
        //     item.forEach(function(val) {
        //         $('.block-customer-price select[name="customers[' + index + '][]"]').find("option[value=" + val + "]").prop('disabled', true);
        //     });
        // });
        $('.selectCustomer').each(function(key, index) {
            $(this).select2();
        });
        // // // nếu cái option nào được chọn thì xóa disable cua nó đi
        // $('.block-attribute select[name="attribute_catalogue[]"]').find("option:selected").removeAttr("disabled");
    }
    check_customer_price();
    $(document).on('click', '.add-customer-price', function() {
        var arraysCustomer = [];
        let _this = $(this);
        $('.block-customer-price').find('select.selectCustomer option:selected').each(function(key, value) {
            arraysCustomer.push($(this).val())
        });
        var customers = JSON.parse(window.atob(_this.attr('data-customers')));
        let key = Object.keys(customers);
        let value = Object.values(customers);
        let index = $('.block-customer-price tbody tr').length;
        let html = '<tr class="align-middle">';
        html = html + '<td>';
        html = html + '<select name="customers[' + index + '][]" class="form-control selectCustomer" multiple>';
        let pos = '';
        for (let i = 0; i < key.length; i++) {
            pos = arraysCustomer.indexOf(key[i]);
            if (pos == -1) {
                html = html + '<option value="' + key[i] + '">' + value[i] + '</option>';
            } else {
                html = html + '<option disabled="disabled" value="' + key[i] + '">' + value[i] + '</option>';
            }
        }
        html = html + '</select>';
        html = html + '</td>';
        html = html + '<td >';
        html = html + '<input type="text" class="form-control int" name="price_customers[]">';
        html = html + '</td>';
        html = html + '<td>';
        html = html + '<a href="javascript:void(0)" class="delete-customer-price flex items-center text-danger">Xóa</a>';
        html = html + '</td>';
        html = html + '</tr>';
        $('.block-customer-price').find('table tbody').append(html);
        $('.selectCustomer').each(function(key, index) {
            $(this).select2();
        });
    });

    $(document).on('click', '.delete-customer-price', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove()
    })
</script>
<script type="text/javascript">
    /*======================xử lí khối thêm phiên bản======================*/
    // Click "Thêm mới"
    $(document).on('click', '.block-version .show-version', function(e) {
        e.preventDefault();
        let _this = $(this);
        _this.parent('div').find('.hide-version').show();
        _this.hide();
        _this.parents('.block-version').find('.ibox-content').show();
    });
    // Click "Đóng"
    $(document).on('click', '.block-version .hide-version', function(e) {
        e.preventDefault();
        let _this = $(this);
        _this.parents('.block-version').find('.show-version').show();
        _this.parents('.block-version').find('.hide-version').hide();
        _this.parents('.block-version').find('.ibox-content').hide();
    });
    var attribute_catalogue = [];
    //Click " Thêm thuộc tính cho sản phẩm"
    $(document).on('click', '.add-attribute', function() {
        let _this = $(this);
        let attr = _this.attr('data-attribute');
        $('.block-attribute').find('table tbody').append(render_attribute(attr, attribute_catalogue));
        check_attribute();
        $('.select3').each(function(key, index) {
            $(this).select2();
        });
        $countAttr = $('.block-attribute table tbody').find('tr').length;
        $countattribute_catalogue = $('.block-version').attr('data-countattribute_catalogue');
        if (parseFloat($countAttr) >= parseFloat($countattribute_catalogue)) {
            $('.add-attribute').hide()
        } else {
            $('.add-attribute').show()
        }
    });

    $(document).on('change', 'select[name="attribute_catalogue[]"]', function() {
        let _this = $(this);
        check_attribute(_this);
        let catalogue_id = _this.val();
        if (catalogue_id != 0) {
            let index = _this.parents('tr').find('td:first').attr('data-index');
            _this.parents('tr').find('td:eq(2)').html(render_select2(catalogue_id, index));
        } else {
            _this.parents('tr').find('td:eq(2)').html('<input type="text" class="form-control" disabled="disabled">');
        }
        $('.selectMultipe').each(function(key, index) {
            selectMultipe($(this));
        });
    });
    //click "Sản phảm biến thể"
    $(document).on('click', 'input[name="checkbox[]"]', function() {
        let val = $(this).parents('td').find('input[name="checkbox_val[]"]').val();
        if (val == 1) {
            $(this).parents('td').find('input[name="checkbox_val[]"]').val(0);
        } else {
            $(this).parents('td').find('input[name="checkbox_val[]"]').val(1);
        }
        let check = $('input[name="checkbox[]"]:checked').length;
    });

    function render_select2(condition = '', index = '') {
        return '<select name="attribute[' + index + '][]" data-condition="' + condition + '" data-json="" data-stt="' + index + '" class="form-control selectMultipe" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm.." data-module="attributes"></select>';
    }

    function check_attribute(_this = '') {
        attribute_catalogue = new Array();
        $('.block-attribute select[name="attribute_catalogue[]"]').each(function() {
            let val = $(this).find('option:selected').val();
            if (val != 0) {
                attribute_catalogue.push(val);
            }
        });
        // xóa hết disable đi
        $('.block-attribute select[name="attribute_catalogue[]"]').find("option").removeAttr("disabled");
        for (let i = 0; i < attribute_catalogue.length; i++) {
            // thêm disable ở những cái nào trong mảng
            $('.block-attribute select[name="attribute_catalogue[]"]').find("option[value=" + attribute_catalogue[i] + "]").prop('disabled', !$('#one').prop('disabled'));
            $('.block-attribute select[name="attribute_catalogue[]"]').select2();
        }
        // // nếu cái option nào được chọn thì xóa disable cua nó đi
        $('.block-attribute select[name="attribute_catalogue[]"]').find("option:selected").removeAttr("disabled");
    }

    function render_attribute(attr, attribute_catalogue) {
        let index = $('.block-attribute tbody tr').length;
        attr = JSON.parse(window.atob(attr));
        let key = Object.keys(attr);
        let value = Object.values(attr);
        let html = '<tr class="align-middle">';
        html = html + '<td class="d-none" data-index="' + index + '" style="width: 10%">';
        html = html + '<input type="checkbox" name="checkbox[]" value="1" class="checkbox-item form-check-input" disabled>';
        html = html + '<input type="text" name="checkbox_val[]" value="0" class="d-none">';
        html = html + '<div for="" class="label-checkboxitem"></div>';
        html = html + '</td>';
        html = html + '<td style="width: 30%">';
        html = html + '<select name="attribute_catalogue[]" class="form-control select3" >';
        let pos = '';
        for (let i = 0; i < key.length; i++) {
            pos = attribute_catalogue.indexOf(key[i]);
            if (pos == -1) {
                html = html + '<option value="' + key[i] + '">' + value[i] + '</option>';
            } else {
                html = html + '<option disabled="disabled" value="' + key[i] + '">' + value[i] + '</option>';
            }
        }
        html = html + '</select>';
        html = html + '</td>';
        html = html + '<td style="width: 50%">';
        html = html + '<input type="text" class="form-control" disabled="disabled">';
        html = html + '</td>';
        html = html + '<td style="width: 10%">';
        html = html + '<a href="javascript:void(0)" class=" delete-attribute flex items-center text-danger" data-id="" >Xóa</a>';
        html = html + '</td>';
        html = html + '</tr>';
        $('.select3').each(function(key, index) {
            $(this).select2();
        });
        return html;
    }

    function updateTitleJson(text = '') {
        $('.js_add_option').removeClass('active');
        $('input[value="' + text + '"]').parent().addClass('active');
        $('.js_add_option.active').next().each(function() {
            var arrayTitle = $(this).val().split('-');
            var titleJsonNew = '';
            arrayTitle.forEach(function(v, i) {
                console.log('v: ' + v);
                console.log('text: ' + text);
                if (v != text && v != '') {
                    titleJsonNew += v + '-';
                }
            })
            $(this).val(titleJsonNew);
        });
    }
    /*CLICK: 'Sản phẩm biến thể'*/
    $(document).on('change', '.block-attribute input[name="checkbox[]"]', function() {
        if ($(this).is(':checked')) {
            var _this = $(this).parent().parent();
            var id = _this.find('select[name="attribute_catalogue[]"]').val();
            if (id > 0) {
                if (attributes.length == 0) {
                    attributes[id] = [];
                    var index = _this.find('td:first-child').attr('data-index');
                    _this.find('select[name="attribute[' + index + '][]"] option:selected').each(function() {
                        attributes[id].push($(this).text());
                    });
                    get_vesion(attributes);
                    console.log("click check box == 1");
                    console.log('Sản phẩm biến thể attributes', attributes);
                } else {
                    var index = _this.find('td:first-child').attr('data-index');
                    var attributesNew = new Array();
                    attributesNew[id] = [];
                    attributes[id] = [];
                    _this.find('select[name="attribute[' + index + '][]"] option:selected').each(function() {
                        attributesNew[id].push($(this).text());
                    });
                    if (attributesNew[id].length > 0) {
                        //lấy tất cả item checkbox
                        var attributesE = new Array();
                        $('.checkbox-item:checked').each(function() {
                            var idE = $(this).parent().parent().find('select[name="attribute_catalogue[]"]').val();
                            attributesE[idE] = [];
                            $(this).parent().parent().find('select.selectMultipe option:selected').each(function() {
                                attributesE[idE].push($(this).text());
                            });
                        });
                        attributesNew[id].forEach(function(value, index) {
                            if (index == 0) {
                                attributesE[id] = attributesE[id].filter(item => item != value);
                                $('input[name="title_version[]"]').each(function() {
                                    $(this).val($(this).val() + '-' + value);
                                });
                                var addHtml = '';
                                addHtml = addHtml + '<input type="hidden" name="title_check[]" value="' + value + '">';
                                addHtml = addHtml + '<span class="text-xs whitespace-nowrap text-success bg-success/20 pending  pending-success/20 rounded-full px-2 py-1 mr-1 ">' + value + '</span >';
                                $('.js_add_option').append(addHtml);
                            }
                            attributes[id].push(value);
                        })

                        //end
                        get_vesion(attributesE);
                        console.log("click check box > 1");
                        console.log('attributesE', attributesE);
                        console.log('attributes', attributes);
                    }
                }
            }
        } else {
            /*Bỏ tích: Sản phẩm biến thể*/
            var _thisRV = $(this).parent().parent();
            var idRV = _thisRV.find('select[name="attribute_catalogue[]"] option:selected').val();
            var lengthCheckboxRV = $('.checkbox-item:checked').length;
            // console.log('lengthCheckboxRV ', lengthCheckboxRV);
            const allowed = [idRV];
            // console.log('allowed', allowed);
            //cập nhập lại data => attributes
            attributes = Object.keys(attributes)
                .filter(key => !allowed.includes(key))
                .reduce((obj = [], key) => {
                    obj[key] = attributes[key];
                    return obj;
                }, []);

            _thisRV.find('select.selectMultipe option:selected').each(function(key, value) {
                var text = $(this).text();
                //update title_json
                updateTitleJson(text);
                //end
                if (key == 0) {
                    if (lengthCheckboxRV == 0) {
                        $('input[value="' + text + '"]').parent().parent().parent().remove();
                    } else {
                        $('input[value="' + text + '"]').next().remove();
                        $('input[value="' + text + '"]').remove();
                    }
                }
                if (key > 0) {
                    $('input[value="' + $(this).text() + '"]').parent().parent().parent().remove();
                }
            });
            $(this).parent().parent().find('.checkbox-item').removeAttr("checked");
            // console.log("click bỏ tích checkbox attributes", attributes);
        }
    });
    /*change: Giá trị thuộc tính (Các giá trị cách nhau bởi dấu phẩy) */
    $(document).on('select2:select', '.selectMultipe', function(e) {
        var lengthCheckbox = $(this).parent().parent().find('.checkbox-item:checked').length;
        $(this).parent().parent().find('.checkbox-item').removeAttr("disabled");
        var index = $(this).parent().parent().find('td:first-child').attr('data-index');
        var id = $(this).parent().parent().find('select[name="attribute_catalogue[]"] option:selected').val();

        if (lengthCheckbox > 0) {
            // if (attributes.length > 1) {
            //     tmp_array_remove.forEach(function(data, index) {
            //         attributes[index] = attributes[index].concat(data);
            //     });
            //     tmp_array_remove = new Array();
            // }

            // let attributesNew = attributes.filter((person, i) => i != id);
            var attributesE = new Array();
            $('.checkbox-item:checked').each(function() {
                var idE = $(this).parent().parent().find('select[name="attribute_catalogue[]"]').val();
                attributesE[idE] = [];
                $(this).parent().parent().find('select.selectMultipe option:selected').each(function() {
                    attributesE[idE].push($(this).text());
                });
            });
            attributesE[id] = attributesE[id].filter(item => item == e.params.data.text);
            attributes[id].push(e.params.data.text);
            console.log("click thêm thuộc tính attributes", attributesE);
            get_vesion(attributesE);
        }
    });
    /*click bỏ: : Giá trị thuộc tính (Các giá trị cách nhau bởi dấu phẩy) */
    $(document).on('select2:unselect', '.block-attribute select', function(e) {
        var text = e.params.data.text;
        var id = $(this).parent().parent().find('select[name="attribute_catalogue[]"] option:selected').val();
        var index = $(this).parent().parent().find('td:first-child').attr('data-index');
        var check = $(this).parent().find('select[name="attribute[' + index + '][]"] option:selected').length;
        var lengthCheckbox = $('.checkbox-item:checked').length;
        //update title_json
        updateTitleJson(text);
        //end
        if (check == 0 && lengthCheckbox > 1) {

            $('input[value="' + text + '"]').next().remove();
            $('input[value="' + text + '"]').remove();
            $(this).parent().parent().removeClass('bg-active');
            $(this).parent().parent().find('.checkbox-item').removeAttr("checked");
            $(this).parent().parent().find('.checkbox-item').prop("disabled", true);
        } else {
            if (check == 0) {
                $(this).parent().parent().removeClass('bg-active');
                $(this).parent().parent().find('.checkbox-item').removeAttr("checked");
                $(this).parent().parent().find('.checkbox-item').prop("disabled", true);
            }
            $('input[value="' + text + '"]').parent().parent().parent().remove();
        }
        if (attributes.length > 0) {
            attributes[id] = attributes[id].filter(person => person != text);
        }
        console.log("click bỏ thuộc tính " + text);
        console.log(attributes);
    });
    //Click "Xóa category attributes"
    $(document).on('click', '.block-attribute .delete-attribute', function() {
        //click bỏ tích
        var _thisRV = $(this).parent().parent();
        var idRV = _thisRV.find('select[name="attribute_catalogue[]"] option:selected').val();
        var lengthCheckboxRV = $('.checkbox-item:checked').length;
        console.log(lengthCheckboxRV);
        const allowed = [idRV];
        //cập nhập lại data => attributes
        attributes = Object.keys(attributes)
            .filter(key => !allowed.includes(key))
            .reduce((obj = [], key) => {
                obj[key] = attributes[key];
                return obj;
            }, []);
        // console.log(attributes);
        _thisRV.find('select.selectMultipe option:selected').each(function(key, value) {
            var text = $(this).text();
            //update title_json
            updateTitleJson(text);
            //end
            if (key == 0) {
                if (lengthCheckboxRV == 1) {
                    $('input[value="' + text + '"]').parent().parent().parent().remove();
                } else {
                    $('input[value="' + text + '"]').next().remove();
                    $('input[value="' + text + '"]').remove();
                }
            }
            if (key > 0) {
                $('input[value="' + text + '"]').parent().parent().parent().remove();
            }
        });
        $(this).parent().parent().find('.checkbox-item').removeAttr("checked");
        console.log("click xóa danh mục thuộc tính");
        console.log(attributes);
        let _this = $(this);
        _this.parents('tr').remove();
        let val = _this.parents('tr').find('select[name="attribute_catalogue[]"] option:checked').val();
        $('.block-attribute select[name="attribute_catalogue[]"]').find("option[value=" + val + "]").prop('disabled', false);
        $('.block-attribute select[name="attribute_catalogue[]"]').select2("destroy").select2();
        check_attribute();
        let pos = attribute_catalogue.indexOf(val);
        attribute_catalogue.splice(pos, 1);
        $countAttr = $('.block-attribute table tbody').find('tr').length;
        $countattribute_catalogue = $('.block-version').attr('data-countattribute_catalogue');
        if (parseFloat($countAttr) >= parseFloat($countattribute_catalogue)) {
            $('.add-attribute').hide()
        } else {
            $('.add-attribute').show()
        }
    });

    function get_vesion(attributesVersion = []) {
        let price_old = $('input[name="price"]').val();
        let price_sale = $('input[name="price_sale"]').val();

        let weight = $('input[name="ships[weight]"]').val();
        let length = $('input[name="ships[length]"]').val();
        let width = $('input[name="ships[width]"]').val();
        let height = $('input[name="ships[height]"]').val();

        var attrs = [];
        for (const [attr, values] of Object.entries(attributesVersion))
            attrs.push(values.map(v => ({
                [attr]: v
            })));
        attrs = attrs.reduce((a, b) => a.flatMap(d => b.map(e => ({
            ...d,
            ...e,
        }))));
        var item = '';
        var stt = $('.dd3-content').length;
        attrs.forEach(function(data, index) {
            stt++;
            var code = $('input[name="code"]').val() + '-' + stt;
            item = item + '<div class="mb-2 dd3-content">';
            item = item + '<div class="position-relative">';
            item = item + '<a href="javascript:void(0)" class="form-label mb-0 accordion w-full js_add_option ">';
            var title = '';
            $.each(data, function(i, v) {
                if (i == 0) {
                    title += v;
                } else {
                    title += '-' + v
                }
                item = item + '<input type="hidden" name="title_check[]" value="' + v + '">';
                item = item + '<span class="text-xs whitespace-nowrap text-success bg-success/20 pending  pending-success/20 rounded-full px-2 py-1 mr-1 ' + slug(v) + '">' + v + '</span >';
            })
            item = item + '</a>';
            item = item + '<input type="hidden" name="title_version[]" value="' + title + '">';
            item = item + '<a href="javascript:void(0)" class="text-danger version_remove" data-number="1">Xóa</a>';
            item = item + '</div>';
            item = item + '<div class="version_item_size d-none">';
            item = item + '<div class="row mt-3">';
            item = item + '<div class="col-md-6">';
            item = item + '<label class="form-label">Hình ảnh</label>';
            item = item + '<div class="d-flex align-items-center space-x-3">';
            item = item + '<div class="avatar me-2" style="cursor: pointer;flex:none">';
            item = item + '<img src="<?php echo url('images/404.png') ?>" class="img-thumbnail" style="width: 100px;height: 100px;object-fit: cover;">';
            item = item + '</div>';
            item = item + '<input type="text" name="image_version[]" style="cursor: not-allowed;opacity: 0.56;" value="" class="form-control" placeholder="Đường dẫn của ảnh" autocomplete="off">';
            item = item + '</div>';
            item = item + '</div>';
            item = item + '<div class="col-md-6">';
            item = item + '<label class="form-label">Mã sản phẩm</label>';
            item = item + '<input type="text" name="code_version[]" value="' + code + '" class="form-control" placeholder="" >';
            item = item + '</div>';
            item = item + '</div>';
            item = item + '<div class="row mt-3">';
            item = item + '<div class="col-md-6">';
            item = item + '<label class="form-label">Giá</label>';
            item = item + '<input type="text" value="' + price_old + '" name="price_version[]" class="form-control int price" placeholder="">';
            item = item + '</div>';
            item = item + '<div class="col-md-6">';
            item = item + '<label class="form-label">Giá ưu đãi</label>';
            item = item + '<input type="text" value="' + price_sale + '" name="price_sale_version[]" class="form-control int price" placeholder="">';
            item = item + '</div>';
            item = item + '</div>';
            item = item + '<div class="mt-3">';
            item = item + '<h2 class="fw-bold" style="font-size: 16px;">Quản lý tồn kho</h2>';
            item = item + '<div class="mt-3">';
            item = item + '<div class="">';
            item = item + '<select class="form-select selectStock" name="_stock_status[]">';
            item = item + '<option value="0" selected>Không quản lý</option>';
            item = item + '<option value="1" >Có quản lý tồn kho</option>';
            item = item + '</select>';
            item = item + '</div>';
            item = item + '</div>';
            item = item + '<div class="showStock d-none">';
            item = item + '<div class="mt-3">';
            item = item + '<label class="form-label">Số lượng trong kho</label>';
            item = item + '<input type="number" name="_stock[]" min="0" class="form-control" placeholder="">';
            item = item + '</div>';
            item = item + '<div class="mt-3">';
            item = item + '<div class="">';
            item = item + '<label class="form-label">Đặt hàng khi đã hết hàng</label>';
            item = item + '<select class="form-select" name="_outstock_status[]">';
            item = item + '<option value="0" selected>Không cho đặt hàng khi hết hàng</option>';
            item = item + '<option value="1" >Đồng ý cho đặt hàng khi đã hết hàng</option>';
            item = item + '</select>';
            item = item + '</div>';
            item = item + '</div>';
            item = item + '</div>';

            item = item + '<div class="mt-3 row">';
            item = item + '<div class="col-md-3">';
            item = item + '<div>';
            item = item + '<label class="form-label text-base font-semibold">Cân nặng(gram)</label>';
            item = item + '<input type="text" value="' + weight + '" name="_ships_weight[]" class="form-control" placeholder="">';
            item = item + '</div>';
            item = item + '</div>';

            item = item + '<div class="col-md-9">';
            item = item + '<div>';
            item = item + '<label class="form-label text-base font-semibold">Kích cỡ(DxRxC)</label>';
            item = item + '<div class="row">';
            item = item + '<div class="col-md-4">';
            item = item + '<input type="text" value="' + length + '" name="_ships_length[]" class="form-control" placeholder="">';
            item = item + '</div>';
            item = item + '<div class="col-md-4">';
            item = item + '<input type="text" value="' + width + '" name="_ships_width[]" class="form-control" placeholder="">';
            item = item + '</div>';
            item = item + '<div class="col-md-4">';
            item = item + '<input type="text" value="' + height + '" name="_ships_height[]" class="form-control" placeholder="">';
            item = item + '</div>';
            item = item + '</div>';
            item = item + '</div>';

            item = item + '</div>';

            item = item + '</div>';

            item = item + '</div>';
            item = item + '</div>';
            item = item + '</div>';
        })
        $('#table_version').append(item);
        $('#table_version').show();

    }
    /*xóa phiên bản sản phẩm */
    $(document).on('click', '.version_remove', function() {
        $(this).parent().parent().remove();
    })
    /*click show chi tiết kích thước trong màu sắc */
    $(document).on('click', '.accordion', function() {
        $(this).parent().parent().find('.version_item_size').toggleClass('d-none');
    })
    $(document).on('change', '.selectStock', function() {
        $value = $(this).val();
        if ($value == 1) {
            $(this).parent().parent().parent().find('.showStock').removeClass('d-none');
        } else {
            $(this).parent().parent().parent().find('.showStock').addClass('d-none');
        }
    })
</script>
<style>
    .dd3-content {
        display: block;
        color: #333;
        text-decoration: none;
        font-weight: bold;
        line-height: 32px;
        border: 1px solid #ccc;
        background: #fafafa;
        background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
        background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
        background: linear-gradient(top, #fafafa 0%, #eee 100%);
        -webkit-border-radius: 3px;
        border-radius: 0;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        position: relative;
    }

    .dd3-content .relative {
        padding-left: 10px;
        height: 45px;
        line-height: 45px;
    }

    .version_remove {
        position: absolute;
        right: 15px;
        top: 50%;
        text-align: center;
        text-indent: 0px;
        transform: translateY(-50%);
    }

    .version_item_size {
        padding: 20px;
        background: #fff;
    }

    #table_version td {
        padding: 5px
    }

    .checkbox-item:disabled {
        cursor: not-allowed;
        background-color: rgb(241, 245, 249, 1);
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 33px;
    }

    .select2-container .select2-selection--single {
        height: 33px;
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/product/backend/product/common/script.blade.php ENDPATH**/ ?>