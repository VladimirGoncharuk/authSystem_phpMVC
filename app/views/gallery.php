<?php
session_start();
?>

<div class="content">
<button type="button" id="out" class=" btn btn-primary">Выход</button>
    <div class="d-none img">
<img src="/images/ds.png" alt="ds.png">
    </div>
    <div class=" text row color">
        <p>
        Современники и историки искусства спорили не только о незавершенности изображения, но также и о значении и смысле фона. Поверхность позади Рембрандта интерпретировалась либо как стена, либо как натянутое полотно. Полукруглые линии представляются как полушария на карте мира, что является общей чертой дизайна голландских домов XVII века, однако они не содержат географических указаний и расположены довольно далеко друг от друга.
        </p>
    </div>
</div>
<?php
if ($_SESSION['user'] ==='userVK'){
?>
<script>
document.querySelector(".img").classList.toggle("d-block")
</script>
<?php
}
?>
