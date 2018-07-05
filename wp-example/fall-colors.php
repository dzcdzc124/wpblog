<!doctype html>
<html lang="cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="pragram" content="no-cache">
    <title>彩带飘落</title>

    <style>
      body{ background-color: #fefff2; margin: 0;}
    </style>
</head>

<body>
    <div class="main">
        <canvas id="canvas"></canvas>
    </div>

    <script src="./common/js/zepto.min.js"></script>
    
    <script>
        $(function(){
            var width = $(window).width();
            var height = $(window).height();
            $("body").height(height);

            var canvas = document.getElementById("canvas");
            canvas.width = width;
            canvas.height= height;
            new lightFall("canvas");
        })
        //随机数
        function getRandom(a , b , toFixNum){
          if(!toFixNum){
            return Math.round(Math.random()*(b-a)+a);
          }else{
            var n = Math.random()*(b-a)+a;
            return Number(n.toFixed(toFixNum));
          }
        }

        (function() {
            var lastTime = 0;
            var vendors = ['webkit', 'moz'];
            for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
                window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
                window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] ||    // Webkit中此取消方法的名字变了
                                              window[vendors[x] + 'CancelRequestAnimationFrame'];
            }

            if (!window.requestAnimationFrame) {
                window.requestAnimationFrame = function(callback, self) {
                  self = !self ? this : self;
                    var currTime = new Date().getTime();
                    var timeToCall = Math.max(0, 16.7 - (currTime - lastTime));
                    var id = window.setTimeout(function() {
                        callback.call(self);
                    }, timeToCall);
                    lastTime = currTime + timeToCall;
                    return id;
                };
            }
            if (!window.cancelAnimationFrame) {
                window.cancelAnimationFrame = function(id) {
                    clearTimeout(id);
                };
            }

            Array.prototype.foreach = function(callback){
              for(var i=0;i<this.length;i++){
                if(this[i]!==null) callback.apply(this[i] , [i])
              }
            }
        }());

        function lightFall( element ){
          this.canvas = document.getElementById(element);
          this.ctx = this.canvas.getContext("2d");
          this.colors = [];
          this.lines = [];
          this.animateId = null;
          this.isEnd = false;
          this.lastTime_color = new Date();
          this.lastTime_line = new Date();

          this.fallDuration = 150;
          this.minDuration = 30;


          this.start();
        }
        lightFall.prototype.start = function(){
          this.isEnd = false;
          this.animate();
        }
        lightFall.prototype.animate = function(){
          var self = this;

          var newTime = new Date();

          if(newTime-self.lastTime_color>this.fallDuration && !self.isEnd && self.colors.length<40){  //频率
            var num = 2;

            for(var i = 0; i<num; i++){
              var c = new Colors(self.canvas);
              self.colors.push(c);
            }
            
            self.lastTime_color = newTime;
          }
          if(newTime-self.lastTime_line > this.fallDuration*4 && !self.isEnd && self.lines.length<5){  //频率
            var num = 1;

            var line = new Line(self.canvas);
            self.lines.push(line);
            
            self.lastTime_line = newTime;
          }

          self.ctx.clearRect(0,0,canvas.width,canvas.height);
          self.colors.foreach(function(index){
            var that = this;
            if(!that.dead){
              that._move();
            }
            else{
              self.colors.splice(self.colors.indexOf(that),1);
            }
          });
          
          self.lines.foreach(function(index){
            var that = this;
            if(!that.dead){
              that._move();
            }
            else{
              self.lines.splice(self.lines.indexOf(that),1);
            }
          });

          self.animateId = requestAnimationFrame((function(_this){
            return function(){
              _this.animate.call(_this);
            }
          }(self)));
        }
        lightFall.prototype.stop = function(){
          var self = this;
          this.isEnd = true;
          cancelAnimationFrame(self.animateId);
          self.ctx.clearRect(0,0,canvas.width,canvas.height);
        }

        function Colors (canvas){
          this.canvas = canvas;
          this.ctx = this.canvas.getContext("2d");

          var type = getRandom(-2,8);

          this.type = type;
          if(type < 0){
            this.x = getRandom(0, canvas.width);
            this.y = getRandom(0, canvas.height);
            this.vx = getRandom(-3,3);
            this.vy = getRandom(-1,3);
          }else{
            this.x = getRandom(0, canvas.width);
            this.y = -10;
            this.vx = getRandom(-2,2);
            this.vy = getRandom(3,7);
          }

          var color = ["#fcda8c","#a8cfb7","#e5bc8b","#a3dbd4","#f4d383","#5057df","#db4444"];
          this.c = color[getRandom(0,color.length-1)];

          var size = 15;
          this.path =[];    //不规则多边形路径
          var num = getRandom(2,5);
          for(var i = 0; i<num; i++){
            var _x = getRandom(-size, size);
            var _y = getRandom(-size, size);
            this.path.push({x:_x, y: _y});
          }

          //加速度
          this.fadeout = false;
          this.dead = false;

          this.alpha = 1;
          var reduce = getRandom(0,3);
          this.reduce = 0.93+reduce/100;
        }
        Colors.prototype = {
          _paint:function(){
            this.ctx.save();
            this.ctx.beginPath();
            if(this.fadeout){
              this.ctx.globalAlpha = this.alpha;
            }

            this.ctx.fillStyle = this.c;
            this.ctx.moveTo(this.x, this.y);
            for(var i = 0; i<this.path.length; i++){
              this.ctx.lineTo(this.x+this.path[i].x, this.y+this.path[i].y);
            }
            this.ctx.closePath();
            this.ctx.fill();
            this.ctx.restore();
          },
          _move:function(){
            if(this.fadeout){
              this.alpha *= this.reduce;
            }

            this.x = this.x + this.vx;
            this.y = this.y + this.vy;

            var r;
            if(this.type < 0){
              r = getRandom(0 ,40);
            }else{
              r = getRandom(0 ,70);
            }
            if(!r){ this.fadeout = true; }

            //碎屑退出条件
            if( this.y > canvas.height + 10 ||
                this.y < -10 ||
                this.x > canvas.width + 10 ||
                this.x < -10 ||
                this.alpha < 0.05
              ){
              
              this.dead = true;
            }
            else {
              this._paint();
            }
          },
        }

        function Line (canvas){
          this.canvas = canvas;
          this.ctx = this.canvas.getContext("2d");

          this.length = getRandom( 200 , 300);
          this.x = getRandom(0, canvas.width+(canvas.height*2/3));
          this.y = 0;
          this.vx = -8;
          this.vy = 12;
          
          this.c = "#ff7392";

          //加速度
          this.dead = false;
        }
        Line.prototype = {
          _paint:function(){
            this.ctx.save();
            this.ctx.beginPath();

            this.ctx.strokeStyle = this.c;
            this.ctx.lineWidth = 2;
            this.ctx.lineCap = "round";
            this.ctx.moveTo(this.x, this.y);
            this.ctx.lineTo(this.x+this.length/3, this.y-this.length/2);
            this.ctx.stroke();

            this.ctx.closePath();
            this.ctx.restore();
          },
          _move:function(){
            this.x = this.x + this.vx;
            this.y = this.y + this.vy;

            //退出条件
            if( this.y > canvas.height + this.length/2 ||
                this.x < -this.length/3
            ){
              this.dead = true;
            }
            else {
              this._paint();
            }
          },
        }
    </script>


<?php 
    include_once("footer.php");
?>
</body>
</html>