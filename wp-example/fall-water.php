<!doctype html>
<html lang="cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="pragram" content="no-cache">
    <title></title>

    <style>
      body{ 
        background-color: #5b97b9; margin: 0; overflow: hidden;
        background-image:-webkit-linear-gradient(top, #b9cfda, #5b97b9);
        background-image:linear-gradient(top,#b9cfda,#5b97b9);
      }
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
          this.bigbooms = [];
          this.animateId = null;
          this.isEnd = false;
          this.lastTime = new Date();

          this.fallDuration = 250;
          this.minDuration = 30;
          //爆炸线
          this.boomLine = this.canvas.height * 0.8;

          //y轴方向加速度
          this.avy = 0.1;

          this.start();
        }
        lightFall.prototype.start = function(){
          this.isEnd = false;
          this.animate();
        }
        lightFall.prototype.animate = function(){
          var self = this;

          self.ctx.save();
          //透明度0.02是出现boom和frag轨迹的关键
          var img = new Image();
          self.ctx.globalCompositeOperation = "destination-out";        
          self.ctx.fillStyle = "rgba(0,0,0,.02)";
          self.ctx.fillRect(0,0,canvas.width,canvas.height);
          self.ctx.restore();

          var newTime = new Date();

          if(newTime-self.lastTime>this.fallDuration && !self.isEnd){  //频率
            //var num = getRandom(2,3);
            var num = 2;

            for(var i = 0; i<num; i++){
              var x = getRandom(self.canvas.width/6,self.canvas.width*5/6);
              //var r = getRandom(2,3);
              var bigboom = new Boom(self.canvas, x, 2, "#FFFFFF", self.avy, self.boomLine);
              self.bigbooms.push(bigboom);
            }
            
            self.lastTime = newTime;
            if(this.fallDuration > this.minDuration){
              this.fallDuration -= 10;
            }
          }

          self.bigbooms.foreach(function(index){
            var that = this;
            if(!that.dead){
              that._move();
            }
            else{
              that.booms.foreach(function(index){
                if(!this.dead) {
                  this._move();
                }
                else if(index === that.booms.length-1){
                  self.bigbooms.splice(self.bigbooms.indexOf(that),1);
                }
              })
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

        function Boom (canvas,x,r,c,avy, boomLine){
          this.canvas = canvas;
          this.ctx = this.canvas.getContext("2d");
          this.booms = [];
          this.l = 50;
          this.x = x;
          this.y = -r-this.l;
          this.r = r;
          this.c = c;
          this.vy = getRandom(10, 12);

          //加速度
          this.avy = avy;
          this.vx = 0;
          this.dead = false;

          this.boomLine = boomLine;
          this.isHit= false;
          this.alpha = 1;
          this.reduce = 0.97;

          this.count = 0;
        }
        Boom.prototype = {
          _paint:function(){
            this.ctx.save();
            this.ctx.beginPath();
            this.ctx.fillStyle = this.c;
            this.ctx.fillRect(this.x, this.y, this.r, this.l)
            this.ctx.fill();
            this.ctx.restore();
          },
          _move:function(){
            this.vy += this.avy;

            if( this.y < this.boomLine && this.y + this.vy > this.boomLine && !this.isHit){
              var rand = getRandom(0,10);
              if( rand > 6 ){
                this._boom();
                this.dead = true;
                return;
              }
            }
            
            this.y = this.y + this.vy;

            this.x = this.x + this.vx;


            if(this.y > canvas.height + 10){
              this.dead = true;
            }
            else {
              this._paint();
            }
          },
          _boom:function(){
            var fragNum = getRandom(5 , 9);
            var basevx = getRandom(-4,4,1);
            var basevy = getRandom(-this.vy*0.3, this.vy*0.1, 1);
            for(var i=0;i<fragNum;i++){
              var radius = 1.6;    //花半径
              var vx = getRandom(basevx-1,basevx+1,1);
              var vy = getRandom(basevy-0.4,basevy+0.4,1);
              var frag = new Frag(this.canvas, this.x , this.y+this.l , radius , this.c , vx, vy, this.avy);
              this.booms.push(frag);
            }
            
          },
        }

        function Frag(canvas, centerX , centerY , radius , color , vx , vy, avy){
          this.canvas = canvas;
          this.ctx = this.canvas.getContext("2d");
          this.x = centerX;
          this.y = centerY;
          this.dead = false;
          this.radius = radius;
          this.color = color;
          this.vx = vx;
          this.vy = vy;
          this.avy = avy;
          this.alpha = 1;
          this.reduce = 0.95;
        }
        Frag.prototype = {
          _paint:function(){
            this.ctx.save();
            this.ctx.beginPath();
            this.ctx.globalAlpha = this.alpha;
            this.ctx.arc(this.x , this.y , this.radius , 0 , 2*Math.PI);
            this.ctx.fillStyle = this.color;
            this.ctx.fill()
            this.ctx.restore();
          },
          _move: function(){
            this.vy += this.avy;

            this.y = this.y + this.vy;

            this.x = this.x + this.vx;

            this.alpha *= this.reduce;

            if(this.y > canvas.height + 10 || this.alpha < 0.1){
              this.dead = true;
            }
            else {
              this._paint();
            }
          }
        }
    </script>


<?php 
  if( strpos(strtolower($_SERVER['HTTP_HOST']), "toucanz") !== FALSE ){
    include_once("footer.php");
  }
?>
</body>
</html>