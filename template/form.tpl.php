<!DOCTYPE HTML>
<html>
<head>
    <title>COACH 2017母亲节</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <!-- uc强制竖屏 -->
    <meta name="screen-orientation" content="landscape">
    <!-- QQ强制竖屏 -->
    <meta name="x5-orientation" content="landscape">

    <!-- <link rel="apple-touch-startup-image" href="/build/assets/img/bg1.png" />
 -->
    <!--禁用手机号码链接(for iPhone)-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui" />
    <!--自适应设备宽度-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--控制全屏时顶部状态栏的外，默认白色-->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="Keywords" content="">
    <meta name="Description" content="...">
    
    <link rel="stylesheet" type="text/css" href="/build/dist/css/main.min.css">
    <script type="text/javascript" src="http://coach.samesamechina.com/api/v1/js/918fce91-ab24-42cd-9ca1-e7a86bd59fc0/wechat"></script>
</head>
<body>

<div class="loading">
    <div class="loading_con">
        <img src="/build/dist/img/logo.png" width="100%">

        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <p>目前涌入的小伙伴过多<br>页面正在跳转中，请耐心等待。</p>
    </div>
</div>

<!-- 横屏代码 -->
<div id="orientLayer" class="mod-orient-layer">
    <div class="mod-orient-layer__content">
        <i class="icon mod-orient-layer__icon-orient"></i>
        <div class="mod-orient-layer__desc">为了更好的体验，请解锁横屏浏览<br><em>建议全程在wifi环境下观看</em></div>
    </div>
</div>

<div id="dreambox">
    <div class="section indexScroll" id="form">
        <div class="bg">
            <img src="/build/dist/img/logo.png" width="100%" class="logo">
            
            
            <div class="pageCon">
                <div class="formNode formSuccess hidden">
                    <div class="applyDesc">
                        <img src="/build/dist/img/form-success.png" width="100%">
                    </div>
                </div>

                <div class="formNode formTable">
                    <div class="formArea">
                        <ul>
                            <li>
                                <input type="text" name="name" placeholder="姓 名">
                            </li>
                            <li>
                                <input type="tel" maxlength="11" name="tel" placeholder="手 机">
                            </li>
                            <li class="selectType">
                                <input type="text" name="shop" placeholder="店 铺" readonly>
                                <select class="choseShop"></select>
                            </li>
                            <li class="selectType">
                                <input type="text" name="date" placeholder="日 期" readonly>
                                <select class="choseDate"></select>
                            </li>
                        </ul>
                    </div>

                    <div class="showFooterArea">
                        <a href="javascript:void(0);" class="btn submit">提交资料</a>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>







<script type="text/javascript" src="/build/dist/js/main.min.js"></script>
<script type="text/javascript">
    var allimg = [
       '/build/dist/img/logo.png',
       '/build/dist/img/form-success.png',
    ];

    pfun.loadingFnDoing(allimg, function(){
        $(".loading").css({"visibility": "hidden"});
        pfun.init();

        _v.sectionChange("form");
        pfun.overscroll(document.querySelector(".indexScroll")); 

    })   

    var formData = {
        "name": "",
        "tel": "",
        "shop": "",
        "date": "",
    }

    $(".submit").on("click", function(){
        var self = $(this);
        if(self.hasClass("disabled")) return false;

        formData = {
            "name": $("input[name=name]").val(),
            "tel": $("input[name=tel]").val(),
            "shop": $("input[name=shop]").val(),
            "date": $("input[name=date]").val(),
        }

        if(!formData["name"]){
            pfun.formErrorTips("姓名不能为空！");
        }else if(!formData["tel"] || !_v.isPhoneNum(formData["tel"])){
            pfun.formErrorTips("手机输入有误！");
        }else if(!formData["shop"]){
            pfun.formErrorTips("请选择预约店铺！");
        }else if(!formData["date"]){
            pfun.formErrorTips("请选择预约日期！");
        }else{
            self.addClass("disabled");
            console.log(formData);

            pfun.ajaxFun("POST", "/api/apply", formData, "json", function(data){
                if(data.status == "1"){
                   $(".formNode").removeClass("hidden");
                   $(".formTable").addClass("hidden");
                }
                pfun.formErrorTips(data.msg);
                self.removeClass("disabled");
            });

        }

    })


    var selectHTMl = {
        "shop": "",
        "date": ""
    }, formlist;

    pfun.ajaxFun("POST", "/api/applylist", "","json", function(data){
        formlist = data;
        selectHTMl['shop'] = $.map(data, function(v, k){ 
            return '<option>'+ k +'</option>';
        }).join("");
        $(".choseShop").html('<option></option>' + selectHTMl['shop']);
    });


    $(".choseDate").change(function(){
        var selectedVal_date = $(this).find('option:selected').val();
        $("input[name=date]").val(selectedVal_date);
    });

    $(".choseShop").change(function(){
        //console.log(formlist);
        selectHTMl['date'] = "<option></option>";

        var selectedVal_shop = $(this).find('option:selected').val();

        $.map(formlist, function(j, k){
            if(k == selectedVal_shop){
                $.map(j, function(a, b){
                    //console.log(a);
                    //console.log(b);
                    $.map(a, function(c, d){
                        //console.log(b + ":" + d + c);
                        selectHTMl['date'] += '<option>'+ (b + ":" + d + (c == 0 ? '预约已满' : c)) +'</option>';
                        //console.log(c);
                        //console.log(d);
                    })
                })
                // console.log(j);
                // console.log(k);
            };
        })

        $("input[name=shop]").val(selectedVal_shop);

        $(".choseDate").empty().html(selectHTMl['date']);
    });

    


</script>

</body>
</html>