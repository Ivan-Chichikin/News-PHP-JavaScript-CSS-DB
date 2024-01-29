<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости - Галактический вестник</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header-wrapper">
                <div class="header_logo">
                    <a href="index.php" class="header_logo-link">
                        <img src="./img/svgs/logo.svg" alt="ГАЛАКТИЧЕСКИЙ ВЕСТНИК" class="header_logo-pic"> 
                    </a>
                </div>
                ГАЛАКТИЧЕСКИЙ<br>ВЕСТНИК 
            </div>
        </header>
        <hr class="top_line">
        <?php
            require_once "db.php";

            if (isset($_GET['id'])) {
                $newsId = intval($_GET['id']);
                $news = mysqli_query($connect, "SELECT * FROM `news` WHERE `id` = $newsId");
                $news = mysqli_fetch_assoc($news);
            } else {
                echo "Нет информации.";
                exit;
            }
        ?>

        <main class="main">
            <section class="breadcrumbs">
                <a href="index.php" class="breadcrumb_main">Главная / </a>  
                <a class="breadcrumb_title"><?php print_r($news['title'])?></a>
            </section>

            <h1 class="news_h1"><?php print_r($news['title'])?></h1>

            <section class="detail_content">
                <div class="detail_news">
                    <p class="date">
                        <?php
                        $mysqldate = $news['date'];
                        $phpdate = strtotime($mysqldate);
                        $mysqldate = date('d.m.Y', $phpdate);
                        print_r($mysqldate);
                        ?>
                    </p>
                    <section class="nc_and_img">
                        <div class="news_content">
                            <a class="detail_title"><?php print_r($news['announce']);?></a>

                            <a class="detail_text"><?php print_r($news['content']);?></a>

                            <a class="to_main_button" onclick="to_main_button()">
                                <svg width="26" height="16" viewBox="0 0 26 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="to_main_arrow">
                                    <path d="M0.293015 8.70711C-0.0975094 8.31658 -0.0975094 7.68342 0.293014 7.2929L6.65698 0.928934C7.0475 0.538409 7.68067 0.538409 8.07119 0.928934C8.46171 1.31946 8.46171 1.95262 8.07119 2.34315L2.41434 8L8.07119 13.6569C8.46171 14.0474 8.46171 14.6805 8.07119 15.0711C7.68067 15.4616 7.0475 15.4616 6.65698 15.0711L0.293015 8.70711ZM26 9L1.00012 9L1.00012 7L26 7L26 9Z"/>
                                </svg>
                                Назад к новостям
                            </a>
                        </div>
                        <div class="detail_img">
                            <?php $img = $news['image'];?>
                            <img src="img/<?=$img?>" alt="<?php $news['announce']?>" class="di"> 
                        </div>
                    </section>
                </div>
            </section>
        </main>

        <script>
            function to_main_button() {
                window.location.href = document.referrer
            }
        </script>
        
        <footer class="footer">
            <hr class="line">
            <div class="footer_text">
                © 2023 — 2412 «Галактический вестник»
            </div>
        </footer>
    </div>
</body>
</html>