---
title: video
copyright: true
date: 2019-05-28 23:09:11
---


## test video dplayer 

{% raw %}
<div class="aplayer" id="aplayer-mai"></div>
<script>
$(function () {
    $.ajax({
        url: 'https://api.i-meto.com/meting/api?server=netease&type=song&id=1313052943',
        success: function (list) {
            var ap = new APlayer({
                element: document.getElementById('aplayer-mai'),
                showlrc: 3,
                theme: '#8d7561',
                music: JSON.parse(list)[0]
            });
            window.aplayers || (window.aplayers = []);
            window.aplayers.push(ap);
        }
    })
})
</script>
{% endraw %}



8月4日去了 ChinaJoy，人还是一如既往的多

AC 娘真可爱，舔爆

第二次拍 vlog，然后拍完懒得剪，还是 Freddy 帮我剪的，我在视频里真可爱

{% raw %}
<div id="player-cj"></div>
<script type="text/javascript" src="https://player.dogecloud.com/js/loader"></script>
<script type="text/javascript">
var player = new DogePlayer({
    container: document.getElementById('player-cj'),
    userId: 17,
    vcode: '10c5de157e5129c0',
    autoPlay: false
});
</script>
{% endraw %}
<!--more-->

&nbsp;

![](/images/cj1.jpg)

又见到了王尼玛和全体暴走家族成员，但这次心情很复杂

终于买到了之前一直碎碎念的 AC 娘包子头，然后被一万个人问在哪里弄的

~~软磨硬泡求~~拿到了很喜欢的触手直播的毛绒触手，懒得拍照了你们自己想象吧

然后晚上和[绒布球群](https://getrbq.com)里的绒布球们吃了饭，第二届绒布球线下py