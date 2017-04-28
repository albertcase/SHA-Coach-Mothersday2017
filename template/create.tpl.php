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
    <div class="section indexScroll" id="create">
        <div class="bg">
            <div class="createCon">
                <img src="" sourcesrc="/build/dist/img/slogan.png" width="100%">
            
                <div class="createArea">
                    <img src="" sourcesrc="/build/dist/img/m_bg.png" width="100%" class="opacity0">
                    <div class="createArea_con">
                        <div class="createStage">
                            <div class="uploadTips">
                                <input type="file" capture="camera" />
                            </div>
                            <div class="canvasArea">
                                <div class="eleNode el1 hidden"></div>
                                <div class="canvasNode casACon">
                                </div>
                                <div class="canvasNode createACon"></div>
                                <!-- <canvas id="myCanvas" width="100%" height="100%"></canvas> -->
                                <!-- <img src="/build/dist/img/m_bg.png" width="100%"> -->
                            </div>
                        </div>

                        <div class="createEl hidden">
                            <ul>
                                <li class="hover">
                                    <span>
                                        <img src="" sourcesrc="/build/dist/img/el/s-el1.png" width="100%">
                                    </span>
                                    <em>时髦妈妈</em>
                                </li>
                                <li>
                                    <span>
                                        <img src="" sourcesrc="/build/dist/img/el/s-el2.png" width="100%">
                                    </span>
                                    <em>运动妈妈</em>
                                </li>
                                <li>
                                    <span>
                                        <img src="" sourcesrc="/build/dist/img/el/s-el3.png" width="100%">
                                    </span>
                                    <em>摇滚妈妈</em>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>

                <div class="showFooterArea">
                    <a href="javascript:void(0);" class="btn selectPhoto">就选这张</a>
                    <a href="/application/index.html" class="btn">返回主页</a>
                </div>
            </div>
        </div>
    </div>
</div>






<script type="text/javascript" src="/build/dist/js/vendor.min.js"></script>
<script type="text/javascript" src="/build/dist/js/main.min.js"></script>
<script type="text/javascript">
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
    ], step = 0, elVal = 'el1';

    pfun.loadingFnDoing(allimg, function(){
        $(".loading").css({"visibility": "hidden"});
        pfun.init();

        _v.sectionChange("create");
        pfun.overscroll(document.querySelector(".indexScroll")); 

    })   


    $(".createEl li").on("click", function(){
        if($(this).hasClass("hover") || $(".createEl").hasClass("disabled")) return false;
        var cindex = $(this).index() * 1 + 1;
        $(".createEl li").removeClass("hover");
        $(this).addClass("hover");

        $(".eleNode").attr({"class": "eleNode el" + cindex});
        elVal = "el" + cindex;
    })



    var photoCanvas = document.createElement("canvas"), 
        photoCanvasRate, 
        fabricPhotoCanvas, 
        photoCanvasWidth, 
        photoCanvasHeight;

    var photoImg = new Image();
        photoImg.src = "/build/dist/img/photo.jpg";

        photoImg.onload =  function(){
            photoCanvasWidth = ($(document).width() * .67);
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
                        imgDraw(fabricPhotoCanvas, this, uploadPhotoWidth, photoCanvasHeight, 0, 0, true);  // 绘制上传的亲子照片
                    }else{
                        var uploadPhotoRate =  photoCanvasWidth / this.width;   // 图片缩放比例
                        var uploadPhotoHeight = this.height * uploadPhotoRate;
                        imgDraw(fabricPhotoCanvas, this, photoCanvasWidth, uploadPhotoHeight, 0, 0, true);  // 绘制上传的亲子照片
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




    function imgDraw(fabricEl, img, w, h, l, t, s){
        var drawImg = new fabric.Image(img, {
            left: l,
            top: t,
            width: w,
            height: h,
            transparentCorners: false,
            hasControls: false,
            hasBorders: false,
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
        createCanvas.width = createCanvasWidth;
        createCanvas.height = createCanvasHeight;
        $(".createACon").append(createCanvas);

        fabricCreateCanvas = new fabric.Canvas('createCanvas')
        fabric.Object.prototype.transparentCorners = false;

        // var rect = new fabric.Rect({
        //     top : 0,
        //     left : 0,
        //     width : createCanvasWidth,
        //     height : createCanvasHeight,
        //     fill : 'rgba(23,72,56,.6)'
        // });

        // fabricCreateCanvas.add(rect);

        imgDraw(fabricCreateCanvas, self, createCanvasWidth, createCanvasHeight, 0, 0, false);   // 绘制默认

    };


    function createPhotoFun(_src, _type, _cb){
        var _createImg = new Image();
            _createImg.src = _src;
            _createImg.onload = function(){ 
                if(_type){  // 绘制上传创建的照片
                    var createPhotoImgRate = createCanvasWidth * .87 / this.width;
                    var createPhotoImgHeight = this.height * createPhotoImgRate;
                    imgDraw(fabricCreateCanvas, this, createCanvasWidth * .87, createPhotoImgHeight, createCanvasWidth * .06, createCanvasHeight * .05, false);   // 绘制photo
                }else{  // 绘制小元素
                    var eleImgRate =  createCanvasWidth / this.width;   // 图片缩放比例
                    var eleImgHeight = this.height * eleImgRate;
                    imgDraw(fabricCreateCanvas, this, createCanvasWidth, eleImgHeight, 0, 0, false);  
                    setTimeout(_cb, 200);
                }   
            }   
    }



       


    // 选取本地亲子照片事件
    $(".selectPhoto").on("click", function(){
        if($(this).hasClass("disabled")) return false;
        var inputFileVal = $("input[type=file]").val();
        if(!inputFileVal) return false;
        var self = $(this);
        if(!step){
            var cphoto = fabricPhotoCanvas.toDataURL({format: 'png', quality: 1});
            createPhotoFun(cphoto, 1, '');
            step = 1;
            $(".createEl").removeClass("hidden");

            $(".canvasNode").removeClass("hidden");
            $(".casACon").addClass("hidden");
            $(".eleNode").removeClass("hidden");
        }else{
            $(".eleNode").addClass("hidden");
            var elSrc = "/build/dist/img/el/"+elVal+".png"
            createPhotoFun(elSrc, 0, function(){
                var finPhoto = fabricCreateCanvas.toDataURL({format: 'png', quality: 1});
                var uploadPicObj = {
                    "pic": 'aaaaaa'//finPhoto.replace("data:image/png;base64,", "")
                }
                // alert("生成成功6");
                $(".createEl").addClass("disabled");
                self.addClass("disabled");

                var formData = new FormData();
                // HTML 文件类型input，由用户选择
                formData.append("pic", finPhoto.replace("data:image/png;base64,", ""));
                console.log(formData);

                $.ajax({
                  url: "/api/uploadpic",
                  type: "POST",
                  data: formData,
                  processData: false,  // 不处理数据
                  contentType: false   // 不设置内容类型
                }).done(function(data){
                    alert("status" + data.status);
                    if(data.status == "1"){
                       console.log(data);
                       window.location.href = "/result?pid=" + data.msg;
                       $(".formNode").removeClass("hidden");
                       $(".formTable").addClass("hidden");
                    }
                    pfun.formErrorTips(data.msg);
                    self.removeClass("disabled");

                }).fail(function(jqXHR, textStatus) {
                  alert( "Request failed: " + textStatus );
                  alert('test' + jqXHR);
                });;

                
                // $.ajax({
                //     type: "POST",
                //     url: "/api/uploadpic",
                //     data: formData,
                //     dataType: "json"
                // }).done(function(data){
                //     alert("status" + data.status);
                //     if(data.status == "1"){
                //        console.log(data);
                //        window.location.href = "/result?pid=" + data.msg;
                //        $(".formNode").removeClass("hidden");
                //        $(".formTable").addClass("hidden");
                //     }
                //     pfun.formErrorTips(data.msg);
                //     self.removeClass("disabled");

                // }).fail(function(jqXHR, textStatus) {
                //   alert( "Request failed: " + textStatus );
                //   alert('test' + jqXHR);
                // });
                // pfun.ajaxFun("POST", "/api/uploadpic", uploadPicObj, "json", function(data){
                //     alert(data.status);
                //     if(data.status == "1"){
                //        console.log(data);
                //        window.location.href = "/result?pid=" + data.msg;
                //        $(".formNode").removeClass("hidden");
                //        $(".formTable").addClass("hidden");
                //     }
                //     pfun.formErrorTips(data.msg);
                //     self.removeClass("disabled");
                // });

            });
        }
    })



    


</script>

</body>
</html>