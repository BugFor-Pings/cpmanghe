<?php
    include './head.php';
    if($_COOKIE['user']!=$userInfo['user'] && $_COOKIE['userToken']!=md5($userInfo['user'].$userInfo['pwd'])){
        exit('<script>window.location.href="../user.php"</script>');
    }else{
        exit('<script>window.location.href="./index.php"</script>');
    }
?>