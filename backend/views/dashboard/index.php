<?php
$this->title = '控制面板';
?>
<section class="row m-b-md">
    <div class="col-sm-6">
        <small>欢迎回来, <?= Yii::$app->user->identity->username ?>, <i class="fa fa-map-marker fa-lg text-primary"></i> <?= Yii::$app->user->identity->ipLocation ?></small>
    </div>
</section>
<div class="row">
    <div class="col-sm-6">
        <div class="panel b-a">
            <div class="row m-n">
                <div class="col-md-6 b-b b-r">
                    <a href="#" class="block padder-v hover">
                    <span class="i-s i-s-2x pull-left m-r-sm">
                    <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
                    <i class="i i-plus2 i-1x text-white"></i>
                    </span>
                    <span class="clear">
                    <span class="h3 block m-t-xs text-danger">2,000</span>
                    <small class="text-muted text-u-c">New Visits</small>
                    </span>
                    </a>
                </div>
                <div class="col-md-6 b-b">
                    <a href="#" class="block padder-v hover">
                    <span class="i-s i-s-2x pull-left m-r-sm">
                    <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate"></i>
                    <i class="i i-users2 i-sm text-white"></i>
                    </span>
                    <span class="clear">
                    <span class="h3 block m-t-xs text-success">75%</span>
                    <small class="text-muted text-u-c">Bounce rate</small>
                    </span>
                    </a>
                </div>
                <div class="col-md-6 b-b b-r">
                    <a href="#" class="block padder-v hover">
                    <span class="i-s i-s-2x pull-left m-r-sm">
                    <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
                    <i class="i i-location i-sm text-white"></i>
                    </span>
                    <span class="clear">
                    <span class="h3 block m-t-xs text-info">25 <span class="text-sm">m</span></span>
                    <small class="text-muted text-u-c">location</small>
                    </span>
                    </a>
                </div>
                <div class="col-md-6 b-b">
                    <a href="#" class="block padder-v hover">
                    <span class="i-s i-s-2x pull-left m-r-sm">
                    <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
                    <i class="i i-alarm i-sm text-white"></i>
                    </span>
                    <span class="clear">
                    <span class="h3 block m-t-xs text-primary">9:30</span>
                    <small class="text-muted text-u-c">Meeting</small>
                    </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="panel b-a">
            <div class="panel-heading no-border bg-primary lt text-center">
                <a href="#">
                <i class="fa fa-qq fa fa-3x m-t m-b text-white"></i>
                </a>
            </div>
            <div class="padder-v text-center clearfix">
                <div class="col-xs-6 b-r">
                    <div class="h3 font-bold">42k</div>
                    <small class="text-muted">Friends</small>
                </div>
                <div class="col-xs-6">
                    <div class="h3 font-bold">90</div>
                    <small class="text-muted">Feeds</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="panel b-a">
            <div class="panel-heading no-border bg-info lter text-center">
                <a href="#">
                <i class="fa fa-weibo fa fa-3x m-t m-b text-white"></i>
                </a>
            </div>
            <div class="padder-v text-center clearfix">
                <div class="col-xs-6 b-r">
                    <div class="h3 font-bold">27k</div>
                    <small class="text-muted">Tweets</small>
                </div>
                <div class="col-xs-6">
                    <div class="h3 font-bold">15k</div>
                    <small class="text-muted">Followers</small>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="panel panel-default">
<header class="panel-heading font-bold">订单量</header>
<div class="panel-body">
  <div id="flot-1ine" style="height:250px"></div>
</div>
<footer class="panel-footer bg-white">
  <div class="row text-center no-gutter">
    <div class="col-xs-3 b-r b-light">
      <p class="h3 font-bold m-t">5,860</p>
      <p class="text-muted">Orders</p>
    </div>
    <div class="col-xs-3 b-r b-light">
      <p class="h3 font-bold m-t">10,450</p>
      <p class="text-muted">Sellings</p>
    </div>
    <div class="col-xs-3 b-r b-light">
      <p class="h3 font-bold m-t">21,230</p>
      <p class="text-muted">Items</p>
    </div>
    <div class="col-xs-3">
      <p class="h3 font-bold m-t">7,230</p>
      <p class="text-muted">Customers</p>                        
    </div>
  </div>
</footer>
</section>
<?php
$js = <<<'JS'
uiLoad.load(jp_config['flot']).then(function() {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var d1 = [];
    for (var i = 0; i <= 11; i += 1) {
      d1.push([i, parseInt((Math.floor(Math.random() * (1 + 20 - 10))) + 10)]);
    }
    
    $("#flot-1ine").length && $.plot($("#flot-1ine"), [{
            data: d1
        }], 
        {
          series: {
              lines: {
                  show: true,
                  lineWidth: 1,
                  fill: true,
                  fillColor: {
                      colors: [{
                          opacity: 0.3
                      }, {
                          opacity: 0.3
                      }]
                  }
              },
              points: {
                  radius: 3,
                  show: true
              },
              grow: {
                active: true,
                steps: 50
              },
              shadowSize: 2
          },
          grid: {
              hoverable: true,
              clickable: true,
              tickColor: "#f0f0f0",
              borderWidth: 1,
              color: '#f0f0f0'
          },
          colors: ["#1bb399"],
          xaxis:{
          },
          yaxis: {
            ticks: 5
          },
          tooltip: true,
          tooltipOpts: {
            content: "chart: %x.1 is %y.4",
            defaultTheme: false,
            shifts: {
              x: 0,
              y: 20
            }
          }
        }
    );
});
JS;
$this->registerJs($js);
?>