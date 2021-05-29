                <div class="article-list-header">
			        <div class="article-list-title">
			            <h2><?php echo __( 'Vous appréciez notre auteur', 'BTB' ); ?></h2>
			        </div>
			    </div>

                <div class="columns" style="margin-top: 4.0em;">

                    <!-- most-viewed.php -->
                    <?php get_template_part( 'parts/most-viewed-author' ); ?>

                    <!-- most-rating.php -->
                    <?php get_template_part( 'parts/most-rating-author' ); ?>

                    <!-- most-commented.php -->
                    <?php get_template_part( 'parts/most-commented-author' ); ?>

                </div>

                <div style="clear:both;height:48px;"></div>