<?php

$schema = [
    "@context" => "https://schema.org",
    "@type" => "ProfessionalService",
    "name" => "Code Doctor",
    "url" => url('/'),
    "description" => "Техническое сопровождение интернет-магазинов и сервисных сайтов: разбор старых проектов, исправление ошибок, доработка оплаты, доставки, форм, заявок, интеграций и аналитики.",
    "founder" => [
        "@type" => "Person",
        "name" => "Артём",
        "jobTitle" => "Технический специалист по сопровождению сайтов и интернет-магазинов",
        "knowsAbout" => [
            "OpenCart",
            "PHP",
            "MySQL",
            "JavaScript",
            "Laravel",
            "HTML",
            "CSS",
            "API Integration",
            "CRM Integration",
            "Payment Systems",
            "Delivery Integration",
            "Yandex Metrica",
            "Ecommerce Analytics",
            "Website Diagnostics",
            "Technical Support",
            "Business Process Automation"
        ]
    ],
    "areaServed" => [
        "@type" => "Country",
        "name" => "Россия"
    ],
    "serviceType" => [
        "Разбор сайта и техническая диагностика",
        "Срочная помощь сайту",
        "Доработка интернет-магазина / OpenCart",
        "Техническое сопровождение сайта",
        "Аналитика заявок, заказов и e-commerce",
        "Интеграции и автоматизация"
    ],
    "offers" => [
        [
            "@type" => "Offer",
            "name" => "Разбор сайта и техническая диагностика",
            "description" => "Проверка сайта, форм, заявок, заказов, оплаты, доставки, скорости, аналитики, интеграций и технических рисков.",
            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => "5000"
            ]
        ],
        [
            "@type" => "Offer",
            "name" => "Срочная помощь сайту",
            "description" => "Исправление технических ошибок: сайт не открывается, не работают формы, заявки, корзина, оформление заказа, оплата, доставка или модули.",
            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => "5000"
            ]
        ],
        [
            "@type" => "Offer",
            "name" => "Доработка интернет-магазина / OpenCart",
            "description" => "Доработка корзины, оформления заказа, оплаты, доставки, модулей, статусов, скидок, интеграций и нестандартной логики интернет-магазина.",
            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => "15000"
            ]
        ],
        [
            "@type" => "Offer",
            "name" => "Техническое сопровождение сайта",
            "description" => "Регулярное техническое сопровождение сайта: исправление ошибок, доработки, контроль стабильности, консультации и развитие проекта.",
            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => "15000"
            ]
        ],
        [
            "@type" => "Offer",
            "name" => "Аналитика заявок, заказов и e-commerce",
            "description" => "Настройка Яндекс.Метрики, целей, событий, форм, заявок, заказов, e-commerce и отслеживания ключевых действий пользователей.",
            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => "15000"
            ]
        ],
        [
            "@type" => "Offer",
            "name" => "Интеграции и автоматизация",
            "description" => "Интеграции сайта с CRM, 1С, оплатой, доставкой, внешними API, внутренними сервисами, уведомлениями и статусами.",
            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "RUB",
                "minPrice" => "40000"
            ]
        ]
    ]
];

?>

<script type="application/ld+json">
@json($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
</script>