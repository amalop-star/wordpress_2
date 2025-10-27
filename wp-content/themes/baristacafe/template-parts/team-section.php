<section class="barista-section section-padding section-bg" id="barista-team">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-12 text-center mb-4 pb-lg-2">
                <em class="text-white">Creative Baristas</em>
                <h2 class="text-white">Meet People</h2>
            </div>

            <?php
            // Query team members
            $team_args = array(
                'post_type' => 'team',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'ASC'
            );
            $team_query = new WP_Query($team_args);
            
            if ($team_query->have_posts()) :
                while ($team_query->have_posts()) : $team_query->the_post();
                    $position = get_post_meta(get_the_ID(), 'team_position', true);
            ?>
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="team-block-wrap">
                            <div class="team-block-info d-flex flex-column">
                                <div class="d-flex mt-auto mb-3">
                                    <h4 class="text-white mb-0"><?php the_title(); ?></h4>
                                    <?php if ($position) : ?>
                                        <p class="badge ms-4"><em><?php echo esc_html($position); ?></em></p>
                                    <?php endif; ?>
                                </div>
                                <p class="text-white mb-0"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
                            </div>
                            <div class="team-block-image-wrap">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('team-thumbnail', array('class' => 'team-block-image img-fluid')); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/placeholder.jpg" class="team-block-image img-fluid" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default team members if no posts
                $default_team = array(
                    array('name' => 'Steve', 'position' => 'Boss', 'image' => 'portrait-elegant-old-man-wearing-suit.jpg', 'desc' => 'your favourite coffee daily lives tempor.'),
                    array('name' => 'Sandra', 'position' => 'Manager', 'image' => 'cute-korean-barista-girl-pouring-coffee-prepare-filter-batch-brew-pour-working-cafe.jpg', 'desc' => 'your favourite coffee daily lives.'),
                    array('name' => 'Jackson', 'position' => 'Senior', 'image' => 'small-business-owner-drinking-coffee.jpg', 'desc' => 'your favourite coffee daily lives.'),
                    array('name' => 'Michelle', 'position' => 'Barista', 'image' => 'smiley-business-woman-working-cashier.jpg', 'desc' => 'your favourite coffee daily consectetur.')
                );
                
                foreach ($default_team as $member) :
                ?>
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="team-block-wrap">
                            <div class="team-block-info d-flex flex-column">
                                <div class="d-flex mt-auto mb-3">
                                    <h4 class="text-white mb-0"><?php echo $member['name']; ?></h4>
                                    <p class="badge ms-4"><em><?php echo $member['position']; ?></em></p>
                                </div>
                                <p class="text-white mb-0"><?php echo $member['desc']; ?></p>
                            </div>
                            <div class="team-block-image-wrap">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/<?php echo $member['image']; ?>" class="team-block-image img-fluid" alt="<?php echo $member['name']; ?>">
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>