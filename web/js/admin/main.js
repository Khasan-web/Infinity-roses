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
        if($('body').hasClass('sidebar-icons')){
            $('#menu-toggle').hide();
        } else{
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
    if($('#demo-checkbox-radio').length <= 0){
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
    $('#theme-setting > a.btn-theme-setting').click(function(){
        if($('#theme-setting').css('right') < '0'){
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
        $.cookie('style',style);
        $.cookie('color',color);
        $('#theme-change').attr('href', 'css/themes/'+ style + '/' + color + '.css');
    }
    // INITIALIZE THEME FROM COOKIE
    // HAVE TO SET VALUE FOR STYLE&COLOR BEFORE AND AFTER ACTIVE THEME
    if ($.cookie('style')) {
        list_style.find('option').each(function(){
            if($(this).attr('value') == $.cookie('style')) {
                $(this).attr('selected', 'selected');
            }
        });
        list_color.removeClass("active");
        list_color.each(function(){
            if($(this).attr('data-color') == $.cookie('color')){
                $(this).addClass('active');
            }
        });
        setTheme($.cookie('style'), $.cookie('color'));
    };
    // SELECT EVENT
    list_style.on('change', function() {
        list_color.each(function() {
            if($(this).hasClass('active')){
                color_active  = $(this).attr('data-color');
            }
        });
        setTheme($(this).val(), color_active);
    });
    // LI CLICK EVENT
    list_color.on('click', function() {
        list_color.removeClass('active');
        $(this).addClass('active');
        setTheme(list_style.val(), $(this).attr('data-color'));
    });
    // End Change Theme Color
    //END THEME SETTING

    //BEGIN FULL SCREEN
    $('.btn-fullscreen').click(function() {

        if (!document.fullscreenElement &&    // alternative standard method
            !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
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
        if($('#chat-box').is(':visible')){
            $('#chat-form').toggle('slide', {
                direction: 'right'
            }, 500);
            $('#chat-box').hide();
        } else{
            $('#chat-form').toggle('slide', {
                direction: 'right'
            }, 500);
        }
    });
    $('.chat-box-close').click(function(){
        $('#chat-box').hide();
        $('#chat-form .chat-group a').removeClass('active');
    });
    $('.chat-form-close').click(function(){
        $('#chat-form').toggle('slide', {
            direction: 'right'
        }, 500);
        $('#chat-box').hide();
    });

    $('#chat-form .chat-group a').unbind('*').click(function(){
        $('#chat-box').hide();
        $('#chat-form .chat-group a').removeClass('active');
        $(this).addClass('active');
        var strUserName = $('> small', this).text();
        $('.display-name', '#chat-box').html(strUserName);
        var userStatus = $(this).find('span.user-status').attr('class');
        $('#chat-box > .chat-box-header > span.user-status').removeClass().addClass(userStatus);
        var chatBoxStatus = $('span.user-status', '#chat-box');
        var chatBoxStatusShow = $('#chat-box > .chat-box-header > small');
        if(chatBoxStatus.hasClass('is-online')){
            chatBoxStatusShow.html('Online');
        } else if(chatBoxStatus.hasClass('is-offline')){
            chatBoxStatusShow.html('Offline');
        } else if(chatBoxStatus.hasClass('is-busy')){
            chatBoxStatusShow.html('Busy');
        } else if(chatBoxStatus.hasClass('is-idle')){
            chatBoxStatusShow.html('Idle');
        }


        var offset = $(this).offset();
        var h_main = $('#chat-form').height();
        var h_title = $("#chat-box > .chat-box-header").height();
        var top = ($('#chat-box').is(':visible') ? (offset.top - h_title - 40) : (offset.top + h_title - 20));

        if((top + $('#chat-box').height()) > h_main){
            top = h_main - 	$('#chat-box').height();
        }

        $('#chat-box').css({'top': top});

        if(!$('#chat-box').is(':visible')){
            $('#chat-box').toggle('slide',{
                direction: 'right'
            }, 500);
        }
        // FOCUS INPUT TExT WHEN CLICK
        $('ul.chat-box-body').scrollTop(500);
        $("#chat-box .chat-textarea input").focus();
    });
    // Add content to form
    $('.chat-textarea input').on("keypress", function(e){

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
                $element += "<img class='avt' src='"+$my_avt+"'>";
                $element += "<span class='user'>John Doe</span>";
                $element += "<span class='time'>" + h + ":" + m + "</span>";
                $element += "</p>";
                $element = $element + "<p>" + $content +  "</p>";
                $element += "</li>";
                
                $me.append($element);
                var height = 0;
                $me.find('li').each(function(i, value){
                    height += parseInt($(this).height());
                });

                height += '';
                //alert(height);
                $me.scrollTop(height);  // add more 400px for #chat-box position      

                // RANDOM RESPOND CHAT

                var $res = "";
                $res += "<li class='odd'>";
                $res += "<p>";
                $res += "<img class='avt' src='"+$your_avt+"'>";
                $res += "<span class='user'>Swlabs</span>";
                $res += "<span class='time'>" + h + ":" + m + "</span>";
                $res += "</p>";
                $res = $res + "<p>" + "Yep! It's so funny :)" + "</p>";
                $res += "</li>";
                setTimeout(function(){
                    $me.append($res);
                    $me.scrollTop(height+100); // add more 500px for #chat-box position             
                }, 1000);
            }
        }
    });
    // END FORM CHAT

    //BEGIN PORTLET
    $(".portlet").each(function(index, element) {
        var me = $(this);
        $(">.portlet-header>.tools>i", me).click(function(e){
            if($(this).hasClass('fa-chevron-up')){
                $(">.portlet-body", me).slideUp('fast');
                $(this).removeClass('fa-chevron-up').addClass('fa-chevron-down');
            }
            else if($(this).hasClass('fa-chevron-down')){
                $(">.portlet-body", me).slideDown('fast');
                $(this).removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }
            else if($(this).hasClass('fa-cog')){
                //Show modal
            }
            else if($(this).hasClass('fa-refresh')){
                //$(">.portlet-body", me).hide();
                $(">.portlet-body", me).addClass('wait');

                setTimeout(function(){
                    //$(">.portlet-body>div", me).show();
                    $(">.portlet-body", me).removeClass('wait');
                }, 1000);
            }
            else if($(this).hasClass('fa-times')){
                me.remove();
            }
        });
    });
    //END PORTLET

    //BEGIN BACK TO TOP
    $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
    });
    $('#totop').on('click', function(){
        $('html, body').animate({scrollTop:0}, 'fast');
        return false;
    });
    //END BACK TO TOP

    //BEGIN CHECKBOX TABLE
    $('.checkall').on('ifChecked ifUnchecked', function(event) {
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

    $('.option-demo').hover(function() {
        $(this).append("<div class='demo-layout animated fadeInUp'><i class='fa fa-magic mrs'></i>Demo</div>");
    }, function() {
        $('.demo-layout').remove();
    });
    $('#header-topbar-page .demo-layout').live('click', function() {
        var HtmlOption = $(this).parent().detach();
        $('#header-topbar-option-demo').html(HtmlOption).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass('animated flash');
        });
        $('#header-topbar-option-demo').find('.demo-layout').remove();
        return false;
    });
    $('#title-breadcrumb-page .demo-layout').live('click', function() {
        var HtmlOption = $(this).parent().html();
        $('#title-breadcrumb-option-demo').html(HtmlOption).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
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
      
          reader.onload = function(e) {
            // previewContainer.html(previewContainer.html() + '<div class="col-md-1"><img src="' + e.target.result + '" style="width: 100%" alt=""></div>')
            previewContainer.html('<img src="' + e.target.result + '" style="width: 100%"></img>');
            $('.name').html(input.files[0].name);
            $('.size').html(Math.floor(input.files[0].size / 1000) + 'KB');
            var withoutExt = input.files[0].name.split('.').slice(0, -1).join('.');
            $('.color').html(withoutExt);
          }
      
          reader.readAsDataURL(input.files[0]);
        }
      }
      
      $(".uploadImage").change(function() {
        readURL(this);
      });


    //  Show selected images

    $('.uploadGallery').change(function() {
        var files = this.files;
        $('.preview-images').html('');
        readmultifiles(files);
    });

    function readmultifiles(files) {
        var reader = new FileReader();  
        function readFile(index) {
          if( index >= files.length ) return;
          var file = files[index];
          reader.onload = function(e) {
            // get file content  
            var bin = e.target.result,
                splitName = file.name.split('_'),
                name = splitName[0],
                position = splitName[1],
                size;

            if (splitName.length > 2) {
                size = splitName[2].split('.').slice(0, -1).join('.');
            } else {
                size = '';
            }

            position = position == undefined ? '' : 'Pos. №' + position;

            size = size == undefined ? '' : size;

            $('.preview-images').html($('.preview-images').html() + '<div class="col-md-1 col-sm-2"><img src="' + bin + '" style="width: 100%"><p style="margin-top: 5px; margin-bottom: 0">' + name + '</p><p style="margin: 0">' + position + '</p><p style="margin: 0">' + size + '</p></div>');
            // do sth with bin
            readFile(index+1)
          }
        //   reader.readAsBinaryString(file);
          reader.readAsDataURL(file);
        }
        readFile(0);
      }

    // delete image from gallery in db

    $('.gallery').on('click', '.removeImage i', function() {
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

    $('#add-new-size').click(function() {
        var new_size = $(this).parent().find('#size').val(),
            new_width = $(this).parent().find('#width').val(),
            new_height = $(this).parent().find('#height').val(),
            new_price = $(this).parent().find('#price').val(),
            ol = $('.added-sizes'),
            width_height;

        // new_size = new_size.toLowerCase();

        if (new_width && new_height) {
            width_height = " (" + new_height + 'cm H x ' + new_width + 'cm W' + ")";
        } else {
            width_height = '';
        }

        if (new_size && new_price) {
            ol.html(ol.html() + "<li data-arr-id='" + added_sizes.length + "'><i class='fa fa-times remove-new' style='margin: 5px'></i>" + new_size + width_height + " | " + new_price + " sum</li>");
            if (width_height) {
                new_size_arr = {
                    size: new_size,
                    width: new_width,
                    height: new_height,
                    price: new_price
                };
            } else {
                new_size_arr = {
                    size: new_size,
                    price: new_price
                };
            }
            added_sizes.push(new_size_arr);
        }
        $(this).parent().find('input').val('');
        return false;
    });

    $('.added-sizes').on('click', '.remove-new', function() {
        var size = $(this).parent(),
            itemToRemove = size.data('arr-id');
        added_sizes.splice($.inArray(size, added_sizes),1);
        size.remove();
    });

    $('.save-product').click(function() {
        var id = $(this).data('product-id');
        if (window.location.href.indexOf('create') > -1) {
            $.ajax({
                url: '/' + ru + 'admin/product/create',
                data: {
                    sizes: added_sizes
                },
                type: 'GET',
                success: function(res) {
                    if (!res) alert('Sorry, Error in respond. Please try again');
                    console.log(res);
                }
            });
        }
        
        if (window.location.href.indexOf('update') > -1) {
            $.ajax({
                url: '/' + ru + 'admin/product/update',
                data: {
                    sizes: added_sizes,
                    id: id,
                },
                type: 'GET',
                success: function(res) {
                    if (!res) alert('Sorry, Error in respond. Please try again');
    
                }
            });
        }
    });


    // remove a size

    $('.product-form').on('click', '.remove-size', function(){
        if (confirm('Delete this size?')) {
            var id = $(this).parent().data('id'),
            product_id = $('.added-sizes').data('page-id');
            $.ajax({
                url: '/' + ru + 'admin/product/remove-size',
                data: {
                    id: id,
                    product_id: product_id,
                },
                type: 'GET',
                success: function(res) {
                    $('.added-sizes').html(res);
                }
            });
        }
    });

});