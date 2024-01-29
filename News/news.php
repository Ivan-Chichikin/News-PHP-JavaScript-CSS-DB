<?php
for ($i = 0; $i < count($news); $i++): ?>
    <div class="news_item" data-news-id="<?php echo $news[$i][0]; ?>" role="button">
        <p class="date">
            <?php 
                $mysqldate = $news[$i][1];
                
                $phpdate = strtotime($mysqldate);
                $mysqldate = date('d.m.Y', $phpdate);

                print_r($mysqldate); 
            ?>
        </p>

        <h2 class="news_title">
            <?php print_r($news[$i][2]); ?>
        </h2>

        <p class="news_subtitle">
            <?php print_r($news[$i][3]); ?>
        </p>
        <p class="details_button">
            Подробнее
            <svg width="26" height="16" viewBox="0 0 26 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.707 8.70711C26.0975 8.31658 26.0975 7.68342 25.707 7.2929L19.343 0.928934C18.9525 0.538409 18.3193 0.538409 17.9288 0.928934C17.5383 1.31946 17.5383 1.95262 17.9288 2.34315L23.5857 8L17.9288 13.6569C17.5383 14.0474 17.5383 14.6805 17.9288 15.0711C18.3193 15.4616 18.9525 15.4616 19.343 15.0711L25.707 8.70711ZM-8.74228e-08 9L24.9999 9L24.9999 7L8.74228e-08 7L-8.74228e-08 9Z"/>
            </svg>
        </p>
    </div>
<?php endfor; ?>
