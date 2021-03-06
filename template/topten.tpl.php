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
    <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?0a492afa4b02e5a592b9f6ce2ba9c3da";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>
<div class="pageQrcode"></div>
<script type="text/javascript">
    function isPC(){  
       var userAgentInfo = navigator.userAgent;  
       var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod");  
       var flag = true;  
       for (var v = 0; v < Agents.length; v++) {  
           if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }  
       }  
       return flag;  
    } 


    if(!isPC()){
        document.querySelector('.pageQrcode').className = "pageQrcode hidden";
    }else{
        document.querySelector('.pageQrcode').className = "pageQrcode ispc";
    }

    window.onresize = function(){
        if(!isPC()){
            document.querySelector('.pageQrcode').className = "pageQrcode hidden";
        }else{
            document.querySelector('.pageQrcode').className = "pageQrcode ispc";
        }
    }
</script>

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
        <div class="mod-orient-layer__desc">为了更好的体验，请竖屏浏览<br><em>建议全程在wifi环境下观看</em></div>
    </div>
</div>

<div id="dreambox">
    <div class="section indexScroll" id="topten">
        <div class="bg">
            <div class="head">
                <a href="/" class="back">返回首页</a>
            </div>
            <div class="createCon">
                <img src="/build/dist/img/topten_slogan.png" width="100%">
            
                <ul class="photolist">
                <?php
                    if($list) {
                        foreach ($list as $k => $v) {
                ?>
                    <li>
                        <div class="createStage">
                            <img src="<?php echo $v['pic'];?>" width="100%">
                        </div>
                        <div class="createEl">
                            <div class="userInfo ycenter disabled">
                                <span>
                                    <a href="javascript:void(0);" data-pid="<?php echo $v['id']; ?>" class="dianzan"></a>
                                    <em><?php echo !empty($v['nickname']) ? $v['nickname'] : 'coach';?></em>
                                    <i><?php echo $v['favorite'];?></i>
                                </span>
                            </div>
                        </div>
                    </li>
                <?php
                        }
                    } else {
                ?>
                    <p class="noData">暂无数据</p>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>







<script type="text/javascript" src="/build/dist/js/main.min.js"></script>
<script type="text/javascript">
    pfun.init();
    
    var allimg = [
       '/build/dist/img/logo.png',
       '/build/dist/img/place.png',
    ];

    pfun.loadingFnDoing(allimg, function(){
        $(".loading").css({"visibility": "hidden"});
        
        _v.sectionChange("topten");
        pfun.overscroll(document.querySelector(".indexScroll")); 

    })   

    $(".dianzan").on("click", function(){
        var self = $(this);
        if(self.hasClass("disabled")){
            pfun.formErrorTips("点赞不要贪心哦，每个ID每张只能点赞一次哦");
        }else{
            var praiseId = self.attr("data-pid");
            var praiseNum = self.siblings("i").text() * 1;
            pfun.ajaxFun("POST", "/api/praise", {
                'pid': praiseId
            }, "json", function(data){
                if(data.status == "1"){
                   self.siblings("i").text(praiseNum + 1);
                   self.addClass("disabled")
                }else{
                    self.removeClass("disabled");
                }
                pfun.formErrorTips(data.msg);
            });
        }
        
    })
    
        



</script>

</body>
</html>