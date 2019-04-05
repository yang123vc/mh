<nav class="mui-bar mui-bar-tab">
    <a href="/bookcase" class="mui-tab-item  @if(isset($type) && $type==0) mui-active @endif" >
        <div>
            <img class="posi_img" src="http://m8.hongjingkeji.com/Public/anime/img/nav_bookcase_red.png">
            <img src="http://m8.hongjingkeji.com/Public/anime/img/nav_bookcase_gray.png">
        </div>
        <span class="mui-tab-label">书架</span>
    </a>
    <a href="/" class="mui-tab-item  @if(isset($type) && $type==1) mui-active @endif">
        <div>
            <img class="posi_img" src="http://m8.hongjingkeji.com/Public/anime/img/nav_bookcity_red.png">
            <img src="http://m8.hongjingkeji.com/Public/anime/img/nav_bookcity_gray.png.png">
        </div>
        <span class="mui-tab-label">书城</span>
    </a>
    <a href="/cate" class="mui-tab-item @if(isset($type) && $type==2) mui-active @endif">
        <div>
            <img class="posi_img" src="http://m8.hongjingkeji.com/Public/anime/img/nav_classify_red.png">
            <img src="http://m8.hongjingkeji.com/Public/anime/img/nav_classify_gray.png">
        </div>
        <span class="mui-tab-label">分类</span>
    </a>
    <a href="/my" class="mui-tab-item @if(isset($type) && $type==3) mui-active @endif">
        <div>
            <img class="posi_img" src="http://m8.hongjingkeji.com/Public/anime/img/nav_mine_red.png">
            <img src="http://m8.hongjingkeji.com/Public/anime/img/nav_mine_gray.png">
        </div>
        <span class="mui-tab-label">我的</span>
    </a>
</nav>

