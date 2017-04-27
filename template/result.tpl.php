<?php
    print_r($list);  // exit;
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Coach 母亲节</title>
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
</head>
<body>

<?php
    if($list['role']) {
?>
<div class="shareTips"></div>
<?php
    }
?>

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
    <div class="section indexScroll" id="result">
        <div class="bg">
            <div class="createCon">
                <img src="/build/dist/img/slogan.png" width="100%">
            
                <div class="createArea">
                    <img src="/build/dist/img/m_bg.png" width="100%" class="opacity0">
                    <div class="createArea_con">
                        <div class="createStage">
                            <img src="<?php echo $list['pic']; ?>" width="100%">
                        </div>
                        <div class="createEl">
                            <div class="userInfo ycenter <?php echo !$list['ispraise'] ? '' : 'disabled'; ?>">
                                <span>
                                    <em><?php echo !empty($list['name']) ? $list['name'] : 'coach'; ?></em>
                                    <i><?php echo $list['num']; ?></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="showFooterArea">
                    <?php
                        if($list['role']) {
                    ?>
                    <a href="javascript:void(0);" class="btn shareBtn">分享</a>
                    <?php
                        } else {
                    ?>
                    <a href="javascript:void(0);" class="btn praiseBtn <?php echo !$list['ispraise'] ? '' : 'disabled'; ?>"><img src="/build/dist/img/heart-2.png" width="15%">为她点赞</a>
                    <a href="/" class="btn">我也要玩</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>







<script type="text/javascript" src="/build/dist/js/main.min.js"></script>
<script type="text/javascript">
    var allimg = [
       '/build/dist/img/logo.png',
    ];

    pfun.loadingFnDoing(allimg, function(){
        $(".loading").css({"visibility": "hidden"});
        // pfun.init();

        _v.sectionChange("result");
        pfun.overscroll(document.querySelector(".indexScroll")); 

    })   


    $(".shareTips").on("click", function(){
        $(this).addClass("hidden");
    })
    
    $(".shareBtn").on("click", function(){
        $(".shareTips").removeClass("hidden");
    })


    $(".praiseBtn").on("click", function(){
        var self = $(this);
        if(self.hasClass("disabled") || $(".userInfo").hasClass("disabled")) return false;

        var praiseNum = $(".userInfo span i").text() * 1;

        self.addClass("disabled");
        pfun.ajaxFun("POST", "/api/praise", {
            'pid': <?php echo $list['pid']; ?>
        }, "json", function(data){
            if(data.status == "1"){
               $(".userInfo span i").text(praiseNum + 1);
               $(".userInfo").addClass("disabled")
            }
            pfun.formErrorTips(data.msg);
            self.removeClass("disabled");
        });
    })
    



</script>

</body>
</html>