<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script>
<style>
.img-thumbnail{
    height: 10em !important;
    max-width: 50% !important;
}
</style>
<?php
    //echo print_r($imagenes);
    $total_x=count($imagenes);
    $row=0;
    while ($row< $total_x) {
?>
<!--
<div class="container">
    <div class="row text-center text-lg-left">
        <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src=" <?php echo $imagenes[$row]["nombre_imagen"] ?> " alt="">
            </a>
        </div>
    </div>
</div>
-->
<a href="<?php echo $imagenes[$row]["nombre_imagen"] ?>" data-lightbox="<?php echo $imagenes[$row]["idAvances"] ?>"><img class="img-fluid img-thumbnail" src=" <?php echo $imagenes[$row]["nombre_imagen"] ?> " alt=""></a>
<?php
    $row++;
}?>