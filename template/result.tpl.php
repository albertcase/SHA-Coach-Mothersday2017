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

<?php
    if($list['role']) {
?>
<div class="shareTips hidden"></div>
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
        <div class="mod-orient-layer__desc">为了更好的体验，请竖屏浏览<br><em>建议全程在wifi环境下观看</em></div>
    </div>
</div>

<div id="dreambox">
    <div class="section indexScroll" id="result">
        <div class="bg">
            <div class="createCon">
                <img src="" sourcesrc="/build/dist/img/slogan.png" width="100%">
            
                <div class="createArea">
                    <img src="" sourcesrc="/build/dist/img/m_bg.png" width="100%" class="opacity0">
                    <div class="createArea_con">
                        <div class="createStage">
                            <img src="<?php echo $list['pic']; ?>" width="100%">
                        </div>
                        <div class="createEl">
                            <div class="userInfo ycenter <?php echo !$list['ispraise'] ? '' : 'disabled'; ?>">
                                <span>
                                    <a href="javascript:void(0);" class="dianzan <?php echo !$list['ispraise'] ? '' : 'disabled'; ?>"></a>
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
                    <!-- <a href="javascript:void(0);" class="btn praiseBtn <?php echo !$list['ispraise'] ? '' : 'disabled'; ?>"><img src="/build/dist/img/heart-2.png" width="15%">为她点赞</a> -->
                    <a href="/" class="btn">我也要玩</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>







<script type="text/javascript" src="/build/dist/js/main.min.js"></script>
<script type="text/javascript">
    pfun.init();

    var allimg = [
       '/build/dist/img/logo.png',
    ];

    pfun.loadingFnDoing(allimg, function(){
        shareArr = {
            "_title": 'COACH 2017母亲节', //分享标题
            "_desc": "Coach感恩母亲节，一起花式“晒妈”赢好礼",    // 分享朋友圈的描述
            "_desc_friend": "Coach感恩母亲节，一起花式“晒妈”赢好礼",    // 分享好友的描述
            "_link": window.location.link,    //分享的连接
            "_imgUrl": window.location.origin + "/build/dist/img/share.jpg",   //分享的图片
            "_shareAppMessageCallback": function(){
                _hmt.push(['_trackEvent', 'buttons', 'click', 'result-onMenuShareAppMessage']);
            },
            "_shareTimelineCallback": function(){
                _hmt.push(['_trackEvent', 'buttons', 'click', 'result-onMenuShareTimeline']);
            }
        }
        
        $(".loading").css({"visibility": "hidden"});

        _v.sectionChange("result");
        pfun.overscroll(document.querySelector(".indexScroll")); 

    })   


    $(".shareTips").on("click", function(){
        $(this).addClass("hidden");
    })
    
    $(".shareBtn").on("click", function(){
        $(".shareTips").removeClass("hidden");
    })


    $(".dianzan").on("click", function(){
        var self = $(this);
        // if($(".userInfo").hasClass("disabled")) return false;

        if(self.hasClass("disabled")){
            pfun.formErrorTips("点赞不要贪心哦，每个ID每张只能点赞一次哦");
        }else{
            var praiseNum = $(".userInfo span i").text() * 1;

            self.addClass("disabled");
            pfun.ajaxFun("POST", "/api/praise", {
                'pid': <?php echo $list['pid']; ?>
            }, "json", function(data){
                if(data.status == "1"){
                   $(".userInfo span i").text(praiseNum + 1);
                   $(".userInfo").addClass("disabled")
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