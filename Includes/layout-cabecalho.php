<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link rel="shortcut icon" href="../Assets/favicon.png" type="image/x-icon">
    <title><?= $title ?></title>
</head>

<style>
    .owl-dots{
        text-align: center;
        margin-top: 20px;
        display: block !important;
    }
    .owl-dot{
        height: 13px;
        width: 13px;
        margin: 0 5px;
        outline: none!important;
        border-radius: 50%;
        border: 2px solid #315d7b!important;
        transition: all 0.5s ease;
    }
    .owl-dot.active{
        width: 35px;
        border-radius: 14px;
    }
    .owl-dot.active,
    .owl-dot:hover{
        background: #315d7b!important;
    }

</style>