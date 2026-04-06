<?php
/**
 * templates/element/Flash/default.php
 * @var \App\View\AppView $this
 * @var array  $params
 * @var string $message
 */
$type  = $params['class'] ?? 'info';
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
$bgColors = [
    'success'=>'#28a745',
    'error' =>'#dc3545',
    'warning'=>'#ffc107',
    'info' =>'#17a2b8',
];
$bg = $bgColors[$type] ?? '#6c757d';
$fg = $type==='warning' ? '#212529' : '#fff';
?>
<div class="flash-message <?= h($type) ?>"
     style="
         position:fixed;
         bottom:20px;
         right:20px;
         background:<?= $bg?>;
         color:<?= $fg?>;
         padding:0.75rem 1rem;
         border-radius:4px;
         box-shadow:0 2px 6px rgba(0,0,0,0.2);
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
