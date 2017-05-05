
/**
 * main.js
 */


function vFun(){
    var self = this;

    /* 公共函数 即 默认执行 */

    self.isPhoneNum = function(v){
        //return /^0|^((\+?86 )|(\(\+86 \)))?(13[0-9]|15[012356789]|18[012356789]|14[57])[0-9]{8}$/.test(v);
        return /^1([0-9]){10}$/.test(v);
    }

    // 页面切换
    self.sectionChange = function(n){        // section 页面切换
        $(".section").removeClass("show transition");
        $("#" + n).addClass('show transition');  
    }

    // 视频事件监测
    self.eventTester = function(m, e, c){    // 视频事件监测函数
        /*
         * eventTester("play");              // play()和autoplay开始播放时触发
         * eventTester("pause");             // pause() 暂停触发
         * eventTester("timeupdate");        // 播放时间改变
         * eventTester("ended");             // 播放结束
         */
        m.addEventListener(e,function(){
             c()
        },false);
    }




}

var _v = new vFun();

