var ru;
if (window.location.href.indexOf("ru") > -1) {
    ru = 'ru/';
} else {
    ru = '';
}

$(function () {

    //BEGIN MENU SIDEBAR
    $('#sidebar').css('min-height', '100%');
    $('#side-menu').metisMenu();

    $(window).bind("load resize", function () {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
            $('div.sidebar-collapse').css('height', 'auto');
        }
        if ($('body').hasClass('sidebar-icons')) {
            $('#menu-toggle').hide();
        } else {
            $('#menu-toggle').show();
        }
    });
    //END MENU SIDEBAR

    //BEGIN TOPBAR DROPDOWN
    $('.dropdown-slimscroll').slimScroll({
        "height": '250px',
        "wheelStep": 5
    });
    //END TOPBAR DROPDOWN

    //BEGIN CHECKBOX & RADIO
    if ($('#demo-checkbox-radio').length <= 0) {
        $('input[type="checkbox"]:not(".switch")').iCheck({
            checkboxClass: 'icheckbox_minimal-grey',
            increaseArea: '20%' // optional
        });
        $('input[type="radio"]:not(".switch")').iCheck({
            radioClass: 'iradio_minimal-grey',
            increaseArea: '20%' // optional
        });
    }
    //END CHECKBOX & RADIO

    // //BEGIN TOOTLIP
    // $("[data-toggle='tooltip'], [data-hover='tooltip']").tooltip();
    // //END TOOLTIP

    // //BEGIN POPOVER
    // $("[data-toggle='popover'], [data-hover='popover']").popover();
    // //END POPOVER

    //BEGIN THEME SETTING
    $('#theme-setting > a.btn-theme-setting').click(function () {
        if ($('#theme-setting').css('right') < '0') {
            $('#theme-setting').css('right', '0');
        } else {
            $('#theme-setting').css('right', '-250px');
        }
    });

    // Begin Change Theme Color
    var list_style = $('#theme-setting > .content-theme-setting > select#list-style');
    var list_color = $('#theme-setting > .content-theme-setting > ul#list-color > li');
    // FUNCTION CHANGE URL STYLE ON HEAD TAG
    var setTheme = function (style, color) {
        $.cookie('style', style);
        $.cookie('color', color);
        $('#theme-change').attr('href', 'css/themes/' + style + '/' + color + '.css');
    }
    // INITIALIZE THEME FROM COOKIE
    // HAVE TO SET VALUE FOR STYLE&COLOR BEFORE AND AFTER ACTIVE THEME
    if ($.cookie('style')) {
        list_style.find('option').each(function () {
            if ($(this).attr('value') == $.cookie('style')) {
                $(this).attr('selected', 'selected');
            }
        });
        list_color.removeClass("active");
        list_color.each(function () {
            if ($(this).attr('data-color') == $.cookie('color')) {
                $(this).addClass('active');
            }
        });
        setTheme($.cookie('style'), $.cookie('color'));
    };
    // SELECT EVENT
    list_style.on('change', function () {
        list_color.each(function () {
            if ($(this).hasClass('active')) {
                color_active = $(this).attr('data-color');
            }
        });
        setTheme($(this).val(), color_active);
    });
    // LI CLICK EVENT
    list_color.on('click', function () {
        list_color.removeClass('active');
        $(this).addClass('active');
        setTheme(list_style.val(), $(this).attr('data-color'));
    });
    // End Change Theme Color
    //END THEME SETTING

    //BEGIN FULL SCREEN
    $('.btn-fullscreen').click(function () {

        if (!document.fullscreenElement && // alternative standard method
            !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) { // current working methods
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    });
    //END FULL SCREEN

    // BEGIN FORM CHAT
    $('.btn-chat').click(function () {
        if ($('#chat-box').is(':visible')) {
            $('#chat-form').toggle('slide', {
                direction: 'right'
            }, 500);
            $('#chat-box').hide();
        } else {
            $('#chat-form').toggle('slide', {
                direction: 'right'
            }, 500);
        }
    });
    $('.chat-box-close').click(function () {
        $('#chat-box').hide();
        $('#chat-form .chat-group a').removeClass('active');
    });
    $('.chat-form-close').click(function () {
        $('#chat-form').toggle('slide', {
            direction: 'right'
        }, 500);
        $('#chat-box').hide();
    });

    $('#chat-form .chat-group a').unbind('*').click(function () {
        $('#chat-box').hide();
        $('#chat-form .chat-group a').removeClass('active');
        $(this).addClass('active');
        var strUserName = $('> small', this).text();
        $('.display-name', '#chat-box').html(strUserName);
        var userStatus = $(this).find('span.user-status').attr('class');
        $('#chat-box > .chat-box-header > span.user-status').removeClass().addClass(userStatus);
        var chatBoxStatus = $('span.user-status', '#chat-box');
        var chatBoxStatusShow = $('#chat-box > .chat-box-header > small');
        if (chatBoxStatus.hasClass('is-online')) {
            chatBoxStatusShow.html('Online');
        } else if (chatBoxStatus.hasClass('is-offline')) {
            chatBoxStatusShow.html('Offline');
        } else if (chatBoxStatus.hasClass('is-busy')) {
            chatBoxStatusShow.html('Busy');
        } else if (chatBoxStatus.hasClass('is-idle')) {
            chatBoxStatusShow.html('Idle');
        }


        var offset = $(this).offset();
        var h_main = $('#chat-form').height();
        var h_title = $("#chat-box > .chat-box-header").height();
        var top = ($('#chat-box').is(':visible') ? (offset.top - h_title - 40) : (offset.top + h_title - 20));

        if ((top + $('#chat-box').height()) > h_main) {
            top = h_main - $('#chat-box').height();
        }

        $('#chat-box').css({
            'top': top
        });

        if (!$('#chat-box').is(':visible')) {
            $('#chat-box').toggle('slide', {
                direction: 'right'
            }, 500);
        }
        // FOCUS INPUT TExT WHEN CLICK
        $('ul.chat-box-body').scrollTop(500);
        $("#chat-box .chat-textarea input").focus();
    });
    // Add content to form
    $('.chat-textarea input').on("keypress", function (e) {

        var $obj = $(this);
        var $me = $obj.parent().parent().find('ul.chat-box-body');
        var $my_avt = 'https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg';
        var $your_avt = 'https://s3.amazonaws.com/uifaces/faces/twitter/alagoon/48.jpg';
        if (e.which == 13) {
            var $content = $obj.val();

            if ($content !== "") {
                var d = new Date();
                var h = d.getHours();
                var m = d.getMinutes();
                if (m < 10) m = "0" + m;
                $obj.val(""); // CLEAR TEXT ON TEXTAREA

                var $element = "";
                $element += "<li>";
                $element += "<p>";
                $element += "<img class='avt' src='" + $my_avt + "'>";
                $element += "<span class='user'>John Doe</span>";
                $element += "<span class='time'>" + h + ":" + m + "</span>";
                $element += "</p>";
                $element = $element + "<p>" + $content + "</p>";
                $element += "</li>";

                $me.append($element);
                var height = 0;
                $me.find('li').each(function (i, value) {
                    height += parseInt($(this).height());
                });

                height += '';
                //alert(height);
                $me.scrollTop(height); // add more 400px for #chat-box position      

                // RANDOM RESPOND CHAT

                var $res = "";
                $res += "<li class='odd'>";
                $res += "<p>";
                $res += "<img class='avt' src='" + $your_avt + "'>";
                $res += "<span class='user'>Swlabs</span>";
                $res += "<span class='time'>" + h + ":" + m + "</span>";
                $res += "</p>";
                $res = $res + "<p>" + "Yep! It's so funny :)" + "</p>";
                $res += "</li>";
                setTimeout(function () {
                    $me.append($res);
                    $me.scrollTop(height + 100); // add more 500px for #chat-box position             
                }, 1000);
            }
        }
    });
    // END FORM CHAT

    //BEGIN PORTLET
    $(".portlet").each(function (index, element) {
        var me = $(this);
        $(">.portlet-header>.tools>i", me).click(function (e) {
            if ($(this).hasClass('fa-chevron-up')) {
                $(">.portlet-body", me).slideUp('fast');
                $(this).removeClass('fa-chevron-up').addClass('fa-chevron-down');
            } else if ($(this).hasClass('fa-chevron-down')) {
                $(">.portlet-body", me).slideDown('fast');
                $(this).removeClass('fa-chevron-down').addClass('fa-chevron-up');
            } else if ($(this).hasClass('fa-cog')) {
                //Show modal
            } else if ($(this).hasClass('fa-refresh')) {
                //$(">.portlet-body", me).hide();
                $(">.portlet-body", me).addClass('wait');

                setTimeout(function () {
                    //$(">.portlet-body>div", me).show();
                    $(">.portlet-body", me).removeClass('wait');
                }, 1000);
            } else if ($(this).hasClass('fa-times')) {
                me.remove();
            }
        });
    });
    //END PORTLET

    //BEGIN BACK TO TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() < 200) {
            $('#totop').fadeOut();
        } else {
            $('#totop').fadeIn();
        }
    });
    $('#totop').on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 'fast');
        return false;
    });
    //END BACK TO TOP

    //BEGIN CHECKBOX TABLE
    $('.checkall').on('ifChecked ifUnchecked', function (event) {
        if (event.type == 'ifChecked') {
            $(this).closest('table').find('input[type=checkbox]').iCheck('check');
        } else {
            $(this).closest('table').find('input[type=checkbox]').iCheck('uncheck');
        }
    });
    //END CHECKBOX TABLE

    //BEGIN JQUERY NEWS UPDATE
    // $('#news-update').ticker({
    //     controls: false,
    //     titleText: ''
    // });
    //END JQUERY NEWS UPDATE

    $('.option-demo').hover(function () {
        $(this).append("<div class='demo-layout animated fadeInUp'><i class='fa fa-magic mrs'></i>Demo</div>");
    }, function () {
        $('.demo-layout').remove();
    });
    $('#header-topbar-page .demo-layout').live('click', function () {
        var HtmlOption = $(this).parent().detach();
        $('#header-topbar-option-demo').html(HtmlOption).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass('animated flash');
        });
        $('#header-topbar-option-demo').find('.demo-layout').remove();
        return false;
    });
    $('#title-breadcrumb-page .demo-layout').live('click', function () {
        var HtmlOption = $(this).parent().html();
        $('#title-breadcrumb-option-demo').html(HtmlOption).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass('animated flash');
        });
        $('#title-breadcrumb-option-demo').find('.demo-layout').remove();
        return false;
    });
    // CALL FUNCTION RESPONSIVE TABS
    // fakewaffle.responsiveTabs(['xs', 'sm']);


    // Show main image and its data

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader(),
                previewContainer = $('.preview-image');

            reader.onload = function (e) {
                // previewContainer.html(previewContainer.html() + '<div class="col-md-1"><img src="' + e.target.result + '" style="width: 100%" alt=""></div>')
                previewContainer.html('<img src="' + e.target.result + '" style="width: 100%"></img>');
                $('.name').html(input.files[0].name);
                $('.mainImg-size').html(Math.floor(input.files[0].size / 1000) + 'KB');
                var withoutExt = input.files[0].name.split('.').slice(0, -1).join('.');
                $('.color').html(withoutExt);

                // add to the name of the main image first size
                var imgWithSize = withoutExt + '_' + $('.size-toggle').first().data('size');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".uploadImage").change(function () {
        readURL(this);
    });


    //  Show selected images

    $('.uploadGallery').change(function () {
        var files = this.files;
        $('.preview-images').html('');
        readmultifiles(files);
    });

    function readmultifiles(files) {
        var reader = new FileReader();
        if ($('#product-image').val() && !$('#product-size_list').val()) {
            // nothing
        } else {
            $('#product-size_list').val('');
            colors_data = [];
        }

        function readFile(index) {
            if (index >= files.length) return;
            var file = files[index];
            reader.onload = function (e) {

                // get file path  
                var bin = e.target.result;
                // work with a size and a position
                $('#product-size_list').val(' ');
                var size = $('.btn-sizes .btn-warning').first().data('size'),
                    position = $('.btn-positions .btn-warning').first().data('position');

                // if size is undefined, it can be because of active All button - So we just choose first size
                size = size == undefined ? $('.btn-sizes .btn').first().data('size') : size;
                size_html = size == undefined ? '' : size;

                // make sure that everything exists
                if (position != 'closed' && position != 'vase') {
                    position_html = position == undefined ? '' : 'Pos. №' + position;
                    // add to preview and add data info [size, position, index]
                    if ($('.product-form').length) {
                        $('.preview-images').html($('.preview-images').html() + '<div class="col-md-1 col-sm-2" data-index="' + ($('.preview-images div').length) + '" data-size="' + size + '" data-position="' + position + '"><img src="' + bin + '" style="width: 100%"><button class="btn btn-warning btn-sm img-color">COLOR</button><p style="margin: 0">' + position_html + '</p><p style="margin: 0">' + size_html + '</p></div>');
                    } else {
                        // if the upload system is used from another section, like gallery and so on
                        $('.preview-images').html($('.preview-images').html() + '<div class="col-md-1 col-sm-2"><img src="' + bin + '" style="width: 100%"><p style="margin: 0">' + position_html + '</p><p style="margin: 0">' + size_html + '</p></div>');
                    }
                } else if (position == 'closed') {
                    position_html = position;
                    $('.preview-images').html($('.preview-images').html() + '<div class="col-md-1 col-sm-2" data-index="' + ($('.preview-images div').length) + '" data-size="' + size + '" data-position="' + position + '"><img src="' + bin + '" style="width: 100%"><p style="margin: 0">' + position_html + '</p><p style="margin: 0">' + size_html + '</p></div>');
                    // Set data abt closed img in the input with all data
                    var dataStr = '_' + position + '_' + size;
                    // push into colors_data array
                    colors_data[($('.preview-images div').length)] = dataStr;
                } else if (position == 'vase') {
                    position_html = position;
                    $('.preview-images').html($('.preview-images').html() + '<div class="col-md-1 col-sm-2" data-index="' + ($('.preview-images div').length) + '" data-size="' + size + '" data-position="' + position + '"><img src="' + bin + '" style="width: 100%"><p style="margin: 0">' + position_html + '</p></div>');
                    // Set data abt vase img in the input with all data
                    var dataStr = position;
                    // push into colors_data array
                    colors_data[($('.preview-images div').length)] = dataStr;
                }

                // do smth with bin
                readFile(index + 1)
            }
            reader.readAsDataURL(file);
        }
        readFile(0);
    }

    // Select image color
    // current image for which we need to select a color
    var currentImg,
        mainImageSelecting = false;
    $('.product-form').on('click', '.img-color', function () {
        // set current image
        currentImg = '';
        currentImg = $(this).parent();

        // open modal
        $('#img-color').modal('show');

        // prevent default behaviour
        return false;
    });

    $('.product-form').on('click', '.main-img-color', function () {
        // make modal knows that user is selecting color for main image
        mainImageSelecting = true;

        // open modal
        $('#img-color').modal('show');

        // prevent default behaviour
        return false;
    });


    // selected colors array
    colors_data = [];

    // Accept a color
    $('.accept-color').click(function () {
        // save selected color
        var color = $('#img-color input[type="radio"]:checked');
        if (color.val() == undefined) {
            return false;
        }
        // check does selected color for a main image or not
        if (mainImageSelecting) {
            var dataStr = color.val() + '_' + color.data('value-ru') + '_' + $('.main-image').data('position') + '_' + $('.main-image').data('size');
            $('#product-size_main').val(dataStr);
            mainImageSelecting = false;
            
            // set new style and color name in the color button
            var modalColorBtn = $('.main-img-color');
            modalColorBtn.text(color.val().toUpperCase());
            modalColorBtn.removeClass('btn-warning');
            modalColorBtn.addClass('btn-default');
        } else {
            var dataStr = color.val() + '_' + color.data('value-ru') + '_' + currentImg.data('position') + '_' + currentImg.data('size');
    
            // set new style and color name in the color button
            var modalColorBtn = currentImg.find('.img-color');
            modalColorBtn.text(color.val().toUpperCase());
            modalColorBtn.removeClass('btn-warning');
            modalColorBtn.addClass('btn-default');

            // push into colors_data array and after clicking on .save-product btn, it automatically will write it in product-size_list input
            colors_data[currentImg.data('index')] = dataStr;
        }

        // hide the modal
        $('#img-color').modal('toggle');

        // clear checked radio
        $('#img-color input[type="radio"]:checked').prop('checked', false);

    });



    // delete image from gallery in db

    $('.gallery').on('click', '.removeImage i', function () {
        var alias = $(this).parent().data('image'),
            id = $('.product-form').data('id'),
            clickedIcon = $(this);
        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: '/' + ru + 'admin/product/remove-image',
                data: {
                    id: id,
                    alias: alias,
                },
                type: 'GET',
                success: function (res) {
                    if (!res) alert('Error in getting the data');
                    var columnToRemove = clickedIcon.closest('.col-md-1');
                    columnToRemove.remove();
                },
                error: function () {
                    alert('Error in sending the request');
                }
            });
        }
    });


    // add a new size

    added_sizes = [];

    $('#add-new-size').click(function () {
        var new_size = $(this).parent().find('#size').val(),
            size_ru = $('#size_ru').val(),
            new_width = $(this).parent().find('#width').val(),
            new_height = $(this).parent().find('#height').val(),
            new_price = $(this).parent().find('#price').val(),
            ol = $('.added-sizes'),
            width_height = '',
            size_type = '',
            size_type_ru = '';

        // if size_ru input is empty its value will be size input
        size_ru = size_ru ? size_ru : new_size;

        // Add all other symbols like H and W
        if (new_width && new_height) {
            width_height = " (" + new_height + 'cm H x ' + new_width + 'cm W' + ")";
        } else {
            width_height = '';
        }
        // Add the selected type [Roses, Stems, personal type]
        if ($('#size_type').val()) {
            if ($('#size_type').val() == 'Roses') {
                if (new_size == 1) {
                    size_type = 'Rose';
                } else {
                    size_type = $('#size_type').val();
                }
                if (new_size % 10 == 1) {
                    size_type_ru = 'Роза';
                } else if (new_size % 10 != 1 && new_size % 10 <= 4) {
                    if (new_size > 20) {
                        size_type_ru = 'Розы';
                    } else {
                        size_type_ru = 'Роз';
                    }
                } else {
                    size_type_ru = 'Роз';
                }
            } else if ($('#size_type').val() == 'Stems') {
                if (new_size == 1) {
                    size_type = 'Stem';
                } else {
                    size_type = $('#size_type').val();
                }
                if (new_size % 10 == 1) {
                    size_type_ru = 'Стебель';
                } else if (new_size % 10 != 1 && new_size % 10 <= 4) {
                    if (new_size > 20) {
                        size_type_ru = 'Стебля';
                    } else {
                        size_type_ru = 'Стеблей';
                    }
                } else {
                    size_type_ru = 'Стеблей';
                }
            }
        }

        // Add to view
        if (new_size && new_price) {
            $.trim(new_size);
            if (size_ru && !$('#size_type').val()) {
                show_size_ru = ' | ' + size_ru;
                ol.html(ol.html() + "<li data-arr-id='" + added_sizes.length + "'><i class='fa fa-times remove-new' style='margin: 5px'></i>" + new_size + ' | ' + size_ru + ' ' + size_type + width_height + " | " + new_price + " sum</li>");
            } else {
                show_size_ru = '';
                ol.html(ol.html() + "<li data-arr-id='" + added_sizes.length + "'><i class='fa fa-times remove-new' style='margin: 5px'></i>" + new_size + ' ' + size_type + width_height + " | " + new_price + " sum</li>");
            }
            if (width_height) {
                new_size_arr = {
                    size: new_size + ' ' + size_type,
                    size_ru: size_ru + ' ' + size_type_ru,
                    width: new_width,
                    height: new_height,
                    price: new_price
                };
            } else {
                new_size_arr = {
                    size: new_size,
                    size_ru: size_ru + ' ' + size_type_ru,
                    price: new_price
                };
            }
            added_sizes.push(new_size_arr);
        }
        // clear inputs
        $(this).parent().find('input').val('');
        return false;
    });

    $('#size_type').change(function () {
        if (!$(this).val()) {
            $('#size_ru').show();
        } else {
            $('#size_ru').hide();
        }
    });

    $('.added-sizes').on('click', '.remove-new', function () {
        var size = $(this).parent(),
            itemToRemove = size.data('arr-id');
        added_sizes.splice($.inArray(size, added_sizes), 1);
        size.remove();
    });

    $('.product-form .save-product').click(function () {
        var id = $('.product-form').data('id');
        if (added_sizes != []) {
            $.ajax({
                url: '/' + ru + 'admin/product/add-sizes',
                data: {
                    id: id,
                    sizes: added_sizes,
                },
                type: 'GET',
                success: function (res) {
                    if (!res) alert('Please add sizes');
                    return false;
                }
            });
        }

        // paste new checked products into non_available input with their id
        // clear input
        $('#product-not_available').val('');
        // check all checkboxes
        $('.not-available-check').each(function (i) {
            if ($(this).prop("checked") == true) {
                // paste new id and detect are they non available by adding prefix _0 or _1
                $('#product-not_available').val(!$('#product-not_available').val() ? $('#product-not_available').val() + $(this).data('id') + '_' + '0' : $('#product-not_available').val() + ',' + $(this).data('id') + '_' + '0');
            } else {
                $('#product-not_available').val(!$('#product-not_available').val() ? $('#product-not_available').val() + $(this).data('id') + '_' + '1' : $('#product-not_available').val() + ',' + $(this).data('id') + '_' + '1');
            }
        });

        // add list of selected colors and additional info like position and size
        var colors_info_inp = $('#product-size_list');
        colors_info_inp.val('');
        colors_data.forEach(color => {
            if (colors_info_inp.val()) {
                colors_info_inp.val(colors_info_inp.val() + ',' + color);
            } else {
                colors_info_inp.val(color);
            }
        });
        // end adding
    });


    // remove a size

    $('.product-form').on('click', '.remove-size', function () {
        if (confirm('Permanently remove this size?')) {
            var id = $(this).parent().data('id'),
                product_id = $('.added-sizes').data('page-id');
            $.ajax({
                url: '/' + ru + 'admin/product/remove-size',
                data: {
                    id: id,
                    product_id: product_id,
                },
                type: 'GET',
                success: function (res) {
                    $('.added-sizes').html(res);
                }
            });
        }
    });


    // MAP

    if ($('.address').length) {
        // get COORDS
        var coords = $('.address').data('coords').split(',');

        // create a map and marker variable
        var mymap = L.map('map').setView([coords[0], coords[1]], 18),
            marker;

        // set red icon
        var LeafIcon = L.Icon.extend({
            options: {
                shadowUrl: '',
                iconSize: [49, 64],
                shadowSize: [50, 64],
                iconAnchor: [24, 64],
                shadowAnchor: [4, 62],
                popupAnchor: [-3, -76]
            }
        });
        var redIcon = new LeafIcon({
            iconUrl: '/web/img/placeholder.svg'
        });
        marker = L.marker([coords[0], coords[1]], {
            icon: redIcon
        }).addTo(mymap);

        // set tile
        var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        OpenStreetMap_Mapnik.addTo(mymap);

    }

    // MAP END



    // SIZE TOGGLE

    function showImgesBySize(size) {
        $('.product-form .gallery .size').hide(0);
        $('.product-form .gallery .size').each(function (i) {
            if ($(this).data('size') == size) {
                $(this).show(0);
            }
        });
    }

    // get first size
    var first = $('.product-form .size-toggle').first();

    // Show products appropriate for first size
    showImgesBySize(first.data('size'));

    $('.product-form').on('click', '.size-toggle', function () {
        // remove active class "btn-warning" from all buttons and then give it to clicked one
        $('.btn-sizes .btn').removeClass('btn-warning');
        $('.btn-sizes .btn').addClass('btn-default');
        $(this).addClass('btn-warning');

        // show images of selected size
        showImgesBySize($(this).data('size'));

        // prevent default behaviour
        return false;
    });

    $('.show-all').click(function () {
        $('.btn-sizes .size-toggle').removeClass('btn-warning');
        $('.btn-sizes .size-toggle').addClass('btn-default');
        $(this).addClass('btn-warning');
        $('.gallery .size').each(function (i) {
            $(this).show(0);
        });
        // prevent default behaviour
        return false;
    });

    $(document).click(function(){
        $('.btn-sizes .gallery .size').each(function (i) {
            $(this).show(0);
        });
    });

    // SIZE TOGGLE END





    // POSITION TOGGLE

    $('.field-product-gallery label').html('<i class="fa fa-upload"></i> Upload images, position - ' + $('.btn-positions .btn-warning').data('position'));

    $('.product-form').on('click', '.position-toggle', function () {
        // remove active class "btn-warning" from all buttons and then give it to clicked one
        $('.product-form .position-toggle').removeClass('btn-warning');
        $('.product-form .position-toggle').addClass('btn-default');
        $(this).addClass('btn-warning');

        // Change the label of uploading btn to avoid all confuses
        $('.field-product-gallery label').html('<i class="fa fa-upload"></i> Upload images, position - ' + $(this).data('position'));

        // prevent default behaviour
        return false;
    });

    // POSITION TOGGLE END

    // VASE TOGGLE

    // check does the product have a vase
    function vaseCheck() {
        if ($('#product-vase').val()) {
            $('.vase-toggle').show();
        } else {
            $('.vase-toggle').hide();
        }   
    }

    vaseCheck();

    // make checking on every change of the vase pricing input
    $('#product-vase').keyup(function() {
        vaseCheck();
        $('#product-gallery').val('');
        $('.preview-images').html('');
    });

    // VASE TOGGLE END





    // NOT AVAILABLE

    $('.product-form').on('click', '.btn-not_available', function () {
        $('.btn-not_available').toggleClass('active');

        // check does the "non available" selecting is activated
        if ($('.btn-not_available').hasClass('active')) {
            // show checkboxes
            $('.checkbox-none').show();

            // make a toggle "non available" button danger color to show its activating
            $('.btn-not_available').removeClass('btn-default');
            $('.btn-not_available').addClass('btn-danger');
        } else {
            // show checkboxes
            $('.checkbox-none').hide();

            // make a toggle "non available" button default color to hide its activating
            $('.btn-not_available').removeClass('btn-danger');
            $('.btn-not_available').addClass('btn-default');
        }

        return false;
    });

    // NOT AVAILABLE END


    // REMOVE ALL IMAGES

    $('.btn-remove_all').click(function() {
        var id = $('.product-form').data('id');
        if (confirm('All images will be permanently deleted')) {
            $.ajax({
                url: '/' + ru + 'admin/product/remove-all',
                type: 'GET',
                data: {id: id},
                success: function(res) {
                    if (!res) {
                        return false
                    } else {
                        // remove all preview images from gallery
                        $('.gallery .size').remove();

                        // clear src of main image
                        $('.product-form .preview-image img').attr('src', '');
                        
                        // make button to choose the main image color active
                        $('.main-img-color').removeClass('btn-default');
                        $('.main-img-color').addClass('btn-warning');
                        $('.main-img-color').val('COLOR');
                    };
                },
                error: function(xml) {
                    console.log(xml);
                }
            });
        } 

        return false;
    });

    // END REMOVE ALL IMAGES

});