<?php
$title = '站长微语';
require_once('head.php');
?>
<div class="app-content-body">
    <div class="wrapper-md control">

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <!-- 使用列表项代替无序列表，更符合内容的样式 -->
                    2023-2-7：对搞科学的人来说，勤奋就是成功之母！
                </li>
                <li class="list-group-item">
                    2022-9-2：终日奔波只为饥，方才一饱便思衣。衣食两般皆俱足，又想娇容美貌妻。娶得美妻生下子，恨无田地少根基。买到田园多广阔，出入无船少马骑。槽头扣了骡和马，叹无官职被人欺。作了皇帝求仙术，更想登天跨鹤飞。若要世人心里足，除是南柯一梦西。
                </li>
            </ul>
        </div>

    </div>
</div>

<!-- 下面是 JavaScript 的引用 -->
<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="assets/js/aes.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>

<script type="text/javascript">
    /* 鼠标特效 */
    var a_idx = 0;
    jQuery(document).ready(function($) {
        $("body").click(function(e) {
            var a = new Array("富强","民主","文明","和谐","自由","平等","公正","法治","爱国","敬业","诚信","友善");
            var $i = $("<span />").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            var x = e.pageX,
                y = e.pageY;
            $i.css({
                "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "color": "#ff6651"
            });
            $("body").append($i);
            $i.animate({
                "top": y - 180,
                "opacity": 0
            }, 1500, function() {
                $i.remove();
            });
        });
    });
</script>