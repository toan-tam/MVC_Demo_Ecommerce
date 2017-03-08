<nav>
    <?php if(isset($menus)) : ?>
        <?php foreach($menus as $menu):?>
            <a href="<?=$_SERVER['REQUEST_URI']?>?menu_id=<?=$menu->id?>" ><?php echo $menu->name;?></a>
        <?php endforeach;?>
    <?php endif;?>
</nav>