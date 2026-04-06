<?php
/**
 * @var \App\View\AppView $this
 * @var array  $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="flash-message success"
     style="
       position:fixed;
       bottom:2vh;
       right:1vw;
       max-width:35vw;
       width:auto;
       font-size:calc(1rem + 0.2vw);
       background:rgba(40,167,69,0.85);
       color:#fff;
       padding:1rem 1.5rem;
       border-radius:12px;
       box-shadow:0 4px 12px rgba(0,0,0,0.25);
       opacity:1;
       transition:opacity 0.5s ease;
       z-index:9999;
     ">
    <?= $message ?>
</div>
<script>
    (function(el){
        setTimeout(function(){
            el.style.opacity = '0';
            setTimeout(function(){ el.remove(); }, 500);
        }, 7000);
    })(document.currentScript.previousElementSibling);
</script>
