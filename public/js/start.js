var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?8b510fc5904051edbfe74a023790a160";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
function getMySrc(){
    var scriptSrc = document.getElementsByTagName('script')[document.getElementsByTagName('script').length -1].src;
    return scriptSrc;
}
function GetRequest(name) {
    var query = getMySrc().split('?'); //鑾峰彇url涓�"?"绗﹀悗鐨勫瓧涓�
    if(query.length < 2){
        return null;
    }
    var theRequest = new Object();
    strs = query[1].split("&");
    for(var i = 0; i < strs.length; i ++) {
        theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
    }
    return theRequest[name];
}