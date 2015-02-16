function rate(num, state, el) {
    var xmlhttp = getXmlHttp();

    xmlhttp.open('POST', '/up_down_likes.php', true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send('number=' + num + '&submit=' + encodeURIComponent(state));

    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            el.innerHTML = +el.innerHTML + (state == '+' ? 1 : -1);
            console.log(state == '+' ? 'увеличено!' : 'уменьшено!');
        } else {
            console.log('Что-то пошло не так, жмякни еще раз');
        }
    }
}

(function() {
    var posts = document.getElementsByClassName('post'),
        id, rating;

    for(var i = 0, l = posts.length; i < l; i++) {
        id = +posts[i].getElementsByClassName('id')[0].innerHTML;
        rating = posts[i].getElementsByClassName('rating')[0];
        posts[i].getElementsByClassName('cool')[0].addEventListener('click', function(e){
            e.stopPropagation();
            e.preventDefault();
            console.log('для поста ' + id + ' увеличиваем рейтинг');
            rate(id, '+', rating);
        }, false);

        posts[i].getElementsByClassName('crap')[0].addEventListener('click', function(e){
            e.stopPropagation();
            e.preventDefault();
            console.log('для поста ' + id + ' уменьшаем рейтинг');
            rate(id, '-', rating);
        }, false);
    }
})();

function getXmlHttp(){
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject('Msxml2.XMLHTTP');
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        } catch (exp) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}