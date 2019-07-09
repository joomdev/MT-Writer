<ul class="footer-social mt-share">
    <?php if(get_theme_mod('facebook', '#')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('facebook')); ?>" target="_blank">
                <i class="fab fa-facebook-f" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if(get_theme_mod('twitter', '#')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('twitter')); ?>" target="_blank">
                <i class="fab fa-twitter" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if(get_theme_mod('instagram', '#')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('instagram')); ?>" target="_blank">
                <i class="fab fa-instagram" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if(get_theme_mod('youtube', '#')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('youtube')); ?>" target="_blank">
                <i class="fab fa-youtube" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if(get_theme_mod('linkedin')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('linkedin')); ?>" target="_blank">
                <i class="fab fa-linkedin" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if(get_theme_mod('spotify')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('spotify')); ?>" target="_blank">
                <i class="fab fa-spotify" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if(get_theme_mod('github')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('github')); ?>" target="_blank">
                <i class="fab fa-github" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if(get_theme_mod('whatsapp')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('whatsapp')); ?>" target="_blank">
                <i class="fab fa-whatsapp" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if(get_theme_mod('telegram')) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(get_theme_mod('telegram')); ?>" target="_blank">
                <i class="fab fa-telegram" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>
</ul>