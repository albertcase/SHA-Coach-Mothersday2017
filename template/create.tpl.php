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
    <div class="section indexScroll" id="create">
        <div class="bg">
            <div class="createCon">
                <img src="" sourcesrc="/build/dist/img/slogan.png" class="aaa" width="100%">
            
                <div class="createArea">
                    <img src="" sourcesrc="/build/dist/img/m_bg.png" width="100%" class="opacity0">
                    <div class="createArea_con">
                        <div class="createStage">
                            <div class="uploadTips">
                                <input type="file" />
                            </div>
                            <div class="canvasArea">
                                <div class="eleNode hidden"></div>
                                <div class="canvasNode casACon">
                                </div>
                                <div class="canvasNode createACon"></div>
                                <!-- <canvas id="myCanvas" width="100%" height="100%"></canvas> -->
                                <!-- <img src="/build/dist/img/m_bg.png" width="100%"> -->
                            </div>
                        </div>

                        <div class="createEl hidden">
                            <ul>
                                <li>
                                    <span>
                                        <img src="" sourcesrc="/build/dist/img/el/s-el1.png" width="100%">
                                    </span>
                                    <em>摇滚妈妈</em>
                                </li>
                                <li>
                                    <span>
                                        <img src="" sourcesrc="/build/dist/img/el/s-el2.png" width="100%">
                                    </span>
                                    <em>时髦妈妈</em>
                                </li>
                                <li>
                                    <span>
                                        <img src="" sourcesrc="/build/dist/img/el/s-el3.png" width="100%">
                                    </span>
                                    <em>运动妈妈</em>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>

                <div class="showFooterArea">
                    <a href="javascript:void(0);" class="btn selectPhoto">就选这张</a>
                    <a href="javascritp:void(0);" class="btn replayBtn">重新上传</a>
                    <a href="/application/index.html" class="btn rehomeBtn hidden">返回主页</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="/build/dist/js/vendor.min.js"></script>
<script type="text/javascript" src="/build/dist/js/main.min.js"></script>
<script type="text/javascript">
    pfun.init();

    var allimg = [
       '/build/dist/img/logo.png',
       '/build/dist/img/slogan.png',
       '/build/dist/img/m_bg.png',
       '/build/dist/img/el/el1.png',
       '/build/dist/img/el/el2.png',
       '/build/dist/img/el/el3.png',
       '/build/dist/img/el/s-el1.png',
       '/build/dist/img/el/s-el2.png',
       '/build/dist/img/el/s-el3.png',
       '/build/dist/img/photo.jpg',
    ], step = 0, elVal = '';

    pfun.loadingFnDoing(allimg, function(){
        $(".loading").css({"visibility": "hidden"});

        _v.sectionChange("create");
        pfun.overscroll(document.querySelector(".indexScroll")); 

    })   


    $(".createEl li").on("click", function(){
        if($(".createEl").hasClass("disabled")) return false;
        var cindex = $(this).index() * 1 + 1;

        if($(this).hasClass("hover")){
            $(".createEl li").removeClass("hover");
            $(".eleNode").attr({"class": "eleNode"});
            elVal = "";
        }else{
            $(".createEl li").removeClass("hover");
            $(this).addClass("hover");

            $(".eleNode").attr({"class": "eleNode el" + cindex});
            elVal = "el" + cindex;
        }
        
        // console.log(elVal);
    })



    var photoCanvas = document.createElement("canvas"), 
        photoCanvasRate, 
        fabricPhotoCanvas, 
        photoCanvasWidth, 
        photoCanvasHeight;

    var photoImg = new Image();
        photoImg.src = "/build/dist/img/photo.jpg";

        photoImg.onload =  function(){
            photoCanvasWidth = ($(document).width() * .63);
            photoCanvasRate =  photoCanvasWidth / this.width;   // 图片缩放比例
            photoCanvasHeight = this.height * photoCanvasRate;

            photoCanvas.id = 'photoCanvas';
            photoCanvas.width = photoCanvasWidth;
            photoCanvas.height = photoCanvasHeight;
            $(".casACon").append(photoCanvas);


            fabricPhotoCanvas = new fabric.Canvas('photoCanvas');
            fabric.Object.prototype.transparentCorners = false;
            // var rect = new fabric.Rect({
            //     top : 0,
            //     left : 0,
            //     width : photoCanvasWidth,
            //     height : photoCanvasHeight,
            //     fill : 'rgba(23,56,56,.2)',
            //     selectable: false,
            // });

            // fabricPhotoCanvas.add(rect);

        }



    
        


    document.querySelector('input').addEventListener('change', function () {
        var that = this;
        $(".loading").css({"visibility": "visible"});

        lrz(that.files[0], {
            width: 1024
        })
            .then(function (rst) {
                var img        = new Image(),
                    div        = document.createElement('div'),
                    p          = document.createElement('p'),
                    sourceSize = toFixed2(that.files[0].size / 1024),
                    resultSize = toFixed2(rst.base64Len * 0.8 / 1024),
                    scale      = parseInt(100 - (resultSize / sourceSize * 100));

                img.onload = function () {
                    //document.querySelector('.canvasArea').appendChild(img);
                    $('.uploadTips').addClass("hidden");

                    if(this.width > this.height){
                        var uploadPhotoRate =  photoCanvasHeight / this.height;   // 图片缩放比例
                        var uploadPhotoWidth = this.width * uploadPhotoRate;
                        imgDraw(fabricPhotoCanvas, this, uploadPhotoWidth, photoCanvasHeight, 0, 0, true, 'photo');  // 绘制上传的亲子照片
                    }else{
                        var uploadPhotoRate =  photoCanvasWidth / this.width;   // 图片缩放比例
                        var uploadPhotoHeight = this.height * uploadPhotoRate + 18;
                        imgDraw(fabricPhotoCanvas, this, (photoCanvasWidth + 15), uploadPhotoHeight, 0, 0, true, 'photo');  // 绘制上传的亲子照片
                    }

                    $(".loading").css({"visibility": "hidden"});

                };

                img.src = rst.base64;

                return rst;
            });
    });


    function toFixed2 (num) {
        return parseFloat(+num.toFixed(2));
    }




    function imgDraw(fabricEl, img, w, h, l, t, s, _name){
        var drawImg = new fabric.Image(img, {
            left: l,
            top: t,
            width: w,
            height: h,
            transparentCorners: false,
            hasControls: false,
            hasBorders: false,
            name: _name,
        });
        drawImg["selectable"] = s;
        fabricEl.add(drawImg);
        fabricEl.renderAll();
    }


    /*
     * 元素添加
     */

    var createCanvas = document.createElement("canvas"), 
        fabricCreateCanvas, 
        canvasWidth, 
        canvasHeight, 
        rate;
     
    var defaultBgImg = new Image();    // 默认背景
        defaultBgImg.src = "/build/dist/img/m_bg.png";


   

    // var eleImg = new Image();
    //     eleImg.src = "/build/dist/img/el/el1.png";

    defaultBgImg.onload = function () {
        var self = this;

        createCanvasWidth = ($(document).width() * .72);
        rate =  createCanvasWidth / self.width;   // 图片缩放比例
        createCanvasHeight = self.height * rate;

        createCanvas.id = 'createCanvas';

        //var createCanvasCtx = createCanvas.getContext('2d');
        //调用
        //var ratioCreateCanvas = getPixelRatio(createCanvasCtx);

        createCanvas.width = createCanvasWidth;
        createCanvas.height = createCanvasHeight;

        
        $(".createACon").append(createCanvas);

        fabricCreateCanvas = new fabric.Canvas('createCanvas');
        fabric.Object.prototype.transparentCorners = false;

        // var rect = new fabric.Rect({
        //     top : 0,
        //     left : 0,
        //     width : createCanvasWidth,
        //     height : createCanvasHeight,
        //     fill : 'rgba(23,72,56,.6)'
        // });

        // fabricCreateCanvas.add(rect);

        imgDraw(fabricCreateCanvas, self, createCanvasWidth, createCanvasHeight, 0, 0, false, 'defaultBg');   // 绘制默认

    };


    function createPhotoFun(_src, _type, _cb){
        var _createImg = new Image();
            _createImg.src = _src;
            _createImg.onload = function(){ 
                if(_type){  // 绘制上传创建的照片
                    var createPhotoImgRate = createCanvasWidth * 0.87 / this.width;  // * .87
                    var createPhotoImgHeight = this.height * createPhotoImgRate;
                    imgDraw(fabricCreateCanvas, this, createCanvasWidth * 0.87, createPhotoImgHeight, createCanvasWidth * .06, createCanvasHeight * .05, false, 'qrPhoto');   // 绘制photo   .06    .05
                }else{  // 绘制小元素
                    if(elVal != ""){
                        var eleImgRate =  createCanvasWidth / this.width;   // 图片缩放比例
                        var eleImgHeight = this.height * eleImgRate;
                        imgDraw(fabricCreateCanvas, this, createCanvasWidth, eleImgHeight, 0, 0, false, 'smallEle');  
                    }
                    
                    //setTimeout(_cb, 200);
                    _cb();
                }   
            }   
    }


    // 选取本地亲子照片事件
    $(".selectPhoto").on("click", function(){
        

        if($(this).hasClass("disabled")) return false;
        var inputFileVal = $("input[type=file]").val();
        if(!inputFileVal){
            pfun.formErrorTips("请拍摄或上传照片！");
        }else{


            var self = $(this);
            if(!step){  // 确认选择照片
                var cphoto = fabricPhotoCanvas.toDataURL('image/png', 0.8); //.toDataURL({format: 'png', quality: 0.6});
                //$(".aaa").attr("src", cphoto);
                createPhotoFun(cphoto, 1, '');
                step = 1;
                $(".createEl").removeClass("hidden");

                $(".canvasNode").removeClass("hidden");
                $(".casACon").addClass("hidden");
                $(".eleNode").removeClass("hidden");

                $(".replayBtn").addClass("hidden");
                $(".rehomeBtn").removeClass("hidden");
            }else{
                
                var elSrc = elVal ? "/build/dist/img/el/"+elVal+".png" : "/build/dist/img/el/el1.png";
                //console.log(elSrc);
                createPhotoFun(elSrc, 0, function(){
                    $(".eleNode").addClass("hidden");
                    var finPhoto = fabricCreateCanvas.toDataURL('image/png', 0.8); //.toDataURL({format: 'image/png', quality: 0.7});

                    var __abcCanvasNode = document.createElement("canvas");
                        __abcCanvasNode.id = "abcCanvas";
                        $("body").append(__abcCanvasNode);


                    var __abc = new Image();
                    var __abcCanvas = new fabric.Canvas('abcCanvas');

                    __abc.src = finPhoto;
                    //$("body").append(__abc);
                    __abc.onload = function(){ 
                        var __abcCreateW = this.width * 0.6,
                            __abcCreateH = this.height * 0.6;
                        __abcCanvasNode.width = __abcCreateW;
                        __abcCanvasNode.height = __abcCreateH;

                        imgDraw(__abcCanvas, this, __abcCreateW, __abcCreateH, 0, 0, false, 'crImg');  





                        var __abcPhoto = __abcCanvas.toDataURL('image/png', 0.8);

                        var uploadPicObj = {
                            "pic": __abcPhoto.replace("data:image/png;base64,", "")
                        }

                        $(".createEl").addClass("disabled");
                        self.addClass("disabled");


                        $.ajax({
                            type: "POST",
                            url: "/api/uploadpic",
                            data: uploadPicObj,
                            dataType: "json"
                        }).done(function(data){
                            // alert("status" + data.status);
                            if(data.status == "1"){
                               window.location.href = "/result?pid=" + data.msg;
                               $(".formNode").removeClass("hidden");
                               $(".formTable").addClass("hidden");
                               pfun.formErrorTips('上传成功！');
                            }else{
                               pfun.formErrorTips(data.msg);
                            }
                            
                            self.removeClass("disabled");

                        }).fail(function(jqXHR, textStatus) {
                          console.log( "Request failed: " + textStatus );
                          console.log('test' + jqXHR);
                        });

                    }
                });


        }
        
            




        }
    })


    $(".replayBtn").on("click", function(){
        var uploadFile = $("input[type=file]").val();
        if(uploadFile){
            $('.uploadTips').removeClass("hidden");
            $("input[type=file]").val("");
            fabricRemoveEvent(fabricPhotoCanvas, 'photo');
        };
    })

    function fabricRemoveEvent(_node, cname){
        $.map(_node._objects,function(v,k){
          if(v.name == cname){
            _node.remove(_node._objects[k]);
          }
        })
    }

    


</script>

</body>
</html>