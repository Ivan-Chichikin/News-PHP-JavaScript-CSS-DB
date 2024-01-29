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
<?php
    // подсветка номера страницы
    if(isset($_GET['page-nr'])){
        $id = $_GET['page-nr'];
    }else{
        $id = 1;
    }     

    // intro из последней на странице новости
    require_once "db.php"; 
    $news_per_page = 4; // количество новостей на странице
    $offset = ($id - 1) * $news_per_page;
    $query = "SELECT * FROM `news` ORDER BY `date` DESC LIMIT 1 OFFSET $offset";
    $result = mysqli_query($connect, $query);
    $first_news = mysqli_fetch_assoc($result);
?>
<body id = "<?=$id?>">
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
    
        <main class="main">
            <section class="intro" style="background-image: url(img/<?php echo $first_news['image'];?>);">                
                    <a></a>    
                    <h1 class="intro_title">
                        <?php echo $first_news['title']; ?>
                    </h1>
                    <h2 class="intro_subtitle">
                        <?php echo $first_news['announce']; ?>
                    </h2>
            </section>

            <h1 class="news_h1">Новости</h1>

            <section class="content">
                <?php
                    require_once "db.php"; 
                    $start = 0;
                    $news_per_page = 4; // количество новостей на странице

                    // получение общего числа новостей
                    $records = $connect->query("SELECT * FROM `news`");
                    $nr_of_rows = $records->num_rows;

                    // номер страницы
                    $pages = ceil($nr_of_rows / $news_per_page);

                    $pageNow = isset($_GET['page-nr']) ? $_GET['page-nr'] : 1;

                    $start = ($pageNow - 1) * $news_per_page;

                    $news = mysqli_query($connect, "SELECT * FROM `news` ORDER BY `date` DESC LIMIT $start, $news_per_page");
                    $news = mysqli_fetch_all($news);
                    require_once "news.php"; 
                ?>

                <div class="pagination">
                    <!-- Номера -->
                    <?php for($counter = 1; $counter <= $pages; $counter++){ ?>
                        <a href="?page-nr=<?=$counter?>" class="page-number<?= $counter == $pageNow ? ' active' : '' ?>"><?=$counter ?></a>
                    <?php } ?>

                    <!-- Следующая -->
                    <?php if($pageNow < $pages){ ?>
                        <a href="?page-nr=<?php echo $_GET['page-nr'] + 1?>" class="next-page">
                            <svg width="24" height="22" viewBox="0 0 24 22" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="paginArrow">
                            <path d="M3 10C2.44772 10 2 10.4477 2 11C2 11.5523 2.44772 12 3 12L3 10ZM18.466 11.7071C18.8565 11.3166 18.8565 10.6834 18.466 10.2929L12.102 3.92893C11.7115 3.53841 11.0783 3.53841 10.6878 3.92893C10.2973 4.31946 10.2973 4.95262 10.6878 5.34315L16.3447 11L10.6878 16.6569C10.2973 17.0474 10.2973 17.6805 10.6878 18.0711C11.0783 18.4616 11.7115 18.4616 12.102 18.0711L18.466 11.7071ZM3 12L17.7589 12L17.7589 10L3 10L3 12Z"/>
                            </svg>
                        </a>
                    <?php } ?>
                </div>

                <script>
                    document.querySelectorAll('.news_item').forEach(item => {
                        item.addEventListener('click', () => {
                            const newsId = item.dataset.newsId;
                            window.location.replace(`detailPage.php?id=${newsId}`);
                        });
                    });
                </script>
            </section>
        </main>

        <footer class="footer">
            <hr class="line">
            <div class="footer_text">
            © 2023 — 2412 «Галактический вестник»
            </div>
        </footer>
    </div>

    <script>
        // подсветка номера страницы
        let links = document.querySelectorAll('.page-numbers');
        let bodyID = parseInt(document.body.id) - 1;
        links[bodyID].classList.add("active");
    </script>
</body>
</html>