//接口地址
var apiUrl = {
  init:       baseLink + "api/init/",
}


var sending = false;

var img_list = [
    "img/arrow.png",
    "img/audio_icon.png",
    "img/book1.png",
    "img/book2.png", 
    "img/logo.png",
    "img/music_on.png",
    "img/music_off.png",
    "img/order.png",
    "img/page1.png",
    "img/page2.png",
    "img/page3.png",
    "img/word1.png",
    "img/word2.png",
    "img/word3.png",
    "img/page9.png",
];
var img_list2 = [
    "img/page4_1.png",
    "img/page4_2.png",
    "img/page5_1.png",
    "img/page5_2.png",
    "img/page5_3.png",
    "img/page6.png",
    "img/page7_1.png",
    "img/page7_2.png",
    "img/page8_1.png",
    "img/page8_2.png",
    "img/word4.png",
    "img/word5.png",
    "img/word6.png",
    "img/word7.png",
    "img/word8.png",
];


/*var imgs = document.images;
for(var i = 0; i<imgs.length; i++){
  if( !in_array(imgs[i].src, img_list) ){
    img_list.push(imgs[i].src);
  }
}*/


var pageControl = (function () {
  var loadObj = null,
      swiperObj = null,
      winnerswiper = null,
      codeTime = 90,        //验证码有效时间
      countDownTimer = null,//验证码倒计时计时器
      winwidth = 640,       //页面宽
      winheight = 960,      //页面高
      designWidth = 640,    //设计宽
      designHeight = 1050,  //设计高
      slideWidth = 640,     //滑动宽
      slideHeight = 960,    //滑动高
      winscale = 1,         //页面缩放至全部预览
      wincover = 1,         //页面放大至充满屏幕
      slideTime = 1.0,      //秒
      direction = "horizontal";  //页面切换方向，horizontal or vertical

  return {
    init: function(){
      //预加载
      /*loadObj = new preLoad({
        file_list: img_list,
        process: function(progress){
          //$(".loader .process").html(progress);
        },
        callback: function(){
          $(".pageloading").animate({
            opacity: 0
          }, 200, function(){
            $(".pageloading").remove();
            pageControl.loadComplete();
          })
          new preLoad({
            file_list: img_list2
          })
        }
      })*/

      var winsize = getWinSize();
      winwidth = winsize.width;
      winheight = winsize.height;

      if(winwidth/winheight > designWidth/designHeight){
        winscale = winheight / designHeight;
        wincover = winwidth / designWidth;
      }else{
        winscale = winwidth / designWidth;
        wincover = winheight / designHeight;
      }
      console.log(winsize);

      if(IsPC()){
        $(".swiper-container,.pageloading").width(designWidth).height(designHeight).css({
          '-webkit-transform-origin':'top center',
                  'transform-origin':'top center',
          '-webkit-transform': "scale("+winscale+")",
                  'transform': "scale("+winscale+")",
          'position': 'relative',
          'margin': '0 auto'
        });
        $(".swiper-slide").width(designWidth).height(designHeight);
      }else{
        if(winwidth != designWidth){
          $("body").width(designWidth).height(winheight * designWidth/ winwidth).css({
            '-webkit-transform-origin':'top left',
                    'transform-origin':'top left',
            '-webkit-transform': "scale("+ (winwidth/designWidth) +")",
                    'transform': "scale("+ (winwidth/designWidth) +")",
          })
          $(".swiper-slide").width(designWidth).height(winheight * designWidth/ winwidth);
          winscale = winscale / (winwidth/designWidth);
          wincover = wincover / (winwidth/designWidth);
        }else{
          $("body").width(winwidth).height(winheight);
          $(".swiper-slide").width(winwidth).height(winheight);
        }

        if($(".winscale").length > 0){
          $(".winscale").css({
            '-webkit-transform': "scale("+winscale+")",
                    'transform': "scale("+winscale+")"
          });
        }
        if($(".wincover").length > 0){
          $(".wincover").css({
            '-webkit-transform': "scale("+wincover+")",
                    'transform': "scale("+wincover+")"
          });
        }
      }

      $(".pageloading").animate({
        opacity: 0
      }, 200, function(){
        $(".pageloading").remove();
        pageControl.loadComplete();
      })
    },
    loadComplete: function(){      
      $(".refresh").on(eventName.tap, function(){ window.location.reload();})
      
      swiper = new Swiper("#swiper-container", {
          direction: 'vertical',
          mousewheelControl: true,
          followFinger: false,
          onInit: function(swiper){
            $("#swiper-container .swiper-slide").eq(swiper.activeIndex).removeClass("ready");
          },
          onSlideChangeStart: function(swiper){
            if(swiper.activeIndex == 8){
              $("#outer_order,.arrow").addClass("none");
            }
          },
          onSlideChangeEnd: function(swiper){
            $("#swiper-container .swiper-slide").eq(swiper.activeIndex).removeClass("ready");
            if(swiper.previousIndex == 8){
              $("#outer_order,.arrow").removeClass("none");
            }
            $("#swiper-container .swiper-slide").eq(swiper.previousIndex).addClass("ready");
          }
      });

      var p = GetQueryString("p");
      if(p){
        p = Number(p);
        p = p > 0? p : 1;
        swiper.slideTo(p-1,0);
      }else{
        swiper.slideTo(0);
      }

      pageControl.handleEvent();
      
      userData.name = GetQueryString("name");
      userData.addr = GetQueryString("addr");
      userData.mobile = GetQueryString("mobile");
      userData.price = GetQueryString("price");

      console.log(userData);
      if( userData.name && userData.addr && userData.mobile){
        pageControl.setUserData(userData);
        pageControl.setshareData(userData);
        $("#outer_order").on(eventName.tap, function(){
          swiper.slideTo(8,0);
        })
      }else{
        $(".part9 .page1").removeClass("none").siblings().addClass("none");
        /*$("#outer_order").on(eventName.tap, function(){
          window.location.href = "http://act.vivo.com.cn/x7damai/";
        })*/
        $("#outer_order").addClass("none");
      }

      setTimeout(function(){
        $("#outer_order").animate({
          opacity: 1
        }, 400);
      }, 3000)
      
      /*if(ISWEIXIN && !debug){
        addShareJs();
      }*/
      //viewControl.layerShow($(".winner_layer"));
      //viewControl.layerShow($(".reserve_layer"));
      //viewControl.layerShow($(".exchange_layer"));
      //viewControl.layerShow($(".drawleft_layer"));
      //viewControl.alert("请您先预约再来参与抽奖哦！");
      //viewControl.alert("<span>兑奖成功</span><br>稍候工作人员将会跟您联系");
    },
    handleEvent: function(){
      $(".part9 .create").on(eventName.tap, function(){
        $(".part9 .page3").removeClass("none").siblings().addClass("none");
      })
     
      //点击生成
      $(".page3 .submit").on(eventName.tap, function(){
        var result = $(".page3 .form").checkForm();
        if( result.errcode != 0){
          alert(result.errmsg);
          return;
        }
        userData = result.data;
        pageControl.setUserData(result.data);
        pageControl.setshareData(result.data);
      })

      //电话预约
      $(".shopInfo .book1").on(eventName.tap, function(){
        pageControl.statSave("click","电话预约");
      })
    },
    setUserData: function(userData){
      $(".part9 .page2 .shopInfo .name").html(userData.name);
      $(".part9 .page2 .shopInfo .addr").html(userData.addr);
      $(".part9 .page2 .shopInfo .book1 a").attr("href", "tel:"+userData.mobile)

      if(userData.price){
        $(".part9 .page2 .price span").html(userData.price);
      }else{
        $(".part9 .page2 .price").addClass("none");
      }

      $(".part9 .page2").removeClass("none").siblings().addClass("none");
    },
    setshareData: function(data){
        if(window.shareData){
          var url = baseLink+"?name="+data.name+"&addr="+data.addr+"&mobile="+data.mobile+"&price="+data.price;

          window.shareData.url = encodeURI(url);
          window.shareData.timelineTitle = window.shareData.title = window.shareData.timelineTitleTemp.replace("{name}", data.name);
          
          //timelineTitleTemp: "7月7日vivo X7震撼上市[{name}］火热预定中",
          console.log(window.shareData);
          refreshShareData();
        }
    },
    statSave: function(action,type){
      if(typeof _hmt != "undefined"){
          _hmt.push(['_trackEvent', action, action+"_"+type]);
      }
      if(typeof _czc != "undefined"){
          _czc.push(["_trackEvent", action, action+"_"+type]);
      }
    }
  }
}());

$(document).ready(function() {
  pageControl.init();
  musicControl.init();
})
