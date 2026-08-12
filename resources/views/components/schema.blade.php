<?php

$schema = [
    "@context" => "https://schema.org",
    "@type" => "ProfessionalService",

    "name" => "Code Doctor",

    "url" => url('/'),

    "description" => "Диагностика, доработка, создание и сопровождение сайтов и интернет-магазинов. Исправление ошибок, интеграции, автоматизация, аналитика, SEO и работа с существующими веб-проектами.",

    "founder" => [
        "@type" => "Person",

        "name" => "Артём",

        "jobTitle" => "Специалист по разработке, сопровождению и развитию сайтов",

        "knowsAbout" => [
            "Website Development",
            "Website Diagnostics",
            "Technical Support",
            "E-commerce",
            "OpenCart",
            "PHP",
            "MySQL",
            "JavaScript",
            "Laravel",
            "MODX",
            "WordPress",
            "HTML",
            "CSS",
            "REST API",
            "API Integration",
            "CRM Integration",
            "1C Integration",
            "Payment Systems",
            "Delivery Integration",
            "Business Process Automation",
            "Yandex Metrica",
            "E-commerce Analytics",
            "Technical SEO",
            "Website Performance"
        ]
    ],

    "areaServed" => [
        "@type" => "Country",
        "name" => "Россия"
    ],

    "serviceType" => [
        "Диагностика сайта",
        "Срочная помощь сайту",
        "Доработка сайта и интернет-магазина",
        "Создание сайта или веб-сервиса",
        "Интеграции и автоматизация",
        "Сопровождение и развитие сайта"
    ],

    "offers" => [

        [
            "@type" => "Offer",

            "name" => "Диагностика сайта",

            "description" => "Разбор существующего сайта, поиск технических проблем, ошибок и рисков, проверка важных функций и определение приоритетов для дальнейшей работы.",

            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => 5000
            ]
        ],

        [
            "@type" => "Offer",

            "name" => "Срочная помощь сайту",

            "description" => "Поиск и исправление ошибок, из-за которых сайт или его важные функции перестали работать: формы, заявки, корзина, оплата, доставка и другие элементы.",

            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => 5000
            ]
        ],

        [
            "@type" => "Offer",

            "name" => "Доработка сайта и интернет-магазина",

            "description" => "Добавление нового функционала, изменение существующей логики, интерфейса, каталога, личного кабинета, корзины, оформления заказа и других частей проекта.",

            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => 15000
            ]
        ],

        [
            "@type" => "Offer",

            "name" => "Интеграции и автоматизация",

            "description" => "Интеграция сайта с CRM, 1С, оплатой, доставкой, внешними API и другими системами, а также автоматизация регулярных ручных операций.",

            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => 20000
            ]
        ],

        [
            "@type" => "Offer",

            "name" => "Создание сайта или веб-сервиса",

            "description" => "Проектирование и разработка нового сайта, интернет-магазина или веб-сервиса с нуля под конкретную задачу бизнеса."
        ],

        [
            "@type" => "Offer",

            "name" => "Сопровождение и развитие сайта",

            "description" => "Регулярные исправления, техническая поддержка, доработки и развитие существующего проекта.",

            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => 15000
            ]
        ]

    ]
];

?>

<script type="application/ld+json">
@json($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
</script>