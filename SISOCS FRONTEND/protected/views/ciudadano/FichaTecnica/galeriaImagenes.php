<style type="text/css">
    .img-centered {
    display: block;
    margin: auto;
    }
    .img-responsive-gallery {
    width: auto;
    max-height: 220px;
    }
    .project-gallery {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: row;
        flex-direction: row;
    -ms-flex-pack: center;
        justify-content: center;
    background: #f5f5f5;
    }
    .carousel,
    .item,
    .carousel .active {
    max-height: 400px;
    overflow: hidden;
    position: relative;
    z-index: 1;
    }
</style>
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.33.0/css/blueimp-gallery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.33.0/js/blueimp-gallery.min.js"></script>
<script>
    $(document).ready(function(){
        document.getElementById('links').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
    })
    
</script>
<div>
    <div id="links" class="project-gallery">
        <?php                 
            $total_x=count($galeriaImagenes);
            $row=0;

            while ($row< $total_x) {
            if(strpos($galeriaImagenes[$row]["nombre_imagen"], 'pdf') === false){
                ?>
                <a href="<?php echo $galeriaImagenes[$row]["nombre_imagen"]; ?>" class="item">
                    <img src="<?php echo $galeriaImagenes[$row]["nombre_imagen"]; ?>" class="img-responsive-gallery">
                </a>
            <?php
            }
                $row++;
            }
        ?>
    </div>
    <div class="overlay"></div>
</div>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls " style="display: none;">
    <div class="slides" style="width: 1994px;"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

                