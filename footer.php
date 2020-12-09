<?php
namespace AcMarche\Theme;

use AcMarche\Common\Twig;

$twig = Twig::LoadTwig();
$content = $twig->render(
    'footer/footer.html.twig'
);
echo $content;
wp_footer();
?>
</body>
</html>
